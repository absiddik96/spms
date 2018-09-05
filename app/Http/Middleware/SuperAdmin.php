<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

class SuperAdmin
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
        if (Auth::check()) {
            if (Auth::user()->isSuperAdmin()) {
                return $next($request);
            }
        }

        return redirect()->back();
    }
}
