<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Not Logged
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (gettype($role) == "array") {

            if (!in_array($request->user()->role, $role)) {
                return abort(404);
            }
            return $next($request);
        }
        // Not allowed
        if ($request->user()->role != $role) {
            return abort(404);
        }
        return $next($request);
    }
}
