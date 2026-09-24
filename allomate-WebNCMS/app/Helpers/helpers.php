<?php

use App\Models\Blogs;
use App\Models\FooterPageContent;
use App\Models\Organization;
use App\Models\StaticPages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


if (!function_exists('totalPendingNotifications')) {
    function totalPendingNotifications()
    {
        $login_id   =   GetActiveGuardDetail()->id;
        if (GetActiveGuardDetail()->is_web == 1) {
            $where  =   "admin_id    = $login_id";
        } else {
            $where  =   "investor_id = $login_id";
        }
        $total_notitifications = DB::table('all_notifications_list')->whereRaw($where)->whereNull('read_by')->count();

        return $total_notitifications;
    }
}
if (!function_exists('GetActiveGuardDetail')) {
    function GetActiveGuardDetail()
    {
        $loginDetail            =   "";
        if (Auth::guard('web')->check()) {
            $loginDetail        =   Auth::user();
            if (Route::currentRouteName() != "logout") {
                $loginDetail->is_web =   1;
            }
        } else if (Auth::guard('investor')->check()) {
            $loginDetail        =   Auth::guard('investor')->user();
            if ($loginDetail) {
                $loginDetail->name  =   $loginDetail->first_name;
                $loginDetail->phone =   $loginDetail->phone_number;
                if (Route::currentRouteName() != "logout") {
                    $loginDetail->is_web =   0;
                }
            }
        }
        return $loginDetail;
    }
}
if (!function_exists('footerDetails')) {
    function footerDetails()
    {
        $organizationRecord             =   Organization::selectRaw('organization.*,
        (SELECT name FROM countries WHERE id = organization.country_id) as country_name,
        (SELECT name FROM cities WHERE id = organization.city_id) as city_name')->first();
        $organizationRecord->location   =   DB::table('organization_location')->selectRaw('organization_location.*,
                                                        (SELECT name FROM countries WHERE id = organization_location.country_id) as country,
                                                        (SELECT name FROM cities WHERE id = organization_location.city_id) as city')->get();
        $footerItems = FooterPageContent::select('footer_menu')
            ->orderBy('id','ASC')
            ->get()
            ->map(function ($item) {
                $item['footer_menu'] = json_decode($item['footer_menu'], true);
                return $item;
            });
        return (object) [
            'organizationRecord'    => $organizationRecord->toArray(),
            'footerItems'           => $footerItems->toArray(),
        ];
    }
}
function WebSiteHeaderMenu(){
    $websiteMenu            =   DB::select("
                                        SELECT
                                            mwm.id AS main_id,
                                            mwm.page_id,
                                            mwm.title,
                                            mwm.url,
                                            mwm._blank AS main_menu_open_in
                                        FROM
                                        main_web_menu mwm
                                        order by mwm.id ASC
                                    ");
        $secondayMenu           =   DB::select("
                                        SELECT
                                            swm.id AS secondary_id,
                                            swm.main_menu_id AS main_menu_id,
                                            swm.page_id AS secondary_page_id,
                                            swm.title AS secondary_title,
                                            swm.url AS secondary_url,
                                            swm._blank AS secondary_menu_open_in
                                        FROM
                                        sub_web_menu swm
                                        order by swm.id ASC
                                    ");
        $websiteMenu            =   collect($websiteMenu)->map(function ($x) use ($secondayMenu) {
                                        $x->secondary   =   collect($secondayMenu)->WHERE('main_menu_id',$x->main_id)->toArray();
                                        return $x;
                                    });
        return $websiteMenu;
}
function WebSiteRightMenu(){
    $websiteMenu            =   DB::select("
                                        SELECT
                                            mwm.id AS main_id,
                                            mwm.page_id,
                                            mwm.title,
                                            mwm.main_title,
                                            mwm.url,
                                            mwm._blank AS right_menu_open_in
                                        FROM
                                        right_web_menu mwm
                                        order by mwm.id ASC
                                    ");

    $menuArray = [];
    foreach ($websiteMenu as $menuItem) {
        $menuArray[$menuItem->main_title][] = [
            'main_id'           => $menuItem->main_id,
            'page_id'           => $menuItem->page_id,
            'title'             => $menuItem->title,
            'url'               => $menuItem->url,
            'right_menu_open_in' => $menuItem->right_menu_open_in,
        ];
    } 
        return $menuArray;
}

if (!function_exists('genrateSiteMap')) {
    function genrateSiteMap()
    {
        $route_names['pages'] = [];

        $pageMappings = [
            1 => ['slug' => 'privacy-policy', 'title' => 'Privacy Policy'],
            2 => ['slug' => 'terms-of-use', 'title' => 'Terms of Use'],
            3 => ['slug' => 'about-us', 'title' => 'About Us'],
        ];

        $pages     = StaticPages::whereIn('page_id', [1, 2, 3, 4])
                            ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(CAST(page_meta_tags AS JSON), '$[0].is_indexable')) = '1'")
                            ->get()
                            ->map(function ($page) use ($pageMappings) {
                                $mapping = $pageMappings[$page->page_id] ?? ['slug' => 'unknown', 'title' => 'Unknown'];
                                $page->slug = $mapping['slug'];
                                $page->title = $mapping['title'];
                                return $page;
                            });
        // Merge static pages with other routes
        $route_names['pages'] = array_merge($route_names['pages'], $pages->map(function ($page) {
                                        return ['name' => $page->title, 'slug' => $page->slug];
                                    })->toArray());
        // Builder pages with other routes
        $pages       =   DB::table('pagebuilder__pages')->where('page_status', '=', '2')
                            ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
                            ->where('pagebuilder__page_translations.is_indexable',1)
                            ->pluck('pagebuilder__page_translations.route')->toArray();
        if (count($pages) > 0) {
            foreach ($pages as $key => $value) {
                $route_names['pages'][]  = ['slug' => str_replace( '/', '', $value) , 'name' => ucfirst(str_replace('-' , ' ', str_replace( '/', '', $value))) ] ;
            }
        }
        //Careers
        $careers        =   DB::table('careers')->where('status',1)->whereRaw("JSON_EXTRACT(page_meta_tags, '$.is_indexable') = '1'")->pluck("slug")->toArray();

        //Blogs
        $blogs = Blogs::select('id', 'title as name', 'slug as item_slug')
                        ->where('published', 1)
                        ->whereRaw("JSON_EXTRACT(page_meta_tags, '$.is_indexable') = '1'")
                        ->get();
        if (count($blogs) > 0) {
            $route_names['blogs'][]  = 'blogs';
            foreach ($blogs as $blog) {
                $route_names['blogs'][]  =   ['name' => ucfirst(strtolower($blog->name)), 'slug' => 'blog/' . $blog->item_slug];
            }
        }
        return $route_names;
    }
}
if (!function_exists('storeSeo')) {
    function storeSeo($request)
    {   $meta_og_image              =    $request->hidden_meta_og_image;
        if ($request->hasfile('meta_og_image')) {
            $meta_og_image          =        $request->meta_og_image->store('og-images', 'public');
        }
        $seo                        =       new \stdClass();
        $seo->page_title            =       $request->seo_page_title;
        $seo->meta_content_author   =       $request->meta_content_author;
        $seo->meta_tag_name         =       $request->seo_meta_tag_name;
        $seo->meta_keywords         =       $request->seo_meta_keywords;
        $seo->meta_description      =       $request->seo_meta_description;
        $seo->meta_og_title         =       $request->meta_og_title;
        $seo->meta_og_description   =       $request->meta_og_description;
        $seo->meta_structure_tags   =       $request->meta_structure_tags;
        $seo->is_indexable          =       $request->is_indexable;
        $seo->is_followable         =       $request->is_followable;
        $seo->meta_og_image         =       $meta_og_image;
        $seo                        =       json_encode($seo);
        return $seo;
    }
}
