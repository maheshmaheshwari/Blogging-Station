<?php

namespace App\Http\Controllers;

use App\Helpers\Database;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InstallController extends Controller
{
    /**
     * Checks for displaying the installation wizard already done on the Install middleware but I added it again here
     * for more security
     */
    public function __construct()
    {
        auth()->logout();
        \Artisan::call('config:clear');

        if (is_app_installed()) {
            redirect('/')->send();
            exit();
        }
    }

    public function index()
    {
        return view('public.install.index');
    }

    public function database()
    {
        if (request()->isMethod('post')) {
            try {
                $host = request()->post('host');
                $port = request()->post('port');
                $username = request()->post('username');
                $password = request()->post('password');
                $database = request()->post('database');

                config([
                    'database.connections.onTheFly' => [
                        'driver' => 'mysql',
                        'host' => $host,
                        'port' => $port,
                        'database' => $database,
                        'username' => $username,
                        'password' => $password,
                    ],
                ]);

                DB::connection('onTheFly')->getPdo();
            } catch (\Exception $exception) {
                session()->flash('danger', $exception->getMessage());
                return redirect()->route('install.database')->withInput();
            }

            $engine = Database::getRecommendedEngine('onTheFly');
            $collation = Database::getRecommendedCollation('onTheFly');
            $charset = explode('_', $collation)[0];

            $data = [
                'APP_INSTALLED' => 0,
                'APP_KEY' => str_random(32),
                'APP_SECRET_KEY' => sha1(str_random()),
                'DB_HOST' => $host,
                'DB_PORT' => $port,
                'DB_DATABASE' => $database,
                'DB_USERNAME' => $username,
                'DB_PASSWORD' => $password,
                'DB_ENGINE' => $engine,
                'DB_CHARSET' => $charset,
                'DB_COLLATION' => $collation,
            ];

            $result = buildEnvVars($data);

            if ($result === false) {
                session()->flash('danger', __("Could not write env.php file."));
            } else {
                return redirect()->route('install.data');
            }
        }

        return view('public.install.database');
    }

    public function data()
    {
        if (request()->query('run')) {
            try {
                set_time_limit(600);
                $result = \Artisan::call('migrate', ['--force' => true]);
            } catch (\Exception $exception) {
                $result = $exception->getMessage();
            }

            if ($result !== 0) {
                session()->flash('danger', $result);

                return redirect()->route('install.data');
            }

            return redirect()->route('install.admin');
        }

        return view('public.install.data');
    }

    public function admin()
    {
        if (request()->isMethod('post')) {
            $data = request()->only(['username', 'email', 'password', 'password_confirmation']);

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
                'email' => 'required|string|email|max:191|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect(route('install.admin'))
                    ->withErrors($validator)
                    ->withInput();
            }


            $result = DB::table('users')->insert([
                'email' => $data['email'],
                'name' => $data['username'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => 'admin',
                'status' => 1,
                'register_ip' => get_ip(),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
            ]);

            if ($result !== true) {
                session()->flash('danger', __('Oops! There are mistakes in the form. Please make the correction.'));

                return redirect()->route('install.admin')->withInput();
            }

            return redirect()->route('install.finish');
        }

        return view('public.install.admin');
    }

    public function finish()
    {
        $admin_user = DB::table('users')->find(1);

        DB::table('options')
            ->where('name', 'admin_email')
            ->update(['value' => $admin_user->email]);

        DB::table('options')
            ->where('name', 'email_from')
            ->update(['value' => 'no_reply@' . $_SERVER['HTTP_HOST']]);

        $data = [
            'APP_INSTALLED' => 1,
        ];

        buildEnvVars($data);

        return view('public.install.finish');
    }

}
