<?php

namespace App\Http\Middleware;

use App\Helpers\Activation as ActivationHelper;
use Closure;

class Activation
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

        if (auth()->user()->role !== 'admin') {
            return $next($request);
        }

        if ($this->licenseActivate($request)) {
            redirect()->route('admin.activation')->setStatusCode(307)->send();
            exit();
        }

        return $next($request);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function licenseActivate($request)
    {
        if (require_database_upgrade()) {
            return false;
        }

        if (ActivationHelper::checkLicense() === false &&
            strpos($request->route()->getAction('controller'), 'ActivationController') === false) {
            return true;
        }

        return false;
    }
}
