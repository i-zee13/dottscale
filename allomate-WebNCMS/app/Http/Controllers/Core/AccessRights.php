<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Models\User as Emp;
use App\Http\Controllers\Core\AccessRightsAuth;
use App\Models\AccessRights as AR;
use App\ControllersList as CL;
use Carbon\Carbon;
use Auth;
use DB;

class AccessRights extends AccessRightsAuth
{
    public $controllerName = "AccessRights";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access_rights              =   CL::whereRaw("
                                            admin_right = 0 
                                            AND 
                                            parent_module_for IN (2,3) 
                                            AND 
                                            sub_module_for IN (2,3)
                                        ")->get()->toArray();

        $headings                   =   array_unique(array_column($access_rights, 'parent_module'));
        $controllers                =   array();
        foreach ($headings as $key => $parent) {
            $controllers[$key]['heading']   =   $parent;
            $controllers[$key]['sub_mod']   =   array_filter($access_rights, fn ($x) => $x['parent_module'] == $parent);
        }
        $investors                  =   DB::select("
                                            SELECT
                                                id,username
                                            FROM investors 
                                            WHERE 
                                                active = 1 
                                            AND
                                                id NOT IN (SELECT investor_id FROM access_rights WHERE investor_id IS NOT NULL)
                                        ");

        return view('access_rights.list', compact(['investors', 'controllers']));
    }

    public function listAllRights()
    {
        echo json_encode(AR::selectRaw('(SELECT first_name from investors where id = investor_id) as name, investor_id, count(*) as total_rights')->whereRaw("investor_id IS NOT NULL")->groupBy('investor_id')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investors  =   DB::select("
                            SELECT
                                id,username
                            FROM investors 
                            WHERE 
                                active = 1 
                            AND
                                id NOT IN (SELECT investor_id FROM access_rights WHERE investor_id IS NOT NULL)
                        ");

        $controllers    =   CL::where('admin_right', 0)->get();

        return response()->json([
            'status' => 'success',
            'investors' => $investors,
            'controllers' => $controllers

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if (AR::WHERE('investor_id', $request->investor_id)->first()) {
            return response()->json('exist');
        }
        $access_rights  =   [];
        foreach ($request->rights as $right) {
            if ($right) {
                AR::create([
                    'investor_id'       => $request->investor_id,
                    'controller_right'  => $right,
                    'created_at'        =>  Carbon::now(),
                    'created_by'        =>  GetActiveGuardDetail()->id
                ]);
            }
        }

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($investor_id)
    {

        echo json_encode(AR::where('investor_id', $investor_id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        if (AR::where('investor_id', $id)->delete()) {
            foreach ($request->rights as $right) {
                if ($right) {
                    AR::create([
                        'investor_id'       => $id,
                        'controller_right'  => $right,
                        'created_at'        =>  Carbon::now(),
                        'created_by'        =>  GetActiveGuardDetail()->id
                    ]);
                }
            }
            return response()->json('success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId)
    {
    }

    public function revokeAccRight($employeeId)
    { 
        $investors = AR::where('investor_id', $employeeId)->get();
        if ($investors->count() > 0) {
            foreach ($investors as $employee) {
                $employee->delete();
            }
            echo json_encode('success');
        }
    }
}
