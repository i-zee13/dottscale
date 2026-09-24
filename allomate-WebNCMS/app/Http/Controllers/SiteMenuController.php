<?php

namespace App\Http\Controllers;

use App\Collections;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\MainCategory;
use App\Models\MainWebMenu;
use App\Models\WebsiteMenu as Menu;
use App\Models\WebsiteMenuItem as MenuItem;
use App\Models\Property;
use App\Models\RightWebMenu;
use App\Models\SubCategory;
use App\Models\SubSecondaryWebMenu;
use App\Models\SubWebMenu;
use App\Models\WebsiteMenu;
use App\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL as FacadesURL;
use URL;

class SiteMenuController extends Controller
{
    public function leftMenu()
    {
        $pages  =  [
            (object)['title' => 'Terms of Use', 'url' => '/terms-of-use'],
            (object)['title' => 'Privacy Policy', 'url' => '/privacy-prolicy']
        ];
        $record             =   $this->getData();
        $new_pages_cat      =   DB::table('pagebuilder__pages')
                                        ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
                                        ->select('pagebuilder__pages.name as title', 'pagebuilder__page_translations.route as url')
                                        ->get();

        return view('admin.website-menu.left',  compact('record', 'pages', 'new_pages_cat'));
    }
    public function rightMenu()
    {
        $pages  =  [
            (object)['title' => 'Terms of Use', 'url' => '/terms-of-use'],
            (object)['title' => 'Privacy Policy', 'url' => '/privacy-prolicy']
        ];
        $record             =   $this->getRightMenuData();
        $new_pages_cat      =   DB::table('pagebuilder__pages')
                                        ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
                                        ->select('pagebuilder__pages.name as title', 'pagebuilder__page_translations.route as url','pagebuilder__pages.page_type')
                                        ->get();
           $menuArray = [];
        foreach ($new_pages_cat as $menuItem) {
            $page = ($menuItem->page_type == 1 ? 'Home Pages' : ($menuItem->page_type == 2 ? 'Portfolio Pages' : ($menuItem->page_type == 3 ? 'General Pages' : 'Offer Pages')));
            $menuArray[$page][] = [  
                'title'             => $menuItem->title,
                'url'               => $menuItem->url, 
            ];
        }                      
        $new_pages_cat = $menuArray;
        return view('admin.website-menu.right',  compact('record', 'pages', 'new_pages_cat'));
    }
    public function getRightMenuData()
    {
        $mainWebMenus   = DB::table('right_web_menu')->orderBy('id', 'asc')->get();
        $structuredData = [];
        $main_titles    = [];
        foreach ($mainWebMenus as $mainWebMenu) {
            $menuItem = [
                'id'           =>    $mainWebMenu->id,
                'title'        =>    $mainWebMenu->title,
                'url'          =>    $mainWebMenu->url,
                'new_window'   =>    $mainWebMenu->_blank,
                'type'         =>    $mainWebMenu->type,
                'sub_menu'     =>    []
            ];
            $main_titles[] = $mainWebMenu->main_title;
            $structuredData[] = $menuItem;
        }
        return  ['structuredData' => $structuredData , 'main_titles' => $main_titles];
    }
    public function getData()
    {

        $mainWebMenus = MainWebMenu::orderBy('id', 'asc')->get();
        $structuredData = [];
        foreach ($mainWebMenus as $mainWebMenu) {
            $menuItem = [
                'id'           =>    $mainWebMenu->id,
                'title'        =>    $mainWebMenu->title,
                'url'          =>    $mainWebMenu->url,
                'new_window'   =>    $mainWebMenu->_blank,
                'sub_menu'     =>    []
            ];


            $subWebMenus = SubWebMenu::where('main_menu_id', $mainWebMenu->id)->orderBy('id', 'asc')->get();
            foreach ($subWebMenus as $subWebMenu) {
                $subMenuItem = [
                    'url'           =>  $subWebMenu->url,
                    'title'         =>  $subWebMenu->title,
                    'new_window'    =>  $subWebMenu->_blank,
                    'sub_SubMenu'   =>  []
                ];
                $subSecondaryWebMenus = SubSecondaryWebMenu::where('sub_menu_id', $subWebMenu->id)->orderBy('id', 'asc')->get();
                foreach ($subSecondaryWebMenus as $subSecondaryWebMenu) {
                    $subMenuItem['sub_SubMenu'][] = [
                        'url'           =>      $subSecondaryWebMenu->url,
                        'title'         =>      $subSecondaryWebMenu->title,
                        'new_window'    =>      $subSecondaryWebMenu->_blank
                    ];
                }
                $menuItem['sub_menu'][] = $subMenuItem;
            }
            $structuredData[] = $menuItem;
        }
        return $structuredData;
    }
    public function store(Request $request)
    { 
        DB::table('main_web_menu')->delete();
        DB::table('sub_web_menu')->delete();
        DB::table('sub_secondary_web_menu')->delete();
        foreach ($request['menu_items'] as $menuItem) {
            $title           =   $menuItem['tier_one_title'] ?? '';
            $url             =   $menuItem['tier_one_url'] ?? '';
            $_blank          =   $menuItem['new_window_tier_one'] ?? '';
            $page_id         =   DB::table('pagebuilder__page_translations')
                ->select('page_id')
                ->where('route', $url)
                ->value('page_id');
            if ($title  && $url) {
                $mainWebMenu                =   new MainWebMenu();
                $mainWebMenu->page_id       =   $page_id;
                $mainWebMenu->title         =   $title;
                $mainWebMenu->url           =   $url;
                $mainWebMenu->_blank        =   $_blank ?? 0;
                $mainWebMenu->created_at    =   Carbon::now();
                $mainWebMenu->created_by    =   GetActiveGuardDetail()->id;
                $mainWebMenu->updated_at    =   Carbon::now();
                $mainWebMenu->updated_by    =   GetActiveGuardDetail()->id;
                $mainWebMenu->save();
            }
            if (isset($menuItem['sub_menu'])) {
                foreach ($menuItem['sub_menu'] as $subMenu) {
                    $title          =   $subMenu['title'];
                    $url            =   $subMenu['url'];
                    $_blank         =   $subMenu['new_window'] ?? 0;
                    $page_id        =   DB::table('pagebuilder__page_translations')
                        ->select('page_id')
                        ->where('route', $url)
                        ->value('page_id');
                    $subWebMenu                =   new SubWebMenu();
                    $subWebMenu->page_id       =   $page_id;
                    $subWebMenu->title         =   $title;
                    $subWebMenu->url           =   $url;
                    $subWebMenu->main_menu_id  =   $mainWebMenu->id;
                    $subWebMenu->_blank        =   $_blank ?? 0;
                    $subWebMenu->created_at    =   Carbon::now();
                    $subWebMenu->created_by    =   GetActiveGuardDetail()->id;
                    $subWebMenu->updated_at    =   Carbon::now();
                    $subWebMenu->updated_by    =   GetActiveGuardDetail()->id;
                    $subWebMenu->save();

                    if (isset($subMenu['sub_SubMenu'])) {
                        foreach ($subMenu['sub_SubMenu'] as $sub_SubMenu) {
                            $title          =   $sub_SubMenu['title'];
                            $url            =   $sub_SubMenu['url'];
                            $_blank         =   $sub_SubMenu['new_window'] ?? 0;
                            $page_id        =   DB::table('pagebuilder__page_translations')
                                ->select('page_id')
                                ->where('route', $url)
                                ->value('page_id');

                            $subSecondaryMenu                =   new SubSecondaryWebMenu();
                            $subSecondaryMenu->page_id       =   $page_id;
                            $subSecondaryMenu->title         =   $title;
                            $subSecondaryMenu->url           =   $url;
                            $subSecondaryMenu->main_menu_id  =   $mainWebMenu->id;
                            $subSecondaryMenu->sub_menu_id   =   $subWebMenu->id;
                            $subSecondaryMenu->_blank        =   $_blank;
                            $subSecondaryMenu->created_at    =   Carbon::now();
                            $subSecondaryMenu->created_by    =   GetActiveGuardDetail()->id;
                            $subSecondaryMenu->updated_at    =   Carbon::now();
                            $subSecondaryMenu->updated_by    =   GetActiveGuardDetail()->id;
                            $subSecondaryMenu->save();
                        }
                    }
                }
            }
        }

        return response()->json([
            'msg' => 'Menu Created Successdully',
            'status' => 'success'
        ]);
    }
    public function create($id = null)
    {
        $menu   =   [];
        $pages  =  [
            (object)['title' => 'Blogs',            'url'    => 'blogs'],
            (object)['title' => 'About Us',         'url'    => 'about-us'],
            (object)['title' => 'Contact Us',       'url'    => 'contact-us'],
            (object)['title' => 'Terms of Use',     'url'    => 'terms-of-use'],
            (object)['title' => 'Privacy Policy',   'url'    => 'privacy-prolicy']
        ];
        $page_builder_pages = DB::table('pagebuilder__pages')
            ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
            ->select(
                'pagebuilder__pages.name as title',
                'pagebuilder__page_translations.route as url'
            )
            ->get()->toArray();
        $data['webPages']         = $pages;
        $data['pageBuilderPages'] = $page_builder_pages;
        $base_url       =   FacadesURL::to('/') . '/';
        if ($id) {
            $menu       =   Menu::where('id', $id)->first();
            if ($menu) {
                $menu->items    =   MenuItem::where('website_menu_id', $menu->id)->get();
            }
        }
        return view('admin.website-menu.create', compact(
            'data',
            'menu'
        ));
    }
    public function delete(Request $request)
    {
        if (MenuItem::where('website_menu_id', $request->id)->delete()) {
            Menu::where('id', $request->id)->delete();
            return response()->json([
                'msg' => 'Menu deleted Successdully',
                'status' => 'success'
            ]);
        }
    }
    public function updateStatus(Request $request)
    {
        if ($request->status == 0) {
            $status = 1;
            $text = "In Active";
        } else {
            $status = 0;
            $text = "Active";
        }
        Menu::where('id', $request->id)->update(['status' => $status]);
        return response()->json([
            'msg' => 'Menu Status updated Successully',
            'status' => 'success',
            'text' => $text
        ]);
    }
    public function storeRightMenu(Request $request)
    { 
        // dd($request->all());
        DB::table('right_web_menu')->delete(); 
        foreach ($request['menu_items'] as $menuItem) {
            $id                     =   $menuItem['id'] ?? '';  
            $main_title             =   $menuItem['title'] ?? '';  
            if (isset($menuItem['sub_menu'])) {
                foreach ($menuItem['sub_menu'] as $subMenu) {
                    $title          =   $subMenu['title'];
                    $url            =   $subMenu['url'];
                    $_blank         =   $subMenu['new_window'] ?? 0;
                    $page_id        =   DB::table('pagebuilder__page_translations')
                                                ->select('page_id')
                                                ->where('route', $url)
                                                ->value('page_id');
                    $subWebMenu                =   new RightWebMenu();
                    $subWebMenu->page_id       =   $page_id;
                    $subWebMenu->title         =   $title;
                    $subWebMenu->url           =   $url;
                    $subWebMenu->type          =   $id;
                    $subWebMenu->main_title    =   $main_title;
                    $subWebMenu->_blank        =   $_blank ?? 0;
                    $subWebMenu->created_at    =   Carbon::now();
                    $subWebMenu->created_by    =   GetActiveGuardDetail()->id;
                    $subWebMenu->updated_at    =   Carbon::now();
                    $subWebMenu->updated_by    =   GetActiveGuardDetail()->id;
                    $subWebMenu->save();
                  
                }
            }
        }

        return response()->json([
            'msg' => 'Menu Created Successdully',
            'status' => 'success'
        ]);
    }
}
