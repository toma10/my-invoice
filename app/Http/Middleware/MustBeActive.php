<?php

namespace App\Http\Middleware;

use Closure;

class MustBeActive
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
        if ($request->user() && ! $request->user()->isActive()) {
            auth()->logout();

            flash()->error(trans('messages.users.not_active'));

            return redirect()->route('login');
        }

        return $next($request);
    }
}
