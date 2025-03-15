<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Profile;


class CheckUserInArea
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
        // $user_ip = request()->ip();
        $user_ip = request()->getClientIp();
        $profileUrl = $request->route('profiles');
        $profile = Profile::where("url", $profileUrl)->first();
        $profile_static_ip_adress = $profile->static_ip_adress;


        if(Auth::check()){
            $user_id = auth()->user()->id;
        }
        else{
            $user_id = 0;

        }

        
        $profile_owner_id = $profile->user_id;


        if($profile_static_ip_adress != null){
            // profile has static ip adress
            if($user_ip == $profile_static_ip_adress || $user_id == $profile_owner_id){
                return $next($request);
                
            }
            else{
                abort(403, "İşletme ağına bağlı değilsiniz!");
            }
        }
        else{
            // no static ip adress
            return $next($request);
        }
    }
}
