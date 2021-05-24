<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        foreach ( $roles as $role ) {
            // if user has given role, continue processing the request
            if ( $user->hasRole($role) )
                return $next($request);
        }

        // user didn't have any of required roles, return Forbidden error
        return response()->json(['error'=>'Unauthorised'], 401);
    }
}
