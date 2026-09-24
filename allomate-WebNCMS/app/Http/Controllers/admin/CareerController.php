<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;


class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::get();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }
    public function edit($id)
    {
        $career = Career::where('id', $id)->first();
        return view('admin.careers.create', compact('career'));
    }
    public function store(Request $request)
    {

        if (Career::where('title', $request->title)->where('id', '!=', $request->hidden_id)->first()) {
            return response()->json([
                'status' => 'title_duplicate',
                'msg' => "career Title already Exist",
            ]);
        }
        if ($request->hidden_id != '') {
            $career = Career::find($request->hidden_id);
        } else {
            $career = new Career();
        }
        $seo =  storeSeo($request);
        $career->title = $request->title;
        $career->status = 1;
        $career->location = $request->location;
        $career->slug = Str::slug($request->title);
        $career->description = $request->description;
        $career->created_by = Auth::user()->id;
        $career->page_meta_tags = $seo;
        $career->save();
        return response()->json([
            'status' => 'success',
            'msg' => "Data Has been Added",

        ]);
    }


    public function destroy($id)
    {
        if (Career::destroy($id)) {
            return response()->json([
                'status' => 'success',
                'msg' => "Career has Deleted",
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'msg' => "Career not Deleted",
            ]);
        }
    }

    public function changeStatus(Request $request)
    {

        Career::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return response()->json([
            'msg' => 'Status changed',
            'status' => 'success',
        ]);
    }
}
