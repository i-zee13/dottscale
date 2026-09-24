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

class PortfolioCategoryController extends Controller
{
  public function index()
  { 
    return view('admin.services.portfolio-categories');
  }
  public function getPorfolioCategories()
  {
    $categoires       =   PortfolioCategory::get();
    return response()->json([
      'status'      =>  'success',
      'msg'         =>  'Portfolio Categoires fetched',
      'categoires'  =>  $categoires
    ]);
  }
  public function savePortfolioCategory(Request $request)
  {
    if ($request->hidden_category_id) {
      $query  =    PortfolioCategory::where('service_name', $request->service_name)
        ->where('id', '!=', $request->hidden_category_id)->first();
      if ($query) {
        return response()->json([
          'msg'   => 'duplicate',
          'status' =>  'error',
        ]);
      }
      $category   = PortfolioCategory::where('id', $request->hidden_category_id)->first();
    } else {
      if (PortfolioCategory::where('service_name', $request->service_name)->first()) {
        return response()->json([
          'msg'   => 'duplicate',
          'status' =>  'error',
        ]);
      }
      $category = new PortfolioCategory();
    }
    $category->service_name   =  $request->service_name;
    $category->publish        = $request->publish_service != null ? $request->publish_service : 1;
 
    $category->created_by     = Auth::user()->id;

    if ($category->save()) {
      return response()->json([
        'msg'   => 'Added',
        'status' =>  'success',
      ]);
    }
  }
  public function deleteCategory($id)
  {
    $location    =   PortfolioCategory::destroy($id);
    return response()->json([
      'status'    =>  'success',
      'msg'       =>  "BlogCategory has Deleted",
      'location'  =>  $location
    ]);
  }
  public function getPortfolioCategory($id)
  {
    $category    =  PortfolioCategory::where('id', $id)->first();
    return response()->json([
      'status'      =>  'success',
      'msg'         =>  'Portfolio category fetched',
      'category'     =>  $category
    ]);
  } 
 
  
}
