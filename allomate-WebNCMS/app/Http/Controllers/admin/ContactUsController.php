<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Auth;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $meta_content_author        = '';
        $meta_content_keywords      = '';
        $meta_content_description   = '';
        $meta_og_title              = '';
        $meta_og_description        = '';
        $all_records    =   ContactUs::first();
        $page_meta      =   json_decode($all_records->page_meta_tags); 
        if($page_meta !=''){
            foreach($page_meta as $meta){
                $meta_content_author        = $meta->meta_content_author;
                $meta_content_keywords      = $meta->meta_content_keywords;
                $meta_content_description   = $meta->meta_content_description;
                $meta_og_title              = $meta->meta_og_title;
                $meta_og_description        = $meta->meta_og_description;
            }
        }
        return view('admin.contact',compact('all_records','meta_content_author',
        'meta_content_keywords','meta_content_description','meta_og_title',
        'meta_og_description'));
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
        $validate = $this->validate($request, [
            'heading_one'           =>  'required',
            'heading_two'           =>  'required',
            'large_heading_one'     =>  'required',
            'large_paragraph_one'   =>  'required',
            'large_heading_two'     =>  'required',
            'large_paragraph_two'   =>  'required',
        ]);
        if($request->contact_id !=''){
            $save_contact                   =   ContactUs::find($request->contact_id);
        }else{
            $save_contact                   =   new ContactUs();
        }

        if ($request->hasfile('meta_og_image')) {
            $meta_og_image    =   $request->meta_og_image->store('og-images', 'public');
        } else {
            $meta_og_image    =   $request->hidden_og_img;
        }
        $save_contact->heading_one          =  $request->heading_one;
        $save_contact->heading_two          =  $request->heading_two;
        $save_contact->large_heading_one    =  $request->large_heading_one;
        $save_contact->large_paragraph_one  =  $request->large_paragraph_one;
        $save_contact->large_heading_two    =  $request->large_heading_two;
        $save_contact->large_paragraph_two  =  $request->large_paragraph_two;
        $save_contact->page_meta_tags       =  $request->meta_array;
        $save_contact->meta_og_image        =  $meta_og_image;
        if($request->contact_id !=''){
            $save_contact->updated_by       =   Auth::user()->id;
            }else{
            $save_contact->created_by       =   Auth::user()->id;
            }
        $save_contact->save();
        return response()->JSON([
            'status'                        =>  'success',
            'msg'                           =>  'contact_added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
