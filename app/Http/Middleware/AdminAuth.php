<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user() == null){
            // if user not logged in..
            return redirect('/');

        }
        else{
            if($request->user()->user_type->user_type == "admin"){
                // user is admin, allow to go on...
                
                return $next($request);
            }
            else{
                return redirect('/');
            }
        }

    }
}
