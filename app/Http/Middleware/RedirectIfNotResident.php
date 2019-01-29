<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotResident
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if (! $user->isResident()) {
            return redirect()->route($user->getDashboardRoute())->with('error', 'This page is for residents only');
        }

        return $next($request);
    }
}
