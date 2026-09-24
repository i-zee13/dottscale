<?php

namespace App\Providers;

use App\ControllersList;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Organization;
use App\Models\OrganizationLocation;

use App\Models\SecondaryServices;
use App\Models\SubSecondaryServices;
use App\Models\Home;
use DB;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Schema;
use PHPageBuilder\PHPageBuilder;
use stdClass;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('path.public', function () {
            return base_path() . '/public_html';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $general_pages = DB::table('pagebuilder__pages')
            ->where('pagebuilder__pages.page_status', 2)
            ->whereRaw("pagebuilder__pages.page_type IN (1,3)")
            ->leftjoin('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
            ->get();
        $isPageBuilderPage = false;

        $organization = Organization::first();
        $page_meta = null;
        $webdata = null;
        $route = $this->app->request->getRequestUri();
        $current_route = str_replace("/", "", $route);
        $cmsroute = substr($route, 0, 6);
        $blogroute = explode('/', $route);

        $websiteroutes = [
            'privacy-policy' => 'static_pages',
            'terms-of-use' => 'static_pages',
        ];

        // Get Blog Title
        $prefix = "/blogs/blog-details/";
        $index = strpos($route, $prefix) + strlen($prefix);
        $blog_title = "";
        if (($blogroute[1] == "blogs" && isset($blogroute[2]) && $blogroute[2] == "blog-details" && isset($blogroute[3]))) {
            $blog_title = $blogroute[3];
        } else if ($blogroute != '' && $blogroute[1] == "career" && isset($blogroute[2])) {
            $blog_title = $blogroute[2];
        }
        error_reporting(0);
        if (in_array($current_route, array_keys($websiteroutes)) && strtolower($this->app->request->getMethod()) == 'get') {
            ;
            if ($current_route == 'privacy-policy') {
                $webdata = DB::table($websiteroutes[$current_route])->where('page_id', '1')->first(['page_meta_tags', 'meta_og_image']);
                $webdata->is_indexable = 1;
                $webdata->is_followable = 1;
                $page_meta = json_decode(@$webdata->page_meta_tags);
            } elseif ($current_route == 'terms-of-use') {
                $webdata = DB::table($websiteroutes[$current_route])->where('page_id', '2')->first(['page_meta_tags', 'meta_og_image']);
                $page_meta = json_decode(@$webdata->page_meta_tags);
            } else {
                $webdata = DB::table(@$websiteroutes[$current_route])->first(['page_meta_tags', 'meta_og_image']);
                if ($webdata) {
                    $page_meta = json_decode(@$webdata->page_meta_tags);
                }

            }
        } elseif ($blogroute[1] == "blogs" && isset($blogroute[2]) && $blogroute[2] == "blog-details" && isset($blogroute[3])) {
            $webdata = DB::table('blogs')->where('slug', $blog_title)->first(['title', 'page_meta_tags', 'meta_og_image']);
            if ($webdata) {
                $page_meta = json_decode(@$webdata->page_meta_tags);
            }

        } else if ($blogroute[1] == 'career' && isset($blogroute[2])) {
            $webdata = DB::table('careers')->where('slug', $blogroute[2])->first(['title', 'page_meta_tags', 'meta_og_image']);

            $page_meta = json_decode(@$webdata->page_meta_tags);
        } elseif ($cmsroute != '/admin' && $current_route != 'login' && $current_route != 'mylogin' && $current_route != 'logout' && $blogroute[1] != "blogs" && !isset($blogroute[2])) {
            if ($current_route == "") {
                $route = "/home";
            }
            $webdata = DB::table('pagebuilder__page_translations')
                ->where('route', $route)
                ->first(['title', 'page_meta_tags', 'meta_og_image', 'is_followable', 'is_indexable']);
            $page_meta_array = json_decode(@$webdata->page_meta_tags, true);
            $page_meta = is_array($page_meta_array) && count($page_meta_array) > 0 ? (object) $page_meta_array[0] : (object) [];
            if ($page_meta) {
                $page_meta->meta_og_image = $webdata->meta_og_image;
                $page_meta->is_followable = $webdata->is_followable;
                $page_meta->is_indexable = $webdata->is_indexable;
                $page_meta->title = $webdata->title;
            }
        }
        $default_tags = json_decode(@$organization->page_meta_tags);
        $og_image = isset($page_meta->meta_og_image) && $page_meta->meta_og_image != ''
            ? url('/storage/' . $page_meta->meta_og_image)
            : ($default_tags->meta_og_image ? $default_tags->meta_og_image : '/images/allomate-logo-w.svg');

        OpenGraph::addImage($og_image, ['height' => 1000, 'width' => 1000]);
        $meta_structure_tags = $page_meta->meta_structure_tags;
        OpenGraph::setDescription(
            isset($page_meta->meta_og_description)
                ? $page_meta->meta_og_description
                : (isset($default_tags->meta_og_description)
                    ? $default_tags->meta_og_description
                    : 'Allomate Solutions')
        );

        SEOMeta::setDescription(
            $page_meta->meta_description ??
            $page_meta->meta_content_description ??
            $default_tags->meta_description ??
            'Allomate Solutions'
        )->addKeyword(
            $page_meta->meta_keywords ??
            $page_meta->meta_content_keywords ??
            $default_tags->meta_keywords
        );

        if ($blogroute != '' && $blogroute[1] == "blogs" && isset($blogroute[2]) && $blogroute[2] == "blog-details") {
            SEOTools::setCanonical(env('WEB_URL') . ($blogroute[1] . '/' . $blogroute[2] . '/' . $blogroute[3]));
        } else if ($blogroute != '' && $blogroute[1] == "career" && isset($blogroute[2])) {
            SEOTools::setCanonical(env('WEB_URL') . ($blogroute[1] . '/' . $blogroute[2]));
        } else {
            SEOTools::setCanonical(env('WEB_URL') . ($current_route != '' ? '/' . $current_route : ''));
        }

        SEOMeta::addMeta('article:publisher', $organization->fb_link);

        $robotsContent = '';
        if (env('APP_ENV') === 'production') {
            if (isset($page_meta->is_indexable) && isset($page_meta->is_followable)) {
                $robotsContent = $page_meta->is_indexable == 0 ? 'noindex, ' : 'index, ';
                $robotsContent .= $page_meta->is_followable == 0 ? 'nofollow' : 'follow';
            } else {
                if (isset($default_tags->is_indexable) && isset($default_tags->is_followable)) {
                    $robotsContent = $page_meta->is_indexable == 0 ? 'noindex, ' : 'index, ';
                    $robotsContent .= $page_meta->is_followable == 0 ? 'nofollow' : 'follow';
                } else {
                    $robotsContent = 'noindex, nofollow';
                }
            }
        } else {
            $robotsContent = 'noindex, nofollow';
        }
        SEOMeta::setRobots($robotsContent);
        SEOTools::opengraph()->addProperty('type', 'website');
        if ($current_route != '' && $blog_title == '') {
            $page_title = ucwords(str_replace(['-'], ' ', $current_route));
            $title = $webdata->title ?? ($current_route ? $page_title : 'Allomate Solutions');
            SEOMeta::setTitle($title);
        } else if (!$blog_title == '') {
            $blog_title = ucwords(str_replace(['-'], ' ', $blog_title));
            SEOMeta::setTitle($blog_title);
        } else {
            $page_title = ucwords(str_replace('-', ' ', $current_route));
            SEOMeta::setTitle($webdata->title ? $webdata->title : ($current_route ? $page_title : 'Allomate Solutions'));
        }

        TwitterCard::setTitle(
            $webdata->title != '' && $webdata->title
                ? $webdata->title
                : ($current_route ? $current_route : 'Allomate Solutions')
        );

        TwitterCard::setDescription(
            $page_meta && $page_meta->meta_og_description
                ? $page_meta->meta_og_description
                : ($default_tags && $default_tags->meta_content_description
                    ? $default_tags->meta_og_description
                    : 'Allomate Solutions')
        );

        if ($organization->twitter_link) {
            TwitterCard::setSite($organization->twitter_link);
            TwitterCard::addValue('creator', $organization->twitter_link);
        }

        TwitterCard::addValue('image',
            $page_meta->meta_og_image
                ? url('/storage/' . $page_meta->meta_og_image)
                : ($default_tags->meta_og_image
                    ? url('/storage/' . $default_tags->meta_og_image)
                    : url('/images/allomate-logo-w.svg'))
        );

        TwitterCard::addValue('label1', 'Time to read');
        TwitterCard::addValue('data1', 'Less than a minute');

        $imagePath = $page_meta->meta_og_image
            ? url('/storage/' . $page_meta->meta_og_image)
            : ($default_tags->meta_og_image
                ? url('/storage/' . $default_tags->meta_og_image)
                : url('/images/allomate-logo-w.svg'));

        $imageInfo = pathinfo($imagePath);
        $extension = isset($imageInfo['extension']) ? $imageInfo['extension'] : 'png';

        SEOTools::opengraph()->addProperty('image:alt', 'Allomate Solutions');
        SEOTools::opengraph()->addProperty('image:type', 'image/' . $extension);

        if (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8001']) || in_array($_SERVER['HTTP_HOST'], [env('ADMIN_URL', 'demo.crm.allomate.solutions'), 'www.demo.crm.allomate.solutions'])) {
            app('view')->composer('layouts.app', function ($view) {
                $action = app('request')->route()->getAction();


                $controller = class_basename($action['controller']);
                list($controller, $action) = explode('@', $controller);
                $userPermissions = array();
                $allControllers = ControllersList::orderBy('parent_module_priority')->get();
                $loginId = GetActiveGuardDetail()->id;

                if (Auth::guard('web')->check()) {
                    $userPermissions[] = 'admin/index';
                    $userPermissions[] = 'admin/profile';
                    if (GetActiveGuardDetail()->super == 1) {
                        foreach ($allControllers as $controllers) {
                            if ($controllers->controller != 'index') {
                                $userPermissions[] = 'admin/' . $controllers->controller;
                            }
                        }
                    } else {
                        $objects = FacadesDB::table('access_rights')->select('controller_right')->where('admin_id', $loginId)->get();
                        foreach ($objects as $object) {
                            $userPermissions[] = 'admin/' . $object->controller_right;
                        }
                    }
                }
                $isWeb = GetActiveGuardDetail()->is_web;
                $view->with(compact(
                    'controller',
                    'action',
                    'userPermissions',
                    'notif_data',
                    'all_notifications',
                    'allControllers',
                    'primary_services',
                    'organization',
                    'home_blade_data',
                    'general_pages',
                    'page_meta',
                    'webdata',
                    'customersFromProvider',
                    'empsForCentralizedTask',
                    'isWeb',
                ));
            });
        } elseif (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8000']) || in_array($_SERVER['HTTP_HOST'], [env('WEB_URL', 'demo.demo.allomate.solutions'), env('WEB_URL', 'demo.allomate.solutions'), 'www.demo.allomate.solutions'])) {
            $tagManager = DB::table('gateways')->whereRaw("section = 'tag_manager' AND type = 'googleTag' AND status = 'active'")->first();
            $tagManagerHeader = "";
            $tagManagerBody = "";
            if ($tagManager) {
                $detailManager = JSON_decode($tagManager->setting);
                $liveDetailTag = $detailManager->live;
                $tagManagerHeader = $liveDetailTag->google_tag_header;
                $tagManagerBody = $liveDetailTag->google_tag_body;
            } else {
                $tagManagerHeader = "";
                $tagManagerBody = "";
            }
            View::share([
                'general_pages' => $general_pages,
                'page_meta' => $page_meta,
                'webdata' => $webdata,
                'meta_structure_tags' => $meta_structure_tags,
                'tagManagerHeader' => $tagManagerHeader,
                'tagManagerBody' => $tagManagerBody
            ]);
        } elseif (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8002']) || in_array($_SERVER['HTTP_HOST'], [env('INVESTOR_URL', 'investor.demo.allomate.solutions'), 'www.investor.demo.allomate.solutions'])) {
            app('view')->composer('layouts.investor-app', function ($view) {
                $action = app('request')->route()->getAction();


                $controller = class_basename($action['controller']);
                list($controller, $action) = explode('@', $controller);
                $userPermissions = array();
                $allControllers = ControllersList::orderBy('parent_module_priority')->get();
                $loginId = GetActiveGuardDetail()->id; {
                    $userPermissions[] = 'admin/index';
                    if (Auth::guard('investor')->check()) {
                        $userPermissions[] = "admin/reports";
                        $userPermissions[] = "admin/profile";
                        $objects = FacadesDB::table('access_rights')->select('controller_right')->where('investor_id', $loginId)->get();
                    }
                    foreach ($objects as $object) {
                        $userPermissions[] = 'investor/' . $object->controller_right;
                    }
                }
                $isWeb = GetActiveGuardDetail()->is_web;
                $view->with(compact(
                    'controller',
                    'action',
                    'userPermissions',
                    'notif_data',
                    'all_notifications',
                    'allControllers',
                    'primary_services',
                    'organization',
                    'home_blade_data',
                    'general_pages',
                    'page_meta',
                    'webdata',
                    'customersFromProvider',
                    'empsForCentralizedTask',
                    'isWeb',
                ));
            });
        }
    }
}
