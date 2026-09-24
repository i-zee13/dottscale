<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Core\AccessRightsAuth;
use App\Models\Brand;
use App\Models\GrossSalarySettings;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\TaxClass;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Storage;

class SettingsController extends AccessRightsAuth
{
    public function manage_settings()
    {
        $themeData   =   FacadesDB::table("theme_css")->selectRaw("id,content,type")->get();
        $collection = collect($themeData);

        $themeData = $collection->groupBy('type')->map(function ($items) {
            return $items->toArray();
        })->toArray(); 
        return view('admin.manage_settings.settings', compact('themeData'));
    }

 
    public function GetSettingsData()
    {
        $designations = DB::table('designations')->get(); 
        $departments = DB::table('departments')->get(); 
       
        echo json_encode(array( 'designations' => $designations,  'departments' => $departments  ));
    }


    public function GetDesignation($id)
    {
        echo json_encode(DB::table('designations')->where('id', $id)->first());
    }

    public function GetDepartment($id)
    {
        echo json_encode(DB::table('departments')->where('id', $id)->first());
    }

    

    public function save_settings(Request $request)
    {
        $already_exist = false;
        $insert = null;
        $update = null;
        if ($request->operation == 'add') {
            if ($request->opp_name_input == 'designation') {
                if (DB::table('designations')->where('designation', $request->designation_name)->first()) {
                    $already_exist = true;
                } else {
                    $insert = DB::table('designations')->insert([
                        'designation' => $request->designation_name,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => GetActiveGuardDetail()->id
                    ]);
                }
            } else if ($request->opp_name_input == 'department') {
                if (DB::table('departments')->where('department', $request->department_name)->first()) {
                    $already_exist = true;
                } else {
                    $insert = DB::table('departments')->insert([
                        'department' => $request->department_name,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => GetActiveGuardDetail()->id
                    ]);
                }
            }  

            if ($insert) {
                echo json_encode('success');
            } else if ($already_exist) {
                echo json_encode('already_exist');
            } else {
                echo json_encode('failed');
            }
        } else {

            if ($request->opp_name_input == 'designation') {
                if (DB::table('designations')->whereRaw('designation = "' . $request->designation_name . '" And id NOT IN (' . $request->opp_id . ')')->first()) {
                    $already_exist = true;
                } else {
                    try {
                        $update = DB::table('designations')->where('id', $request->opp_id)->update([
                            'designation' => $request->designation_name,
                             'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => GetActiveGuardDetail()->id
                        ]);
                    } catch (\Illuminate\Database\QueryException $ex) {
                        $insert = null;
                    }
                }
            } else if ($request->opp_name_input == 'department') {
                if (DB::table('departments')->whereRaw('department = "' . $request->department_name . '" And id NOT IN (' . $request->opp_id . ')')->first()) {
                    $already_exist = true;
                } else {
                    try {
                        $update = DB::table('departments')->where('id', $request->opp_id)->update([
                            'department' => $request->department_name,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => GetActiveGuardDetail()->id
                        ]);
                    } catch (\Illuminate\Database\QueryException $ex) {
                        $insert = null;
                    }
                }
            }  


            if ($update) {
                echo json_encode('success');
            } else if ($already_exist) {
                echo json_encode('already_exist');
            } else {
                echo json_encode('failed');
            }
        }
    }

    public function delete_from_settings(Request $request)
    {
        if ($request->type == "designation") {
            $delete = DB::table('designations')->where('id', $request->id)->delete();
        } else if ($request->type == "departments") {
            $delete = DB::table('departments')->where('id', $request->id)->delete();
        }  

        if ($delete) {
            echo json_encode('success');
        } else {
            echo json_encode('failed');
        }
    }

    public function save_currency(Request $request)
    {
        $data['module'] = 'Organization Detail';
        $data['setting_name'] = 'currency';
        $data['setting_value'] = $request->id;
        $data['updated_by'] = GetActiveGuardDetail()->id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $currencySetting = Setting::where(['module' => 'Organization Detail', 'setting_name' => 'currency'])->first();
        if ($currencySetting) {

            $currencySetting->update($data);
        } else {
            $data['created_by'] = GetActiveGuardDetail()->id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $currencySetting = new Setting($data);
            $currencySetting->save();
        }
        echo 'updated';
    }

    public function save_free_category(Request $request)
    {
        $data['module'] = 'Organization Detail';
        $data['setting_name'] = 'free_category';
        $data['setting_value'] = $request->id;
        $data['updated_by'] = GetActiveGuardDetail()->id;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $currencySetting = Setting::where(['module' => 'Organization Detail', 'setting_name' => 'free_category'])->first();
        if ($currencySetting) {
            $currencySetting->update($data);
        } else {
            $data['created_by'] = GetActiveGuardDetail()->id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $currencySetting = new Setting($data);
            $currencySetting->save();
        }
        echo 'updated';
    }
}
