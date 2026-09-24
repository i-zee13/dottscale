<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\AccessRightsAuth;
use App\Models\admin\ThemeCss;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class ThemeCssController extends AccessRightsAuth
{
    public function index(){
        $data   =   DB::table("theme_css")->selectRaw("content,id")->whereRaw("type = 1")->first();
        $type   =   1;
        $header =   "Theme Config";
        return view('admin.theme-css.index',compact('data','type','header'));
    }
    public function getAllCss(){
        $themeData   =   FacadesDB::table("theme_css")->selectRaw("id,content,type")->get();
        $collection = collect($themeData);

        $themeData = $collection->groupBy('type')->map(function ($items) {
            return $items->toArray();
        })->toArray(); 
        return response()->JSON([
            'status'    =>  'success',
            'msg'       =>  'data fetched',
            'themeData' =>  $themeData
        ]);
    }
    public function footerindex(){
        $data   =   DB::table("theme_css")->selectRaw("content,id")->whereRaw("type = 3")->first();
        $type   =   3;
        $header =   "Footer";
        return view('admin.theme-css.index',compact('data','type','header'));
    }
    public function menuIndex(){
        $data   =   DB::table("theme_css")->selectRaw("content,id")->whereRaw("type = 2")->first();
        $type   =   2;
        $header =   "Menu";
        return view('admin.theme-css.index',compact('data','type','header'));
    }
    public function store(Request $request){
        
        if($request->content_id){
            $save           =   ThemeCss::find($request->content_id);
        }else{
            $save           =   new ThemeCss();
        }
        $save->type         =   $request->content_type;

        $save->content      =   $request->content;
        if($request->content_id){
        $save->updated_at   =   Carbon::now();
        $save->updated_by   =   GetActiveGuardDetail()->id;
        }else{
        $save->updated_at   =   null;
        $save->updated_by   =   null;
        $save->created_at   =   Carbon::now();
        $save->created_by   =   GetActiveGuardDetail()->id;
        }
        if($save->save()){
            if($request->content_type == 1){ //basic config css
                $CSSFilePath    =   public_path('css/frontend/theme_config.css');
            }elseif($request->content_type == 2){ //menu css
                $CSSFilePath    =   public_path('css/frontend/menu.css');
            }elseif($request->content_type == 3){ //footer css
                $CSSFilePath    =   public_path('css/frontend/footer.css');
            }
            
            if (file_exists($CSSFilePath)) {
                unlink($CSSFilePath);
            }
            // Write the content to the theme.css file
            file_put_contents($CSSFilePath, $request->content);
            return response()->JSON([
                'status'    =>  'success',
                'msg'       =>  'Content added successfully'
            ]);
        }else{
            return response()->JSON([
                'status'    =>  'failed',
                'msg'       =>  'Content not added successfully'
            ]);
        }
    }
}
