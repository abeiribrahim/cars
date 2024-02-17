<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveUserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->active) {
            return $next($request);
        }
        
        return redirect()->route('login')->with('error', 'Your account is not active.');
    }
}

