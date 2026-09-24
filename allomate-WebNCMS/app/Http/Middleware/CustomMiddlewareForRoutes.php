<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Response;

class CustomMiddlewareForRoutes
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
        if (!$request->ajax()) {
            if (Auth::guard('investor')->check()) {

                $auth       =   Auth::guard('investor')->user();
                $where      =   "investor_id = $auth->id";
            } else if (Auth::guard('web')->check()) {
                $auth       =   Auth::guard('web')->user();
                $where      =   "admin_id = $auth->id";
            } else {
                return redirect('/');
            }
            $slug       =   $request->getRequestUri();
            if ($slug) {
                $slug   =   explode('/', $slug) ? explode('/', $slug)[2] : $request->getRequestUri();
            } 
            if ($slug) {
            
                if ($auth->super == 0 && $slug != "index" && $slug != "profile") {
                 
                    $checkRoute =   [];

                    $checkRoute     =   DB::SELECT("
                                            SELECT
                                                ar.*
                                            FROM
                                            access_rights ar
                                            WHERE
                                                controller_right = '$slug'
                                            AND
                                            $where
                                        
                                        ");

                    if (collect($checkRoute)->count() > 0) { 
                        return $next($request);
                    } else {

                        return Response::view('errors.404', [], 404);
                    }
                } else {
                    return $next($request);
                }
            } else {

                return Response::view('errors.404', [], 404);
            }
        } else {

            return $next($request);
        }
    }
}
