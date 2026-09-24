<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        ///if(strtolower($request->method() ) == 'post'){ Log::info(__FILE__);}
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //if(strtolower($request->method() ) == 'post'){ Log::info(__LINE__);}
                return redirect(RouteServiceProvider::HOME);
            }
            //if(strtolower($request->method() ) == 'post'){ Log::info(__LINE__);}
        }
        //if(strtolower($request->method() ) == 'post'){ Log::info(__LINE__);}
        return $next($request);
    }
}
