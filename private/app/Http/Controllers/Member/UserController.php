<?php

namespace App\Http\Controllers\Member;

use App\Article;
use App\Mail\EmailChange;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends MemberController
{
    public function feed()
    {
        /**
         * @var \App\User $user
         */
        $user = auth()->user();

        $followings = $user->followings()->select('followers.author_id')->get();

        $articles = null;

        if ($followings) {
            $authors = [];

            foreach ($followings as $following) {
                $authors[] = (int)$following->author_id;
            }

            $articles = Article::query()
                ->with(['user', 'categories', 'featuredImage', 'mainCategory'])
                ->whereIn('user_id', $authors)
                ->whereIn('status', [1, 4])
                ->orderBy('published_at', 'desc')
                ->paginate(10);
        }

        return view('member.users.feed', [
            'articles' => $articles,
        ]);
    }

    public function referrals()
    {
        if (!(bool)get_option('enable_referrals', 1)) {
            abort(404);
        }

        $referrals = User::query()
            ->where('referred_by', user()->id)
            ->paginate(20);

        return view('member.users.referrals', [
            'referrals' => $referrals,
        ]);
    }

    public function setUsername()
    {
        $user = User::find(auth()->id());

        if ($user->username) {
            return redirect()->route('member.dashboard');
        }

        if (request()->isMethod('post')) {
            $data = request()->only(['username']);

            $validator = Validator::make($data, [
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
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->username = $data['username'];
            if ($user->update()) {
                session()->flash('success', __('The username has been added.'));
                return redirect()->route('member.dashboard');
            }
        }

        return view('member.users.username', [
            'user' => $user,
        ]);
    }

    public function settings()
    {
        $user = User::find(auth()->id());

        if (request()->isMethod('post')) {
            $data = request()->only([
                'name',
                'description',
                'upload_image',
                'social_networks',
                'withdrawal_method',
                'withdrawal_account',
            ]);

            /**
             * Whitelist social networks
             */
            $data['social_networks'] = array_intersect_key(
                $data['social_networks'],
                array_flip([
                    'facebook',
                    'twitter',
                    'linkedin',
                    'youtube',
                    'vimeo',
                    'instagram',
                    'pinterest',
                    'vk',
                    'github',
                ])
            );

            $validator = Validator::make($data, [
                'name' => ['nullable', 'string', 'max:191'],
                'description' => ['nullable', 'string'],
                'upload_image' => [
                    'nullable',
                    'mimes:gif,jpg,jpeg,png',
                    'max:' . get_option('fileupload_max'),
                ],
                "social_networks" => ['array'],
                "social_networks.*" => ['nullable', 'url'],
                'withdrawal_method' => [
                    'nullable',
                    function ($attribute, $value, $fail) {
                        if (!array_key_exists($value, array_column(get_withdrawal_methods(), 'name', 'id'))) {
                            return $fail(__('Invalid withdrawal method.'));
                        }
                    },
                ],
                'withdrawal_account' => 'nullable|required_with:withdrawal_method',
            ]);

            if ($validator->fails()) {
                return redirect(route('member.settings'))
                    ->withErrors($validator)
                    ->withInput();
            }

            /**
             * @var \App\File|null $profile_image
             */
            $profile_image = \App\Helpers\Upload::process('upload_image');

            if ($profile_image) {
                $data['image_id'] = $profile_image->id;
            }

            unset($data['upload_image']);

            if ($user->update($data)) {
                session()->flash('success', __('Settings has been updated.'));
            } else {
                session()->flash('danger', __('Oops! There are mistakes in the form. Please make the correction.'));
            }

            return redirect()->route('member.settings');
        }

        return view('member.users.settings', [
            'user' => $user,
        ]);
    }

    public function emailChangeRequest()
    {
        $user = User::find(auth()->id());

        $data = request()->only(['tmp_email', 'tmp_email_confirmation']);

        $validator = Validator::make($data, [
            'tmp_email' => 'required|string|email|max:191|confirmed|unique:users,email',
        ]);

        if ($validator->fails()) {
            return redirect(route('member.settings'))
                ->withErrors($validator)
                ->withInput();
        }

        $user->tmp_email = $data['tmp_email'];
        $user->activation_key = sha1(str_random(40));

        if ($user->save()) {
            Mail::send(new EmailChange($user));

            session()->flash('success', __('Kindly check your email to confirm it.'));
        } else {
            session()->flash('danger', __('Oops! There are mistakes in the form. Please make the correction.'));
        }

        return redirect()->route('member.settings');
    }

    public function emailChangeProcess($username, $key)
    {
        /**
         * @var \App\User $user
         */
        $user = User::query()
            ->where([
                ['username', $username],
                ['activation_key', $key],
                ['status', 1],
            ])
            ->first();

        if (!$user) {
            session()->flash('danger', __('Invalid Activation'));
            return redirect()->route('member.settings');
        }

        $user->email = $user->tmp_email;
        $user->tmp_email = null;
        $user->activation_key = null;

        if ($user->save()) {
            session()->flash('success', __('Your email has been confirmed.'));
        } else {
            session()->flash('danger', __('Unable to confirm your email.'));
        }

        return redirect()->route('member.settings');
    }

    public function passwordChange()
    {
        $user = User::find(auth()->id());

        $data = request()->only(['current_password', 'new_password', 'new_password_confirmation']);

        $validator = Validator::make($data, [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('Invalid password.'));
                    }
                },
            ],
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect(route('member.settings'))
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = Hash::make($data['new_password']);

        if ($user->save()) {
            session()->flash('success', __('Password has been updated.'));
        } else {
            session()->flash('danger', __('Oops! There are mistakes in the form. Please make the correction.'));
        }

        return redirect()->route('member.settings');
    }
}
