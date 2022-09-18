<?php

namespace App\Http\Middleware;

use Closure;

class MemberMissingFields
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
        if (!auth()->check()) {
            return $next($request);
        }

        if (!auth()->user()->username) {
            if ($request->route()->getName() !== 'member.set.username') {
                return redirect()->route('member.set.username');
            }
        }

        return $next($request);
    }
}
