<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckBusinessUserLoggedIn
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
       $businessStatus = false;
        if( Auth::check() ) {
            if( Auth::user()->user_type == "business" ) {
                $businessStatus = TRUE;
            }
        }
        if( $businessStatus ) {
        } else {
            return redirect("/home");
        }
        return $next($request);
    }
}
