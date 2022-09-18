<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol
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
        if ((bool)get_option('ssl_enable', 0) && !$request->secure()) {
            redirect()->secure($request->getRequestUri())->send();
            exit();
        }

        return $next($request);
    }
}
