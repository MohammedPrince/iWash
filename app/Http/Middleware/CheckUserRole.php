<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if the user has role_id 1 or is an admin
        if ($user->role_id === 1 || $user->role->name === 'Admin') {
            return $next($request);
        }

        // Check if the user has role_id 2 or 'role:service-provider' to access service-provider routes
        if ($user->role_id === 2 || $user->role->name === 'Service Provider') {
            if (in_array('role:service-provider', $roles)) {
                return $next($request);
            } else {
                return response()->json(['error' => 'Unauthorized Role: service-provider'], 403);
            }
        }

        // Check if the user has role_id 4 or 'role:customer' to access customer routes
        if ($user->role_id === 4 || $user->role->name === 'Customer') {
            if (in_array('role:customer', $roles)) {
                return $next($request);
            } else {
                return response()->json(['error' => 'Unauthorized Role: customer'], 403);
            }
        }

        // Check if the user has the required role to access the route
        if (!in_array($user->role->name, $roles)) {
            return response()->json(['error' => 'Unauthorized Role'], 403);
        }

        return $next($request);
    }
}
