<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\User as User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use URL;

class AccessRightsAuth extends Controller
{

    protected $user;

    function __construct(Request $request){
      
        if(Auth::guard('web')->check()){
        $this->middleware('auth');
        }
        $this->middleware(function ($request, $next) {
            if(Auth::guard('web')->check()){
                $this->user = Auth::user();
            }
            if(Auth::guard('investor')->check()){
                $this->user = Auth::guard('investor')->user();
            }
            return $next($request);
        });
    }

 

    public function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

}
