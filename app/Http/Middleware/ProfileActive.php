<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Profile;


class ProfileActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profileUrl = $request->route('profiles');
        $profile = Profile::where("url", $profileUrl)->first();

        if($profile->active == 0){
            abort(403, "Sayfaya erişim bulunmamaktadır!");
        }
        else{
            return $next($request);
        }

    }
}
