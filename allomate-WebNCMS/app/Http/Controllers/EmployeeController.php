<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = DB::table('designations')->get();
        $departments = DB::table('departments')->get();

        $users       = DB::table('users')->where('active', 1)->where('super', 0)->get();
        return view('auth.employee_register', compact('designations', 'departments', 'users'));
    }
    public function employee_data()
    {

        $employees = User::select(
            'users.id',
            'users.name',
            'users.designation',
            'users.department_id',
            'users.city_id',
            'users.country_id',
            'users.state_id',
            'users.cnic',
            'users.active',
            'users.reporting_to',
            'users.picture',
            'users.hiring',
            'users.phone',
            'users.address',
            'users.username',
            'users.email',
            'cities.name as city_name',
            'states.name as state_name',
            'countries.name as country_name'
        )
            ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.id')
            ->leftJoin('states', 'users.state_id', '=', 'states.id')
            ->where('super', 0)
            ->get();
        return response()->json([
            'status'            => 'success',
            'msg'               => 'Employees Records fetched',
            'employees'         =>  $employees
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
        $picture = null;
        $alreadyExistUser  = User::where('username', $request->username)->where('id', '!=', $request->employee_id)->exists();
        if ($alreadyExistUser) {
            return response()->json([
                'status'            => 'username_exist',
                'msg'               => 'Username Already Exist, Please Try Again with another username',
            ]);
        }
        if ($request->email) {
            $alreadyExistEmail = User::where('email', $request->email)->where('id', '!=', $request->employee_id)->exists();
            if ($alreadyExistEmail) {
                return response()->json([
                    'status'            => 'email_exists',
                    'msg'               => 'Email Already Exist, Please Try Again with another email',
                ]);
            }
        }
        

        if ($request->employee_id) {
            $employee                =   User::find($request->employee_id);
            $employee->updated_at    =   Carbon::now();
            $employee->updated_by    =   GetActiveGuardDetail()->id;
        } else {
            $employee                =   new User();
            $employee->created_at    =   Carbon::now();
            $employee->created_by    =   GetActiveGuardDetail()->id;
            $employee->updated_at    =   null;
            $employee->updated_by    =   null;
        }
        $employee->name              =    $request->name;
        $employee->username          =    $request->username;
        $employee->email             =    $request->email;
        $employee->phone             =    $request->phone_number;
        $employee->cnic              =    $request->id_no;
        $employee->country_id        =    $request->country_id;
        $employee->state_id          =    $request->state_id;
        $employee->city_id           =    $request->city_id;
        $employee->designation       =    $request->designation;
        $employee->department_id     =    $request->department;
        $employee->reporting_to      =    $request->reporting;
        $employee->hiring            =    $request->hiring;
        $employee->address           =    $request->address;
        if($request->hasFile('employeePicture')){
            $completeFileName   =   $request->file('employeePicture')->getClientOriginalName();
            $fileNameOnly       =   pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension          =   $request->file('employeePicture')->getClientOriginalExtension();
            $empPicture         =   str_replace(' ', '_', $fileNameOnly).'_'.time().'.'.$extension;
            $path               =   $request->file('employeePicture')->storeAs('public/employees', $empPicture);
            $employee->picture  =   '/storage/employees/'.$empPicture;
        } 
         if ($request->password) {
            $password                = bcrypt($request->password);
            $employee->password      = $password;
        }
        if ($employee->save()) {
            return response()->json([
                'status'            => 'success',
                'msg'               => 'Employee Added',
            ]);
        } else {
            return response()->json([
                'status'            => 'error',
                'msg'               => 'Employee Not Added',
            ]);
        }
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
    public function changeStatus(Request $request)
    {
        $id                   = intval($request->id);
        if ($id) {
            $user         = User::find($id);
            $user->active = !$user->active;
            $user->save();
            return response()->json([
                'status'            => $user->active,
                'msg'               => 'User id not found',
            ]);
        } else {
            return response()->json([
                'status'            => 'error',
                'msg'               => 'User id not found',
            ]);
        }
    }
}
