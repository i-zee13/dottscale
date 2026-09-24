<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestorRequest;
use App\Models\Investors;
use App\Models\ReportsModel;
use App\Models\ReportsTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDO;

use Illuminate\Support\Str;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $report_types = ReportsTypes::where('status', 1)->select('id', 'report_type')->get();
        return view('admin.reports.reports', compact('report_types'));
    }
    public function reportsTypePage()
    {
        return view('admin.reports.reports_types');
    }
    public function fetchReportsRecords()
    {
        $reportsTypes = ReportsTypes::all();
        return response()->json([
            'status'            => 'success',
            'msg'               => 'Reports types Records fetched',
            'reportsTypes'      =>  $reportsTypes
        ]);
    }
    public function fetchReportsList()
    {

        $reports = ReportsModel::select('reports.*', 'reports_types.report_type as report_type_name')
            ->leftjoin('reports_types', 'reports.report_type_id', 'reports_types.id')->get();
        return response()->json([
            'status'            => 'success',
            'msg'               => 'Investor Records fetched',
            'reports'         =>  $reports
        ]);
    }
    public function investorsList()
    {
        $investors = Investors::select('investors.*', 'countries.name as country_name', 'cities.name as city_name', 'states.name as state_name')
            ->leftjoin('countries', 'investors.country', 'countries.id')
            ->leftjoin('cities', 'investors.city', 'cities.id')
            ->leftjoin('states', 'investors.state', 'states.id')->get();
        return response()->json([
            'status'            => 'success',
            'msg'               => 'Investor Records fetched',
            'investors'         =>  $investors
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
        $report_file = '';
        $isReportExists = ReportsModel::where('report_title', $request->report_title)->where('id', '!=', $request->report_id)->exists();
        if ($isReportExists) {
            return response()->json([
                'status'            => 'exist',
                'msg'               => 'Report title already exist',
            ]);
        }
        if ($request->report_id) {
            $saveReport               =   ReportsModel::find($request->report_id);
            $saveReport->updated_at   =   Carbon::now();
            $saveReport->updated_by   =   GetActiveGuardDetail()->id;
        } else {
            $saveReport               =   new ReportsModel();
            $saveReport->created_at   =   Carbon::now();
            $saveReport->created_by   =   GetActiveGuardDetail()->id;
            $saveReport->updated_at   =   null;
            $saveReport->updated_by   =   null;
        }
        if ($request->hasFile('report_file')) {
            $completeFileName         =   $request->file('report_file')->getClientOriginalName();
            $fileNameOnly             =   pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension                =   $request->file('report_file')->getClientOriginalExtension();
            $report                   =   str_replace(' ', '_', $fileNameOnly) . '_' . time() . '.' . $extension;
            $path                     =   $request->file('report_file')->storeAs('public/reports/reportsFiles/', $report);
            $report_file              =   '/storage/reports/reportsFiles/' . $report;
        } else {
            $report_file              =    $request->hidden_report_file;
        }
        if ($saveReport) {
            $saveReport->report_type_id         =   $request->report_type_id;
            $saveReport->report_title           =   $request->report_title;
            $saveReport->report_description     =   $request->report_description;
            $saveReport->publish_date           =   $request->publish_date;
            $saveReport->report_file            =   $report_file;
            $saveReport->slug                   =   Str::slug($request->report_title);
            $saveReport->save();
            return response()->json([
                'status'            => 'success',
                'msg'               => 'Report Created',
            ]);
        } else {
            return response()->json([
                'status'            => 'error',
                'msg'               => 'some error occured while saving report',
            ]);
        }
    }
    public function saveReportType(Request $request)
    {
        $is_report_type_exist = ReportsTypes::where('report_type', $request->report_type)->where('id', '!=', $request->report_type_id)->exists();
        if ($is_report_type_exist) {
            return response()->json([
                'status'            => 'exist',
                'msg'               => 'Report type already exist',
            ]);
        }
        if ($request->report_type_id) {
            $saveType               =   ReportsTypes::find($request->report_type_id);
            $saveType->updated_at   =   Carbon::now();
            $saveType->updated_by   =   GetActiveGuardDetail()->id;
        } else {
            $saveType               =   new ReportsTypes();

            $saveType->created_at   =   Carbon::now();
            $saveType->created_by   =   GetActiveGuardDetail()->id;
            $saveType->updated_at   =   null;
            $saveType->updated_by   =   null;
        }

        if ($saveType) {
            $saveType->report_type = $request->report_type;
            $saveType->save();
            return response()->json([
                'status'            => 'success',
                'msg'               => 'Investor Created',
            ]);
        } else {
            return response()->json([
                'status'            => 'error',
                'msg'               => 'Data Fetched',
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
    public function chagneStatus(Request $request)
    {
        $id                     = intval($request->id);
        $entity                 = $request->entity; 
        if ($id) {
            if($entity == 'reports'){
                $model         = ReportsModel::find($id);
            }else{

                $model         = ReportsTypes::find($id);
            }
            $model->status = !$model->status;
            $model->save();
            return response()->json([
                'status'        => $model->status,
            ]);
        } else {
            return response()->json([
                'status'            => 'error',
                'msg'               => 'Report not found',
            ]);
        }
    }
}
