<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientLogo;
use Illuminate\Http\Request, Auth;

class ClientLogoController extends Controller
{
    public function index()
    {
        return view('admin.client-logo.index');
    }
    public function getAllClientsList()
    {
        $records        =   ClientLogo::orderBy('sequence', 'asc')->get();
        return response()->JSON([
            'status'    =>  'success',
            'records'   =>  $records
        ]);
    }
    public function store(Request $request)
    {
        if ($request->hidden_client_id) {
            $client                 =   ClientLogo::find($request->hidden_client_id);
            $client->updated_by     =   Auth::user()->id;
            $client->updated_at     =   date('Y-m-d');
        } else {
            $client             =   new ClientLogo();
        }
        $client->sequence       =   $request->sequence;
        $client->name           =   $request->name;
        if ($request->hasFile('logo')) {
            $client->logo       =   $request->logo->store('client_logos', 'public');
        } else {
            $client->logo       =   $request->logo_hidden;
            if ($request->logo_hidden == '') {
                return response()->json([
                    'status'   =>  'logo_missing',
                    'msg'      =>  'logo missing'
                ]);
            }
        }
        $client->alt_text           =   $request->alt_text;
        $client->created_by         =   Auth::user()->id;
        $client->created_at         =   date('Y-m-d');
        if ($client->save()) {
            return response()->JSON([
                'status'                =>  'success',
                'msg'                   =>  'success'
            ]);
        }
    }
    public function deleteClient(Request $request)
    {
        if (ClientLogo::WHERE('id', $request->id)->delete()) {
            return response()->JSON([
                'status'    =>  'success',
                'msg'       =>  'deleted'
            ]);
        } else {
            return response()->JSON([
                'status'    =>  'failed',
                'msg'       =>  'failed'
            ]);
        }
    }
}
