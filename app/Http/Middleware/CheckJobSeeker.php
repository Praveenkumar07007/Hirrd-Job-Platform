<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckJobSeeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->user_type !== 'job_seeker') {
            // Redirect non-job seekers or unauthenticated users
            // You might want to redirect to a specific route or show an error
            return redirect('/')->with('error', 'Access denied. You must be logged in as a job seeker.');
        }

        return $next($request);
    }
}
