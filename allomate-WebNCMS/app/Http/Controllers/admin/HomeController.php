<?php

namespace App\Http\Controllers\admin;

use Auth;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\Investors;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __construct()
    {

    }


    public function index()
    {
        if ($this->isAdminHost()) {
            $current_time = Carbon::now();
            $message = '';

            if ($current_time->hour < 12) {
                $message = 'Good Morning';
            } elseif ($current_time->hour >= 12 && $current_time->hour < 18) {
                $message = 'Good Afternoon';
            } else {
                $message = 'Good Evening';
            }
            $todayInquiries = Schema::hasTable('contact_us_forms')
                ? DB::table('contact_us_forms')->whereDate('created_at', Carbon::today())->count()
                : 0;
            $todaySFRForms = 0;
            return view('admin.index', compact('message', 'todayInquiries', 'todaySFRForms'));
        }

        $categories = Schema::hasTable('reports_types')
            ? DB::table('reports_types')->where('status', 1)->get()
            : collect();
        return view('investor.index', compact('categories'));
    }

    private function isAdminHost(): bool
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $allowed = ['localhost', '127.0.0.1', '127.0.0.1:8001', 'staging.dottscale.com', 'www.demo.crm.allomate.solutions'];

        foreach ([env('ADMIN_URL', 'demo.crm.allomate.solutions'), env('APP_URL')] as $url) {
            if (!$url) {
                continue;
            }
            $parsed = parse_url(str_contains($url, '://') ? $url : 'http://' . $url);
            if (!empty($parsed['host'])) {
                $allowed[] = $parsed['host'];
                if (!empty($parsed['port'])) {
                    $allowed[] = $parsed['host'] . ':' . $parsed['port'];
                }
            }
        }

        return in_array($host, array_unique($allowed), true);
    }

    public function GetAboutUsPage()
    {
        return view('admin.about');
    }
    public function GetHomePage()
    {
        $meta_content_author        = '';
        $meta_content_keywords      = '';
        $meta_content_description   = '';
        $meta_og_title              = '';
        $meta_og_description        = '';
        $data = Home::first();
        if ($data && !empty($data->page_meta_tags)) {
            $page_meta = is_string($data->page_meta_tags)
                ? json_decode($data->page_meta_tags)
                : $data->page_meta_tags;
            if (is_array($page_meta) || is_object($page_meta)) {
                foreach ($page_meta as $meta) {
                    $meta = (object) $meta;
                    $meta_content_author      = $meta->meta_content_author ?? '';
                    $meta_content_keywords    = $meta->meta_content_keywords ?? '';
                    $meta_content_description = $meta->meta_content_description ?? '';
                    $meta_og_title            = $meta->meta_og_title ?? '';
                    $meta_og_description      = $meta->meta_og_description ?? '';
                }
            }
        }
        return view('admin.home', compact(
            'data',
            'meta_content_author',
            'meta_content_keywords',
            'meta_content_description',
            'meta_og_title',
            'meta_og_description'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'heading_1'      => 'required',
            'heading_2'      => 'required',
            'large_heading'  => 'required',
            'paragraph'      => 'required',
            'award_heading'  => 'required',
        ]);

        $about = $request->id != '' ? Home::find($request->id) : new Home();
        if (!$about) {
            $about = new Home();
        }

        $about->heading_1 = $request->heading_1;
        $about->heading_2 = $request->heading_2;

        foreach (['desktop_img', 'tab_img', 'mobile_img', 'award_img'] as $field) {
            $hidden = 'hidden_' . $field;
            if ($request->hasFile($field)) {
                $about->{$field} = $request->{$field}->store('images', 'public');
            } else {
                $about->{$field} = $request->{$hidden};
                if ($request->{$hidden} == '') {
                    return response()->json([
                        'status' => 'error',
                        'msg'    => 'Image Should Not be Empty',
                    ]);
                }
            }
        }

        if ($request->hasFile('meta_og_image')) {
            $meta_og_image = $request->meta_og_image->store('og-images', 'public');
        } else {
            $meta_og_image = $request->hidden_og_image ?: $request->hidden_og_img;
        }

        $metaArray = $request->meta_array;
        if (is_array($metaArray)) {
            $metaArray = json_encode($metaArray);
        }

        $about->large_heading  = $request->large_heading;
        $about->award_heading  = $request->award_heading;
        $about->paragraph      = $request->paragraph;
        $about->page_meta_tags = $metaArray;
        $about->meta_og_image  = $meta_og_image;
        $about->created_by     = $about->created_by ?: Auth::user()->id;
        $about->updated_by     = Auth::user()->id;
        $about->save();

        return response()->json([
            'status' => 'success',
            'msg'    => 'Data Has been Added',
        ]);
    }

    // Investor Report Detail
    public function investorReportDetail($slug){
        $record =   DB::table('reports')->whereRaw("slug = '$slug'")->first();
        return view('investor.report-detail',compact('record'));
    }
    public function getAllReports(Request $request){
        $start_date =   $request->startDate;
        $end_date   =   $request->endDate;
        $categoryId =   $request->categoryId;
        $searchValue=   $request->searchValue;
        if($start_date == "" && $start_date == ""){
            $start_date =   date('Y-m-01');
            $end_date   =   date('Y-m-t');
        }
        $where      =   " DATE(re.publish_date) BETWEEN '$start_date' AND '$end_date' AND re.status = 1" ;
        if($categoryId){
            $where  .=  " AND report_type_id = $categoryId";
        }
        if($searchValue){
            $where  .=  " AND report_title LIKE '%$searchValue%'";
        }
        $records    =   DB::select("
                            SELECT
                                re.id,
                                re.report_title,
                                re.report_type_id,
                                re.publish_date,
                                re.slug,
                                rt.report_type as category_name
                            FROM
                            reports re
                            LEFT JOIN reports_types rt ON re.report_type_id = rt.id
                            WHERE
                                $where
                            ORDER BY re.publish_date DESC
                        ");
        return response()->JSON([
            'status'    =>  'success',
            'records'   =>  $records
        ]);
    }
    public function investorProfile(){
        $loginId    =   GetActiveGuardDetail()->id;
        $record     =   DB::table('investors')->whereRaw("id = $loginId")->first();
        $countries  =   DB::table('countries')->get();
        $states     =   DB::table('states')->get();
        $cities     =   DB::table('cities')->get();
        return view('investor.investor-profile',compact('record','countries','states','cities'));
    }

    public function changeInvestorPassword(Request $request)
    {
        $loginId    =   GetActiveGuardDetail()->id;
        if($loginId){
            if($request->password){
                $updatePassword                     =   Investors::find($loginId);
                $updatePassword->password           =   bcrypt($request->password);
                $updatePassword->password_changed   =   1;
                if($updatePassword->save()){
                    return response()->JSON([
                        'status'    =>  'success',
                        'msg'       =>  'Password change successfully'
                    ]);
                }else{
                    return response()->JSON([
                        'status'    =>  'error',
                        'msg'       =>  'Password not updated at this moment'
                    ]);
                }
            }else{
                return response()->JSON([
                    'status'    =>  'error',
                    'msg'       =>  'Please add password first'
                ]);
            }
        }else{
            return response()->JSON([
                'status'    =>  'error',
                'msg'       =>  'User Id not found'
            ]);
        }
    }
    // Update Investor Profile
    public function updateInvestorProfile(Request $request){
        $loginId                =   GetActiveGuardDetail()->id;
        if($loginId){
            $save               =   Investors::find($loginId);
            $save->first_name   =   $request->first_name;
            $save->last_name    =   $request->last_name;
            $save->name         =   $request->first_name . ' ' . $request->last_name;
            $save->address      =   $request->address;
            $save->phone        =   $request->phone;
            $save->country      =   $request->country_id;
            $save->city         =   $request->city_id;
            $save->state        =   $request->state_id;
            $save->updated_at   =   Carbon::now();
            $save->updated_by   =   GetActiveGuardDetail()->id;
            if($save->save()){
                return response()->JSON([
                    'status'    =>  'success',
                    'msg'       =>  'Profile updated successfully'
                ]);
            }else{
                return response()->JSON([
                    'status'    =>  'error',
                    'msg'       =>  'Profile not updated at this moment'
                ]);
            }
        }else{
            return response()->JSON([
                'status'        =>  'error',
                'msg'           =>  'User Id not found'
            ]);
        }
    }
    public function ResetPasswordFirst(){
        if(GetActiveGuardDetail()->is_web == 1){
            return view('auth.passwords.reset-password-first');
        }else{
            return view('investor_auth.reset-password-first');
        }
    }
    public function employeeResetPasswordFirst(){
        return view('investor_auth.reset-password-first');
    }
    public function UpdatePasswordFirst(Request $request){
        $is_web                     =   GetActiveGuardDetail()->is_web;
        $user_id                    =   decrypt($request->user_id);
        if($is_web == 0){
            $employee               =   Investors::find($user_id);
        }else{
            $employee               =   User::find($user_id);
        }
        $employee->password         =   bcrypt($request->confirm_password);
        $employee->password_changed =   '1';
        if($employee->save()){
            echo json_encode("success");
            die;
        }else{
            echo json_encode("failed");
            die;
        }
    }
}
