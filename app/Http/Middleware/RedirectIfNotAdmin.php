<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if (! $request->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
