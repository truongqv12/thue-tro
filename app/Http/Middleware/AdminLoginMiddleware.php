<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminLoginMiddleware
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
        if (Auth::check()){
            $admin = Auth::user();
            if ($admin->adm_status == 1){
                return $next($request);
            }
            else{
                return redirect()->route('login_admin');
            }
        }
        else{
            return redirect()->route('login_admin');
        }
    }
}
