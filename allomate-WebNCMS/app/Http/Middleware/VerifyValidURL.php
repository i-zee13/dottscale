<?php

namespace App\Http\Middleware;

use App\AccessRights;
use App\ControllersList;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class VerifyValidURL
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
        $webroutes =    [
            '',
            'home',
            'aboutus',
            'blogs',
            'blog-details',
            'get-in-touch',
            'save-contact',
            'privacy-policy',
            'terms-of-use',
            'subscription-email',
            'faqs',
            'career',
            'field-traner',
            'ios-developer',
            'learn-more',
            'get-demo',
            'software-quality',
            'business-development',
            'store-demo-form',
            'store-contact-form',
            'store-application-form',
            'what-we-do',
            'contact-us',
            'career-detail',
            'what-we-do',
            'the-difference',
            'services-detail',
            'all-testimonials-list',
            'get-careers-positions',
            'career-details',
            'get-client-reviews',
            'get-latest-blogs',
            'get-all-blogs',
            'get-services',
            'get-client-logos',
            'any'
        ];

        $adminroutes =    [
            '',
            '/',
            'login',
            'mylogin',
            'register',
            'logout',
            'dashboard',
            'index',
            'createRights',
            'admin.home',
            'admin.blocks-media',
            'admin.careers',
            'admin.add-blog',
            'admin.create-career',
            'admin.edit-career',
            'admin.reviews-list',
            'admin.clients',
            'generated::MmiLgvnTnVquRpGE'
        ]; 
        //  dd($_SERVER['HTTP_HOST'],env('ADMIN_URL', 'demo.crm.allomate.solutions'), (in_array($_SERVER['HTTP_HOST'], ['www.demo.crm.allomate.solutions', env('ADMIN_URL', 'demo.crm.allomate.solutions')])),Route::currentRouteName(), $adminroutes);
        if (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8000'])) {
            if (in_array(Route::currentRouteName(), $webroutes)) {
            }
        } else if (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8001'])) {
            
            if (in_array(Route::currentRouteName(), $adminroutes) && Route::currentRouteName() != '') {
                dump(34);
                if (!Auth::guard('web')->check()) {
                    return redirect(route('login'));
                }
            }else{
                if (!Auth::guard('web')->check()) {
                    return redirect(route('login'));
                } else {
                    dump(Auth::guard('web')->check() && strpos(request()->url(), 'admin') !== false);
                    if (Auth::guard('web')->check() && strpos(request()->url(), 'admin') !== false) {
                         
                    } else { 
                        Auth::guard('web')->logout();
                        return redirect(route('login'));
                    }
                }
            }
        } else if (in_array($_SERVER['HTTP_HOST'], ['https://web.allomate.solutions', env('WEB_URL', 'web.allomate.solutions')])) {
            if (Route::currentRouteName() == '' || Route::currentRouteName() == null) {
            } else if (!in_array(Route::currentRouteName(), $webroutes)) {
                return abort(404);
            }
        } else if (in_array($_SERVER['HTTP_HOST'], ['https://cms.allomate.solutions', env('ADMIN_URL', 'cms.allomate.solutions')])) {
            if (in_array(Route::currentRouteName(), $adminroutes)) {
                if (!Auth::guard('web')->check()) {
                    return redirect(route('login'));
                }
            }else{
                if (!Auth::guard('web')->check()) {
                    return redirect(route('login'));
                } else {
                    if (strpos(request()->url(), 'admin') !== false) {
                         
                    } else if(Auth::guard('web')->check()){ 
                        Auth::guard('web')->logout();
                        return redirect(route('login'));
                    }
                }
            }
        } else if (in_array($_SERVER['HTTP_HOST'], [env('ADMIN_URL', 'cms.allomate.solutions')])) {
            if (in_array(Route::currentRouteName(), $adminroutes)) {
                if (!Auth::guard('web')->check()) {
                    return redirect(route('login'));
                }
            }else{
                if (!Auth::guard('web')->check()) {
                    return redirect(route('login'));
                } else {
                    if (strpos(request()->url(), 'admin') !== false) {
                         
                    } else if(Auth::guard('web')->check()){ 
                        Auth::guard('web')->logout();
                        return redirect(route('login'));
                    }
                }
            }
        }
        return $next($request);
    }
}
