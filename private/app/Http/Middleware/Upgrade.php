<?php

namespace App\Http\Middleware;

use Closure;

class Upgrade
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->route()->getPrefix() !== '/admin') {
            return $next($request);
        }
        /*
        if (!auth()->check()) {
            return $next($request);
        }

        if (auth()->user()->role !== 'admin') {
            return $next($request);
        }
        */
        if ($this->databaseUpgrade($request)) {
            redirect()->route('admin.upgrade')->setStatusCode(307)->send();
            exit();
        }

        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function databaseUpgrade($request)
    {
        if (require_database_upgrade() &&
            strpos($request->route()->getAction('controller'), 'UpgradeController') === false) {
            return true;
        }

        return false;
    }
}
