<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if user is logged in AND is an admin
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return $next($request);
        }

        // 2. If not, kick them to the login page with an error
        return redirect()->route('admin.login')->with('error', 'Unauthorized access. Admins only.');
    }
}