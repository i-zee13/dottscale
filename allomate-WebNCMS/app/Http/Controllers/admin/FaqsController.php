<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Faqs;

use App\Models\SecondaryServices;
use App\Models\SubSecondaryServices;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //page status 2 = Publish
        $pages = collect();
        return view('admin.faqs', compact('pages'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_faqs_list(Request $request)
    {
        $all_faqs       =   Faqs::all();
        return response()->JSON([
            'status'    =>      'success',
            'all_faqs'  =>      $all_faqs,
        ]);
    }

    public function sub_secondary_services($id)
    {
        $sub_secondary_services     =   SubSecondaryServices::where('secondary_service_id', $id)
            ->where('publish', '1')
            ->get();
        return response()->JSON([
            'status'                =>  'success',
            'sub_sec_services'      =>   $sub_secondary_services,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_faqs(Request $request)
    {
        $validate = $this->validate($request, [
            'faq_type'            =>  'required',
            'faq_question'        =>  'required',
            // 'faq_answer'          =>  'required',
        ]);
        if ($request->hidden_faq_id != '') {
            $save_faq                =   Faqs::find($request->hidden_faq_id);
        } else {
            $save_faq                =   new Faqs();
        }
        $save_faq->faq_type          =   $request->faq_type;
        if (intval($request->faq_type) == 2) {
            $save_faq->page_id       =   $request->page_id;
        } else {
            $save_faq->page_id       =  null;
        }
        $save_faq->question          =   $request->faq_question;
        $save_faq->answer            =   $request->faq_details;
        if ($request->hidden_faq_id != '') {
            $save_faq->updated_by    =   Auth::user()->id;
        } else {
            $save_faq->created_by    =   Auth::user()->id;
        }
        $save_faq->save();
        return response()->JSON([
            'status'              =>  'success',
            'msg'                 =>  'faq_added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_faqs              =   Faqs::where('id', $id)->first();
        return response()->JSON([
            'status'            =>   'success',
            'faqs_result'       =>    $edit_faqs
        ]);
    }
    public function faq_status_change(Request $request)
    {
        $status_faqs            =   Faqs::where('id', $request->id)->update([
            'status'            =>  $request->faq_status,
        ]);
        return response()->JSON([
            'status'            =>   'success',
            'msg'               =>   'status_change'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_faq(Request $request)
    {
        $delete_faq         =   Faqs::where('id', $request->id)->delete();
        return response()->JSON([
            'status'    =>   'success',
            'msg'       =>   'faq_deleted'
        ]);
    }
}
