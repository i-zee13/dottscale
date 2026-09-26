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
      
class EmployeeAccessRights extends AccessRightsAuth
{
    public $controllerName = "EmployeeAccessRights";
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $access_rights              =   CL::whereRaw("admin_right = 0")->get()->toArray();
        $headings                   =   array_unique(array_column($access_rights, 'parent_module'));
        $controllers                =   array();
        foreach($headings as $key => $parent){
            $controllers[$key]['heading']   =   $parent;
            $controllers[$key]['sub_mod']   =   array_filter($access_rights, fn($x) => $x['parent_module'] == $parent);
        }
        $employees                  =   DB::select("
                                            SELECT
                                                id,username
                                            FROM users 
                                            WHERE 
                                                active = 1
                                            AND
                                                super = 0
                                            AND
                                                id NOT IN (SELECT admin_id FROM access_rights WHERE admin_id IS NOT NULL)
                                        ");
        return view('access_rights.employee_rights', compact(['employees','controllers']));
        
    }

    public function listAllRights()
    {
        echo json_encode(AR::selectRaw('(SELECT name from users where id = admin_id) as name, admin_id, count(*) as total_rights')->whereRaw("admin_id IS NOT NULL")->groupBy('admin_id')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $employees  =   DB::select("
                            SELECT
                                id,username
                            FROM users 
                            WHERE 
                                active = 1
                            AND
                                super = 0
                            AND
                                id NOT IN (SELECT admin_id FROM access_rights WHERE admin_id IS NOT NULL)
                        ");
    
    $controllers    =   CL::where('admin_right', 0)->get();
    
    return response()->json([
        'status' => 'success',
        'employees' => $employees,
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
         if (AR::WHERE('admin_id', $request->employee_id)->first()) {
            return response()->json('exist');
        }
        $access_rights  =   [];
        foreach ($request->rights as $right) {
            if($right){
                AR::create([
                    'admin_id'       => $request->employee_id,
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
    public function show($employee_id)
    {

        echo json_encode(AR::where('admin_id', $employee_id)->get());
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
        if(AR::where('admin_id', $id)->delete()){
            foreach ($request->rights as $right) {
                if($right){
                    AR::create([
                        'admin_id'       => $id,
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

    public function revokeAccRight($employeeId){

        $employees = AR::where('admin_id', $employeeId)->get();
        if ($employees->count() > 0) {
            foreach ($employees as $employee) {
                $employee->delete();
            }
            echo json_encode('success');   
        }
    }
    
}