<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->userCourses->count() > 0) {
            // Check if the user has an active subscription
            return $next($request);
        } else {
            return redirect()->route('payment')->with('error', 'You need to subscribe to access this content.');
        }
    }
}
