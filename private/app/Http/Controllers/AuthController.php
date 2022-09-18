<?php

namespace App\Http\Controllers;

use App\Helpers\Captcha;
use App\Mail\AdminNewRegistration;
use App\Mail\EmailVerify;
use App\Mail\PasswordReset;
use App\SocialProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param string $provider
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToSocialProvider($provider)
    {
        $action = request()->query('action');

        if ((bool)get_option('close_registration', false) && ($action === 'register')) {
            return redirect('/');
        }

        try {
            if ((bool)get_option('social_login_facebook', false)) {
                if ($provider === 'facebook') {
                    return Socialite::driver($provider)
                        ->setScopes(['email', 'public_profile'])
                        ->redirect();
                }
            }

            if ((bool)get_option('social_login_twitter', false)) {
                if ($provider === 'twitter') {
                    return Socialite::driver($provider)->redirect();
                }
            }

            if ((bool)get_option('social_login_google', false)) {
                if ($provider === 'google') {
                    return Socialite::driver($provider)
                        ->setScopes(['email', 'profile'])
                        ->redirect();
                }
            }

            return Socialite::driver($provider)->redirect();
        } catch (\Exception $exception) {
            session()->flash('danger', $exception->getMessage());
            return redirect()->route('login');
        }
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $provider
     *
     * @return \Illuminate\Http\Response
     * @see https://laravel.com/docs/5.7/socialite#retrieving-user-details
     *
     */
    public function handleSocialProviderCallback($provider)
    {
        try {
            $social_user = Socialite::driver($provider)->user();
        } catch (\Exception $exception) {
            session()->flash('danger', $exception->getMessage());
            return redirect()->route('login');
        }

        if (!$social_user) {
            session()->flash('danger', __('Invalid login. Try again'));
            return redirect()->route('login');
        }

        if (!$social_user->getEmail()) {
            session()->flash('danger', __("You must have an email on your social profile."));
            return redirect()->route('login');
        }

        $social_profile = SocialProfile::query()
            ->where([
                ['provider', $provider],
                ['provider_id', $social_user->getId()],
            ])
            ->first();

        if ($social_profile) {
            if (Auth::loginUsingId($social_profile->user_id)) {
                $social_profile->user->timestamps = false;
                $social_profile->user->login_ip = get_ip();
                $social_profile->user->update();

                if ('admin' == Auth::user()->role) {
                    return redirect()->intended('admin');
                }

                return redirect()->intended('member');
            }
        }

        $user = User::query()
            ->whereEmail($social_user->getEmail())
            ->first();

        if ($user) {
            $social_profile = new SocialProfile();
            $social_profile->user_id = $user->id;
            $social_profile->provider = $provider;
            $social_profile->provider_id = $social_user->getId();
            $social_profile->nickname = $social_user->getNickname();
            $social_profile->name = $social_user->getName();
            $social_profile->email = $social_user->getEmail();
            $social_profile->avatar = $social_user->getAvatar();
            $social_profile->save();

            if ($social_profile) {
                if (Auth::loginUsingId($social_profile->user_id)) {
                    $user->timestamps = false;
                    $user->login_ip = get_ip();
                    $user->update();

                    if ('admin' == Auth::user()->role) {
                        return redirect()->intended('admin');
                    }

                    return redirect()->intended('member');
                }
            }
        }

        if ((bool)get_option('close_registration', false)) {
            return redirect('/');
        }

        $user = new User();
        $user->name = $social_user->getName();
        $user->email = $social_user->getEmail();
        $user->password = Hash::make(str_random(32));
        $user->role = 'member';
        $user->status = 1;
        $user->login_ip = get_ip();
        $user->register_ip = get_ip();
        $user->author_earnings = price_database_format(get_option('signup_bonus', 0));

        $referred_by_id = null;
        if (isset($_COOKIE['ref']) && !empty($_COOKIE['ref'])) {
            $user_referred_by = User::query()
                ->where([
                    ['username', $_COOKIE['ref']],
                    ['status', 1],
                ])
                ->first();

            if ($user_referred_by) {
                $referred_by_id = $user_referred_by->id;
            }
        }

        $user->referred_by = $referred_by_id;

        if ($user->save()) {
            $social_profile = new SocialProfile();
            $social_profile->user_id = $user->id;
            $social_profile->provider = $provider;
            $social_profile->provider_id = $social_user->getId();
            $social_profile->nickname = $social_user->getNickname();
            $social_profile->name = $social_user->getName();
            $social_profile->email = $social_user->getEmail();
            $social_profile->avatar = $social_user->getAvatar();
            $social_profile->save();

            if ($social_profile) {
                if ((bool)get_option('alert_admin_new_user_register', 0)) {
                    Mail::send(new AdminNewRegistration($user));
                }

                if (Auth::loginUsingId($social_profile->user_id)) {
                    if ('admin' == Auth::user()->role) {
                        return redirect()->intended('admin');
                    }

                    return redirect()->intended('member');
                }
            }
        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            if ((bool)get_option('captcha_login', 0) &&
                isset_captcha() &&
                !Captcha::verify($request->post())
            ) {
                session()->flash('danger', __('The CAPTCHA was incorrect. Try again'));
                return redirect()->route('login')->withInput();
            }

            $credentials = $request->only('email', 'password');

            $credentials['status'] = 1;

            $remember = false;
            if ($request->remember) {
                $remember = true;
            }

            if (Auth::attempt($credentials, $remember)) {
                $user = User::find(user()->id);
                $user->timestamps = false;
                $user->login_ip = get_ip();
                $user->update();

                if ('admin' == Auth::user()->role) {
                    return redirect()->intended('admin');
                }

                return redirect()->intended('member');
            }
            session()->flash('danger', __('Invalid username or password, try again'));
            return redirect()->route('login')->withInput();
        }

        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        if ((bool)get_option('close_registration', false)) {
            return redirect('/');
        }

        if ($request->isMethod('post')) {
            if ((bool)get_option('captcha_register', 0) &&
                isset_captcha() &&
                !Captcha::verify($request->post())
            ) {
                session()->flash('danger', __('The CAPTCHA was incorrect. Try again'));
                return redirect()->route('register')->withInput();
            }

            $data = $request->only(['name', 'username', 'email', 'password', 'password_confirmation']);

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'username' => [
                    'required',
                    'string',
                    'alpha_num',
                    'min:3',
                    'max:50',
                    'unique:users',
                    function ($attribute, $value, $fail) {
                        $reserved_domains = explode(',', get_option('reserved_usernames'));
                        $reserved_domains = array_map('trim', $reserved_domains);
                        $reserved_domains = array_filter($reserved_domains);
                        $reserved_domains = array_unique($reserved_domains);

                        if (in_array(strtolower($value), $reserved_domains)) {
                            return $fail(__('This username is a reserved word.'));
                        }
                    },
                ],
                'email' => 'required|string|email|max:191|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect(route('register'))
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = new User;

            $user->name = $data['name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);

            $referred_by_id = null;
            if (isset($_COOKIE['ref']) && !empty($_COOKIE['ref'])) {
                $user_referred_by = User::query()
                    ->where([
                        ['username', $_COOKIE['ref']],
                        ['status', 1],
                    ])
                    ->first();

                if ($user_referred_by) {
                    $referred_by_id = $user_referred_by->id;
                }
            }

            $user->referred_by = $referred_by_id;
            $user->activation_key = sha1(str_random(40));
            $user->role = 'member';
            $user->status = 1;
            $user->register_ip = get_ip();
            $user->author_earnings = price_database_format(get_option('signup_bonus', 0));

            if ((bool)get_option('account_activate_email', true)) {
                $user->status = 2;
            }

            if ($user->save()) {
                if ((bool)get_option('alert_admin_new_user_register', 0)) {
                    Mail::send(new AdminNewRegistration($user));
                }

                if ((bool)get_option('account_activate_email', true)) {
                    Mail::send(new EmailVerify($user));

                    session()->flash('success',
                        __('Your account has been created. Please check your email inbox or spam folder to activate your account.'));
                    return redirect()->route('login');
                }

                session()->flash('success', __('Your account has been created.'));
                return redirect()->route('login');
            }
            session()->flash('danger', __('Unable to add the user.'));
            return redirect()->route('register')->withInput();
        }

        return view('auth.register');
    }

    public function emailVerify($username = null, $key = null)
    {
        if (!$username && !$key) {
            session()->flash('message', __('Invalid Activation'));
            return redirect()->route('login');
        }

        /**
         * @var \App\User $user
         */
        $user = User::query()
            ->where([
                ['username', $username],
                ['activation_key', $key],
                ['status', 2],
            ])
            ->first();

        if (!$user) {
            session()->flash('danger', __('Invalid Activation'));
            return redirect()->route('login');
        }

        $user->email_verified_at = now();
        $user->status = 1;
        $user->activation_key = null;

        if ($user->save()) {
            session()->flash('success', __('Your account has been activated.'));
            Auth::login($user);
            return redirect()->route('member.dashboard');
        } else {
            session()->flash('danger', __('Unable to activate your account.'));
            return redirect()->route('login');
        }
    }

    public function resetPassword($username = null, $key = null)
    {
        /**
         * @var \App\User $user
         */

        if (!$username && !$key) {
            if (request()->isMethod('post')) {
                if ((bool)get_option('captcha_forgot_password', 0) &&
                    isset_captcha() &&
                    !Captcha::verify(request()->post())
                ) {
                    session()->flash('danger', __('The CAPTCHA was incorrect. Try again'));
                    return redirect()->route('password.reset')->withInput();
                }

                $data = request()->only(['email']);

                $validator = Validator::make($data, [
                    'email' => 'required|string|email',
                ]);

                if ($validator->fails()) {
                    return redirect(route('password.reset'))
                        ->withErrors($validator)
                        ->withInput();
                }

                $user = User::query()
                    ->where([
                        ['email', $data['email']],
                        ['status', 1],
                    ])
                    ->first();

                if (!$user) {
                    session()->flash('danger', __('This user is invalid or inactive.'));
                    return redirect()->route('password.reset');
                }

                $user->activation_key = sha1(str_random(40));

                if ($user->save()) {
                    Mail::send(new PasswordReset($user));

                    session()->flash('success', __('Kindly check your email for reset password link.'));
                    return redirect()->route('password.reset');
                } else {
                    session()->flash('danger', __('Unable to reset password.'));
                    return redirect()->route('password.reset');
                }
            }
        } else {
            $user = User::query()
                ->where([
                    ['username', $username],
                    ['activation_key', $key],
                    ['status', 1],
                ])
                ->first();

            if (!$user) {
                session()->flash('danger', __('Invalid Request'));
                return redirect()->route('password.reset');
            }

            if (request()->isMethod('post')) {
                $data = request()->only(['password', 'password_confirmation']);

                $validator = Validator::make($data, [
                    'password' => 'required|string|min:6|confirmed',
                ]);

                if ($validator->fails()) {
                    return redirect(route('password.reset', [$username, $key]))
                        ->withErrors($validator)
                        ->withInput();
                }

                $user->password = Hash::make($data['password']);
                $user->activation_key = null;

                if ($user->save()) {
                    session()->flash('success', __('Your password has been changed.'));
                    return redirect()->route('login');
                } else {
                    session()->flash('danger', __('Unable to change your password.'));
                    return redirect()->route('password.reset', [$username, $key]);
                }
            }
        }

        return view('auth.password_rest', [
            'username' => $username,
            'key' => $key,
        ]);
    }
}
