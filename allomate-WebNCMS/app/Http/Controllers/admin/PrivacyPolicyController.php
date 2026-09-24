<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPages;
use Illuminate\Http\Request;
use Auth;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $privacy                    =   StaticPages::WHERE('page_id','1')->first();
        return view('admin.privacy-policy',compact('privacy'));
    }
    public function terms_of_use(){
        $terms                      =   StaticPages::WHERE('page_id','2')->first();


        return view('admin.terms-of-use',compact('terms'));
    }

    public function save_privacy(Request $request){
        if($request->static_id != ''){
            $save_privacy              =   StaticPages::find($request->static_id);
        }else{
            $save_privacy              =   new StaticPages();
        }
        if ($request->hasfile('meta_og_image')) {
            $meta_og_image    =   $request->meta_og_image->store('og-images', 'public');
        } else {
            $meta_og_image    =   $request->hidden_og_img;
        }
        $seo =  storeSeo($request);
        $save_privacy->page_id         =   $request->page_id;
        $save_privacy->document        =   $request->privacy_details;
        $save_privacy->page_meta_tags  =   $seo;
        $save_privacy->meta_og_image   =   $meta_og_image;

        if($request->static_id != ''){
            $save_privacy->updated_by  =   Auth::user()->id;
        }else{
            $save_privacy->created_by  =   Auth::user()->id;
        }
        $save_privacy->save();
        return response()->json([
            'status'                    =>  'success',
            'msg'                       =>  'static_added'
        ]);
    }
    public function save_terms(Request $request){
        if($request->static_id != ''){
            $save_terms              =   StaticPages::find($request->static_id);
        }else{
            $save_terms              =   new StaticPages();
        }
        if ($request->hasfile('meta_og_image')) {
            $meta_og_image    =   $request->meta_og_image->store('og-images', 'public');
        } else {
            $meta_og_image    =   $request->hidden_og_img;
        }
        $seo =  storeSeo($request);
        $save_terms->page_id         =   $request->page_id;
        $save_terms->document        =   $request->privacy_details;
        $save_terms->page_meta_tags  =   $seo;
        $save_terms->meta_og_image   =   $meta_og_image;
        if($request->static_id != ''){
            $save_terms->updated_by  =   Auth::user()->id;
        }else{
            $save_terms->created_by  =   Auth::user()->id;
        }
        $save_terms->save();
        return response()->json([
            'status'                    =>  'success',
            'msg'                       =>  'static_added'
        ]);
    }

}
