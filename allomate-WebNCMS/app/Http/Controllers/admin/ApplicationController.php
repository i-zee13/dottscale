<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('admin.applications');
    }
    public function all_applications_list(){
        $applications    =    $applications    =   ApplicationForm::selectRaw('application_forms.*,
                                                                     (SELECT title FROM careers WHERE id = application_forms.application_for) as title')->get();
        return response()->JSON([
            'status'        =>  'success',
            'applications'     =>  $applications
        ]);
    }
    public function delete_application(Request $request){
       if(ApplicationForm::where('id',$request->id)->delete()){
        return response()->JSON([
            'status'    =>   'success',
            'msg'       =>   'Application deleted'
    ]);
       }else{
        return response()->JSON([
            'status'    =>   'failed',
            'msg'       =>   'failed'
    ]);
       }
       
    }
}
