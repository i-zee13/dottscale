<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use DB;
 
use App\Models\SubSecondaryServices;
use Auth;

class ServiceController extends Controller
{
  public function portfolios()
  { $categories = PortfolioCategory::select('id','service_name')->where('publish',1)->get();
    return view('admin.portfolios',compact('categories'));
  }
  public function getBlogsCategories()
  {
    $categoires       =   BlogCategory::get();
    return response()->json([
      'status'      =>  'success',
      'msg'         =>  'Blogs Categoires fetched',
      'categoires'  =>  $categoires
    ]);
  }
  public function saveBlogCategory(Request $request)
  {
    if ($request->hidden_category_id) {
      $query  =    BlogCategory::where('service_name', $request->service_name)
        ->where('id', '!=', $request->hidden_category_id)->first();
      if ($query) {
        return response()->json([
          'msg'   => 'duplicate',
          'status' =>  'error',
        ]);
      }
      $category   = BlogCategory::where('id', $request->hidden_category_id)->first();
    } else {
      if (BlogCategory::where('service_name', $request->service_name)->first()) {
        return response()->json([
          'msg'   => 'duplicate',
          'status' =>  'error',
        ]);
      }
      $category = new BlogCategory();
    }
    $category->service_name   =  $request->service_name;
    $category->publish       = $request->publish_service;
    $category->created_by    = Auth::user()->id;

    if ($category->save()) {
      return response()->json([
        'msg'   => 'Added',
        'status' =>  'success',
      ]);
    }
  }
  public function deleteCategory($id)
  {
    $location    =   BlogCategory::destroy($id);
    return response()->json([
      'status'    =>  'success',
      'msg'       =>  "BlogCategory has Deleted",
      'location'  =>  $location
    ]);
  }
  public function getBlogCategory($id)
  {
    $category    =  BlogCategory::where('id', $id)->first();
    return response()->json([
      'status'      =>  'success',
      'msg'         =>  'Blogs category fetched',
      'category'     =>  $category
    ]);
  } 
  public function getSubSecondaryServices()
  {
    return view('admin.services.blogs-categories');
  } 
  public function loadPortfolios()
  {
    $primary_services = Portfolio::get();
    $page             = DB::table('pagebuilder__pages')
                            ->where('pagebuilder__pages.page_type', 2)
                            ->WhereRaw('(pagebuilder__pages.secondary_service_id IS NULL || pagebuilder__pages.secondary_service_id = 0)')
                            ->WhereRaw('(pagebuilder__pages.sub_secondary_service_id IS NULL || pagebuilder__pages.sub_secondary_service_id = 0)')
                            ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
                            ->select('pagebuilder__pages.*', 'pagebuilder__page_translations.route as route')
                            ->get();

    $primary_services = collect($primary_services)->map(function ($x) use ($page) {
                            $x->page = collect($page)->where('portfolio_id', $x->id);
                            return $x;
                        });

    return response()->json(['primary_services' => $primary_services]);
  }
}
