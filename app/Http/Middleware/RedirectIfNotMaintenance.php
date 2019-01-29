<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotMaintenance
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

        if (! $user->isMaintenance()) {
            return redirect()->route($user->getDashboardRoute())->with('error', 'This page is for maintenance only');
        }

        return $next($request);
    }
}
