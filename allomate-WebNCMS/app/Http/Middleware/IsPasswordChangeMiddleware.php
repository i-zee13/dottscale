<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Response;

class IsPasswordChangeMiddleware
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
        if (Auth::guard('investor')->check() || Auth::guard('web')->check()){
            $auth           =   GetActiveGuardDetail();
            if ($auth  && $auth->password_changed != 0) {
                return $next($request);
            } else {
                $message    = 'Please update your password first.';
                return redirect('/reset-password-first')->with(['message'=>$message]);
            }
        }
        else{
            if( in_array($_SERVER['HTTP_HOST'],['localhost','127.0.0.1','127.0.0.1:8001',env('ADMIN_URL', 'demo.crm.allomate.solutions')]) ){
                return redirect('/login');
            }
            if( in_array($_SERVER['HTTP_HOST'],['localhost','127.0.0.1','127.0.0.1:8002',env('INVESTOR_URL', 'investor.demo.allomate.solutions')]) ){
                return redirect('/investor-login');
            }
        }
    }
}
