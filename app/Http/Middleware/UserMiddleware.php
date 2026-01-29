<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if user is logged in AND is a standard user
        if (Auth::check() && Auth::user()->user_type === 'user') {
            return $next($request);
        }

        // 2. If not, kick them to the login page
        return redirect()->route('user.login')->with('error', 'Unauthorized access.');
    }
}