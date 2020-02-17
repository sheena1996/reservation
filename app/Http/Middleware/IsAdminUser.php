<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAdminUser
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
            if( Auth::user()->is_admin != 1){
                return redirect()->back()->withErrors("Sorry! You don't have the enough rights");
            }
        } else {
            return redirect('/login');
        }
        return $next($request);
    }
}
