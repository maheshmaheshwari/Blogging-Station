<?php

namespace App\Http\Middleware;

use Closure;

class Install
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $is_install_url = strpos($_SERVER['REQUEST_URI'], '/install');

        if (is_app_installed() === false) {
            if ($is_install_url === false) {
                redirect('/install', 307)->send();
                exit();
            }
        } elseif ($is_install_url !== false) {
            redirect('/')->send();
            exit();
        }

        return $next($request);
    }
}
