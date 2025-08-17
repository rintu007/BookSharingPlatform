<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the request has a valid admin token
        if (!Auth::guard('admin')->check()) {
            // Return 401 if the token is invalid or missing
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
