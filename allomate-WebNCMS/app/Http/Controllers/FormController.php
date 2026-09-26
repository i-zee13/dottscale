<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use App\Models\DemoForm;
use Validator;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function demoForm(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email'            =>  'required',
            'company_name'     =>  'required',
            'sales_personnel'  =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'msg'     =>  'validation error',
                'status'  =>  'validation_error',
            ]);
        }
        if (DemoForm::where('email', $request->email)->first()) {
            return response()->json([
                'msg'     =>  'Email already Exist',
                'status'  =>   'duplicate',
            ]);
        } else {
            $form   = new DemoForm();
            $form->name         =   $request->name;
            $form->phone        =   $request->phone;
            $form->email        =   $request->email;
            $form->company_name =   $request->company_name;
            $form->industry     =   $request->industry;
            $form->city         =   $request->city;
            $form->message      =   $request->message;
            $form->sales_personnel  =   $request->sales_personnel;
            if ($form->save()) {
                return response()->json([
                    'msg'     =>  'Form successfully added',
                    'status'  =>   'success',
                ]);
            } else {
                return response()->json([
                    'msg'     =>  'Form failed',
                    'status'  =>   'failed',
                ]);
            }
        }
    }
    public function contactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     =>  'required',
            'subject'  =>  'required',
            'email'    =>  'required',
            'message'  =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'msg'     =>  'validation error',
                'status'  =>  'validation_error',
            ]);
        }
        if (ContactForm::where('email', $request->email)->first()) {
            return response()->json([
                'msg'     =>  'Email already Exist',
                'status'  =>   'duplicate',
            ]);
        } else {
            $form               =   new ContactForm();
            $form->name         =   $request->name;
            $form->phone        =   $request->phone;
            $form->email        =   $request->email;
            $form->subject      =   $request->subject;
            $form->message      =   $request->message;
            if ($form->save()) {
                return response()->json([
                    'msg'     =>  'Form successfully added',
                    'status'  =>   'success',
                ]);
            } else {
                return response()->json([
                    'msg'     =>  'Form failed',
                    'status'  =>   'failed',
                ]);
            }
        }
    }
}
