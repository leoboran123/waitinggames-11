<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Business;


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
        $user_ip = strval(request()->getClientIp());
        $business_list = Business::all();

        if($business_list == null){
            // no business added...
            return $next($request);

        }
        else{

            
            $static_ip_adress_list = Business::where("static_ip_adress", $user_ip)->where("active",1)->first();
            
            if($static_ip_adress_list == null){
                abort(403, "İşletme ağına bağlı değilsiniz!");
                
            }
            else{
                return $next($request);
                
            }
        }
        
        
        
    }
}
