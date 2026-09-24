<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Leads;
 
use Illuminate\Http\Request;
use Auth;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.leads');
    }
    public function all_leads_list(){
        $all_leads          =   Leads::all();
        return response()->JSON([
            'status'        =>  'success',
            'all_leads'     =>  $all_leads
        ]);
    }
    public function delete_lead(Request $request){
       if(Leads::where('id',$request->id)->delete()){
        return response()->JSON([
            'status'    =>   'success',
            'msg'       =>   'lead_deleted'
    ]);
       }else{
        return response()->JSON([
            'status'    =>   'failed',
            'msg'       =>   'failed'
    ]);
       }
     
    }
    public function update_lead(Request $request){
        $update_lead         =  Leads::where('id',$request->lead_id)->update([
            'status'         => $request->radio_status
        ]);
        if($request->radio_status == '2'){
            if (Client::WHERE('email', $request->email)
                        ->WHERE('first_name',$request->first_name)
                        ->WHERE('last_name',$request->last_name)
                        ->WHERE('primary_cellphone',$request->phone_no)
                        ->first())
            {
                return response()->JSON([
                        'status'            =>      'error',
                        'msg'               =>      'already_exists',
                ]);
            }
            $new_client                     =    new Client();
            $new_client->first_name         =    $request->first_name;
            $new_client->last_name          =    $request->last_name;
            $new_client->email              =    $request->email;
            $new_client->primary_cellphone  =    $request->phone_no;
            $new_client->created_by         =    Auth::user()->id;
            $new_client->save();
        }
        return response()->JSON([
            'status'         =>   'success',
            'msg'            =>   'lead_update'
    ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
