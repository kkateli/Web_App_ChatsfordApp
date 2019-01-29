<?php

namespace App\Http\Middleware;

use Closure;

class AbilityToUpdateAndViewComplaints
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

        if (! $user->isManagement() && ! $user->isResident()) {
            return redirect()->route($user->getDashboardRoute())->with('error', 'This page is for management and residents only');
        }

        return $next($request);
    }
}
