<?php

namespace App\Http\Middleware;

use Closure;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            redirect()->route('login')->send();
            exit();
        }

        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        return abort(404);
    }
}
