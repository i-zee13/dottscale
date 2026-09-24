<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //if(strtolower($request->method() ) == 'post'){ dd(__FILE__);}
        // if (!$request->expectsJson()) {
        //     if (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8001'])) {
        //         if (!Auth::guard('investor')->check()) {
        //             return route('investor-login');
        //         }
        //     } else {

        //         return route('login');
        //     }
        // }
    }
}
