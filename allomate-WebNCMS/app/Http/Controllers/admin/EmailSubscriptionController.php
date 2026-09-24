<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscription;

use Illuminate\Http\Request;

class EmailSubscriptionController extends Controller
{
    public function subscriptionEmail(Request $request){
      
        $request->validate([
            'email'    => 'required|email',
        ]);
        if( EmailSubscription::where('email', $request->email)->first()){
            return response()->json([
                'status'    =>  'duplicate',
                'msg'       =>  "Email Duplication Error",
            ]);
        }else{
        $subscription_email  =  EmailSubscription::create([
                                'email'       =>    $request->email,
                                ]);
                            }
        return response()->json([
            'status'    =>  'success',
            'msg'       =>  "Subscription  Has Sent",
            'email'     =>  $subscription_email,
        ]);
       }
       public function showSubscriptions(){
        $data       =       EmailSubscription::all();
        return view('admin.subscriptions',compact('data'));

       }
       public function deleteEmail($id){
        $email    =   EmailSubscription::destroy($id);
        return response()->json([
         'status'    =>  'success',
         'msg'       =>  "email has Deleted",
         'email'     =>  $email
     ]); 
     }
}
