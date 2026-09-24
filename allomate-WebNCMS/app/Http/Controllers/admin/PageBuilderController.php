<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Core\AccessRightsAuth;
use App\Models\PageBuilderBlocks;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class PageBuilderController extends AccessRightsAuth
{
    public function build($pageId = null)
    {
        // dd(env('APP_URL'));
        $route          = $_GET['route'] ?? null;
        $action         = $_GET['action'] ?? null;
        $pageId         = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
        $pageRepository = new \PHPageBuilder\Repositories\PageRepository;
        $page           = $pageRepository->findWithId($pageId); //getting record from DB
        $phpPageBuilder = app()->make('phpPageBuilder');
        $pageBuilder    = $phpPageBuilder->getPageBuilder();
        $customScripts  = view("pagebuilder.scripts")->render();
        $pageBuilder->customScripts('head', $customScripts);
        $pageBuilder->handleRequest($route, $action, $page);
    }
    public  function slug($slug = null)
    {
        // dd(WebSiteRightMenu()); 
        if ((in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '127.0.0.1:8001', 'www.demo.crm.allomate.solutions', env('ADMIN_URL', 'demo.crm.allomate.solutions')]))  && ($slug == "generated::MmiLgvnTnVquRpGE" || $slug == null || $slug == '' || $slug == 'home')
        ) {
            if (!Auth::guard('web')->check()) {
                return redirect(route('login'));
            } else {
                return redirect(route('index'));
            }
        }   
        if ($slug == "" || $slug == "/" || $slug == "home") {
            $slug = "home";
        }
        error_reporting(0);
        $data = DB::table('pagebuilder__page_translations')->join("pagebuilder__pages", "pagebuilder__pages.id", "=", "pagebuilder__page_translations.page_id")->where('route', '/' . $slug)->first();
        $page_id        =   null;
        if ($data) { $page_id    =   $data->page_id; }
        $data           =  json_decode($data->data, true);
        if (isset($data)) {
            return view('dynamic-page', compact('data', 'page_id'));
        } else {
            abort('404');
        }
    }
    public function listPages()
    {
        return view('admin.page-list');
    }
    public function all_list_pages(Request $request)
    {

        $data = DB::table('pagebuilder__pages')
            ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
            ->select(
                'pagebuilder__pages.*',
                'pagebuilder__page_translations.route as route'
            );
        $where = "1=1 ";
        if ($request->is_portfolio == 1) {
            $portfolios     = Portfolio::get();
            $where         .= "AND pagebuilder__pages.page_type = 2";
            $data           = $data->whereRaw("$where")->get();
            $portfolios     = collect($portfolios)->map(function ($x) use ($data) {
                $x->page    = collect($data)->where('portfolio_id', $x->id);
                return $x;
            });
        } else {
            $where  .= "AND pagebuilder__pages.page_type != 2";
            $data   = $data->whereRaw("$where")->get();
        }

        return response()->JSON([
            'status'    =>  'success',
            'msg'       =>  'record_fetch',
            'all_pages'  =>  $data
        ]);
    }

    public function save_page(request $request)
    {
        // dd($request->all());
        $portfolio_id = 0;
        if ($request->portfolio_name) {
            if (Portfolio::where('portfolio_name', $request->portfolio_name)->where('id', '!=', $request->hidden_portfolio_id)->first()) {
                return response()->json([
                    'msg'   => 'Portfolio Name',
                    'status' =>  'duplicate',
                ]);
            } else {
                $primary        =   new Portfolio();
                if ($request->hidden_portfolio_id) {
                    $primary    = Portfolio::where('id', $request->hidden_portfolio_id)->first();
                }
                if ($request->hasfile('thumbnail')) {
                    $thumbnail    =   $request->thumbnail->store('portfolios', 'public');
                } else {
                    $thumbnail    =   $request->hidden_thumbnail;
                }
                $primary->is_slider_show        = $request->is_slider_show;
                $primary->thumbnail             = $thumbnail;
                $primary->portfolio_name        = $request->portfolio_name;
                $primary->portfolio_categories  = trim(implode(',', $request->categories));
                $primary->created_at            = Carbon::now();
                $primary->created_by            = FacadesAuth::id();
                $primary->save();
                $portfolio_id                   = $primary->id;
            }
        }
        if ($request->hidden_page_id) {
            $query              =   DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', '!=', $request->hidden_page_id)
                ->where('name', $request->page_title)->first();
            if ($query) {
                return response()->json([
                    'msg'       =>  'Page Title',
                    'status'    =>  'duplicate'
                ]);
            } else {
                DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', $request->hidden_page_id)
                    ->update([
                        'name'          => $request->page_title,
                        'layout'        => 'master',
                        'page_type'     => $request->page_type,
                        'portfolio_id'  => $portfolio_id,
                    ]);
            }
        } else {
            $query              =   DB::table('pagebuilder__pages')->where('name', $request->page_title)->first();
            if ($query) {
                if (!$is_updated) {
                    Portfolio::where('id', $portfolio_id)->delete();
                }
                return response()->json([
                    'msg'       =>  'Page Title',
                    'status'    =>  'duplicate'
                ]);
            } else {
                $page_builder =  DB::table('pagebuilder__pages')
                    ->insertGetId([
                        'name'        => $request->page_title,
                        'layout'      => 'master',
                        'page_status' => 1,
                        'page_type'   => $request->page_type,
                        'portfolio_id' => $portfolio_id,

                    ]);
            }
        }
        if ($request->hidden_page_translation_id) {
            $query       =   DB::table('pagebuilder__page_translations')
                ->where('pagebuilder__page_translations.id', '!=', $request->hidden_page_translation_id)
                ->where('route', '/' . $request->page_route)
                ->first();
            if ($query) {
                return response()->json([
                    'msg'       =>  'Page Route',
                    'status'    =>  'duplicate'
                ]);
            } else {
                if ($request->hasfile('meta_og_image')) {
                    $meta_og_image    =   $request->meta_og_image->store('og-images', 'public');
                } else {
                    $meta_og_image    =   $request->hidden_og_image;
                }
                $data = DB::table('pagebuilder__page_translations')
                    ->where('pagebuilder__page_translations.id', $request->hidden_page_translation_id)
                    ->select('title', 'route')
                    ->first();

                if ($data) {
                    DB::table('main_web_menu')
                        ->where('url', $data->route)
                        ->orWhere('title', $data->title)
                        ->update([
                            'url' => '/' . Str::slug($request->page_route),
                            'title' => $request->page_title,

                        ]);
                    DB::table('sub_web_menu')
                        ->where('url', $data->route)
                        ->orWhere('title', $data->title)
                        ->update([
                            'url' => '/' . Str::slug($request->page_route),
                            'title' => $request->page_title,
                        ]);
                    $footerContent = DB::table('footer_content')->select('id', 'footer_menu')->get();
                    $updatedFooterContent = $footerContent->map(function ($item) use ($data, $request) {
                        $menu = json_decode($item->footer_menu, true);
                        foreach ($menu as &$entry) {
                            if ($entry['url'] === $data->route || $entry['title'] === $data->title) {
                                $entry['url'] = '/' . Str::slug($request->page_route);
                                $entry['title'] = $request->page_title;
                            }
                        }

                        return [
                            'id' => $item->id,
                            'footer_menu' => json_encode($menu),
                        ];
                    });

                    $updatedFooterContent->each(function ($item) {
                        DB::table('footer_content')
                            ->where('id', $item['id'])
                            ->update([
                                'footer_menu' => $item['footer_menu'],
                            ]);
                    });
                } 

                DB::table('pagebuilder__page_translations')->where('pagebuilder__page_translations.id', $request->hidden_page_translation_id)
                    ->update([
                        'title'             =>  $request->page_title,
                        'page_id'           =>  $request->hidden_page_id,
                        'locale'            =>  'en',
                        'route'             =>  '/' . Str::slug($request->page_route),
                        'is_indexable'      =>  $request->is_indexable,
                        'is_followable'     =>  $request->is_followable,
                        'page_meta_tags'    =>  json_encode($request->meta_array),
                        'meta_og_image'     =>  $meta_og_image,
                        'is_indexable'      =>  $request->is_indexable,
                        'is_followable'     =>  $request->is_followable,
                    ]);
            }
        } else {
            $query       =   DB::table('pagebuilder__page_translations')
                ->where('pagebuilder__page_translations.id', '!=', $request->hidden_page_translation_id)
                ->where('route', '/' . $request->page_route)
                ->first();

            if ($query) {
                DB::table('pagebuilder__pages')->delete($page_builder);
                Portfolio::where('id', $portfolio_id)->delete();
                return response()->json([
                    'msg'       =>  'Page Route',
                    'status'    =>  'duplicate'
                ]);
            } else {
                if ($request->hasfile('meta_og_image')) {
                    $meta_og_image    =    $request->meta_og_image->store('og-images', 'public');
                } else {
                    $meta_og_image    =   $request->hidden_og_img;
                }
                DB::table('pagebuilder__page_translations')
                    ->insertGetId([
                        'title'             =>   $request->page_title,
                        'page_id'           =>   $page_builder,
                        'locale'            =>   'en',
                        'route'             =>   '/' . Str::slug($request->page_route),
                        'page_meta_tags'    =>   json_encode($request->meta_array),
                        'meta_og_image'     =>   $meta_og_image,
                        'is_indexable'      =>   $request->is_indexable,
                        'is_followable'     =>   $request->is_followable,
                    ]);
            }
        }
        return response()->JSON([
            'status'    =>  'success',
            'msg'       =>  'page_added'
        ]);
    }
    public function edit_page($id)
    {
        $page_meta_tags = null;
        $getpage    =     DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', $id)
            ->join('pagebuilder__page_translations', 'pagebuilder__page_translations.page_id', '=', 'pagebuilder__pages.id')
            ->leftjoin('portfolios', 'portfolios.id', '=', 'pagebuilder__pages.portfolio_id')
            ->select(
                'pagebuilder__pages.*',
                'portfolios.thumbnail',
                'portfolios.is_slider_show',
                'pagebuilder__page_translations.route as route',
                'pagebuilder__page_translations.id as page_translaition_id',
                'pagebuilder__page_translations.page_meta_tags as page_meta_tags',
                'pagebuilder__page_translations.meta_og_image as meta_og_image',
                'pagebuilder__page_translations.is_indexable',
                'pagebuilder__page_translations.is_followable'
            )
            ->first();
        if ($getpage->page_meta_tags != null) {
            $page_meta      =   json_decode($getpage->page_meta_tags);
            $page_meta_tags =   $page_meta[0];
        }
        return response()->JSON([
            'status'    =>  'success',
            'msg'       =>  'Data Fetched',
            'getpage'   =>  $getpage,
            'page_meta' =>  $page_meta_tags
        ]);
    }
    public function savePageWithStatus($id, Request $request)
    {
        $update               =      DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', $id)->update([
            'page_status'   => $request->status
        ]);

        return response()->JSON([
            'status'    =>  'success',
            'msg'       =>  'Status Updated',

        ]);
    }
    public function changeLandPageStatus(Request $request)
    {
        $id                 =   $request->id;
        $change_status      =    DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', $id)
            ->update(['landing_page_status' => '1']);
        $change_status_all  =    DB::table('pagebuilder__pages')->where('pagebuilder__pages.id', '!=', $id)
            ->update(['landing_page_status' => '0']);
        return response()->JSON([
            'msg'           =>  'Status Change',
            'status_id'     =>  $id
        ]);
    }

    public function pageSlug($slug)
    {
        $page_slug    =     str::slug($slug);
        return response()->json([
            'msg'        =>   'success',
            'status'     =>   'success',
            'page_slug'  =>    $page_slug
        ]);
    }
    public function blocksList()
    {
        return view('blocks-list');
    }
    public function getBlocksList()
    {
        $records        =   PageBuilderBlocks::all();
        return response()->JSON([
            'status'    =>  'success',
            'records'   =>  $records
        ]);
    }
    public function UploadBlockImage($block_thumbnail, $block_slug)
    {
        $document_file          =   $block_thumbnail;
        $fileName               =   $document_file->getClientOriginalName();
        $file_mime_type         =   $document_file->getClientMimeType();
        $fileExtension          =   $document_file->getClientOriginalExtension();
        $fileName               =   $block_slug . '.' . $fileExtension;
        $public_img_path        =   public_path('/themes/demo/block-thumbs/');
        // unlink($public_img_path. $fileName);
        $block_thumbnail->move($public_img_path, $fileName);
        $base_img_path          =   base_path('/themes/demo/public/block-thumbs/');
        unlink($base_img_path . $fileName);
        File::copy($public_img_path . $fileName, $base_img_path . $fileName);
        return $fileName;
    }
    public function saveBlocks(Request $request)
    {
        // dd($request->all());
        $validate                   =   $this->validate($request, [
            'block_slug'            =>  'required',
            'block_title'           =>  'required',
            'block_category'        =>  'required',
            'block_html'            =>  'required',
            // 'block_css'             =>  'required',
        ]);
        $old_title_slug             =   PageBuilderBlocks::Where('id', $request->block_id)->value('title_slug');
        $block_slug                 =   ucwords($request->block_slug);
        $fileName                   =   "";
        if ($request->hasFile('block_thumbnail')) {
            $fileName               =   $this->UploadBlockImage($request->file('block_thumbnail'), $block_slug);
        } else {
            $filePath               =   public_path('/themes/demo/block-thumbs/') . $request->hidden_block_thumbnail;
            $fileMimeType           =   mime_content_type($filePath);
            $fileSize               =   filesize($filePath);
            $uploadedFile           =   new \Illuminate\Http\UploadedFile($filePath, $request->hidden_block_thumbnail, $fileMimeType, 0, true);
            $fileName               =   $this->UploadBlockImage($uploadedFile, $block_slug);
        }
        $fileContent                =   $request->block_html;
        $base_content_folder_path   =   base_path('/themes/demo/blocks/' . $block_slug);
        $base_content_file_path     =   $base_content_folder_path . '/view.html';
        $base_content_config_path   =   $base_content_folder_path . '/config.php';
        $base_config_content        =   "<?php \n return [\n    'title' => '$request->block_title',\n  'category' => '$request->block_category',\n  ]\n;";
        if ($old_title_slug != $block_slug) {
            $existance_base_content_folder_path =   base_path('/themes/demo/blocks/' . $old_title_slug . '/');
            if (is_dir($existance_base_content_folder_path)) {
                $files                          =   glob($existance_base_content_folder_path . '/*');
                foreach ($files as $file) {
                    unlink($file);
                }
                // Remove the folder itself
                rmdir($existance_base_content_folder_path);
            }
        }
        if (!File::exists($base_content_folder_path)) {
            File::makeDirectory($base_content_folder_path, 0777, true, true);
        }
        File::put($base_content_file_path, $fileContent);
        File::put($base_content_config_path, $base_config_content);

        // Start Block CSS added and update in webpagesbuilder.css
        if ($request->block_css) {
            $WebCSSFilePath                 =   [base_path('public_html/css/frontend/webpagesbuilder.css'), public_path('themes/demo/css/webpagesbuilder.css'), base_path('themes/demo/public/css/webpagesbuilder.css')];
            foreach ($WebCSSFilePath as $cssPath) {
                $cssContent                 =   file_get_contents($cssPath); 
                $block_title                =   str_replace(' ', '-', $request->block_title);
                $startMarker                =   "/* **start-$block_title-section** */";
                $endMarker                  =   "/* **end-$block_title-Section** */";
                $startMarkerPos             =   strpos($cssContent, $startMarker);
                $endMarkerPos               =   strpos($cssContent, $endMarker);

                if ($startMarkerPos !== false && $endMarkerPos !== false) {
                    $startMarkerLength      =   strlen($startMarker);
                    $contentBefore          =   substr($cssContent, 0, $startMarkerPos + $startMarkerLength);
                    $contentAfter           =   substr($cssContent, $endMarkerPos);
                    $updatedContent         =   $contentBefore . $request->block_css . $contentAfter;
                    file_put_contents($cssPath, $updatedContent);
                } else {
                    $updatedContent         =   "\n$startMarker\n" . $request->block_css . "\n$endMarker\n";
                    file_put_contents($cssPath, $cssContent . $updatedContent);
                }
            }
        }
        // End Block CSS added and update in webpagesbuilder.css

        if ($request->block_id) {
            $save_block             =   PageBuilderBlocks::find($request->block_id);
        } else {
            $save_block             =   new PageBuilderBlocks();
        }
        $save_block->title          =   ucwords($request->block_title);
        $save_block->category       =   $request->block_category;
        $save_block->css            =   $request->block_css ? $request->block_css : null;
        $save_block->html           =   $fileContent;
        $save_block->thumbnail      =   $fileName;
        $save_block->title_slug     =   $block_slug;
        $save_block->created_by     =   Auth::user()->id;
        if ($save_block->save()) {
            return response()->JSON([
                'status'            =>  'success',
                'msg'               =>  'block_added'
            ]);
        } else {
            return response()->JSON([
                'status'        =>  'failed',
                'msg'           =>  'not_added'
            ]);
        }
    }
    public function deleteBlock(Request $request)
    {
        $records                    =   json_decode($request->object_value);
        $public_img_path            =   public_path('/themes/demo/block-thumbs/' . $records->thumbnail);
        $base_img_path              =   base_path('/themes/demo/public/block-thumbs/' . $records->thumbnail);
        unlink($public_img_path);
        unlink($base_img_path);
        $base_content_folder_path   =   base_path('/themes/demo/blocks/' . $records->title_slug . '/');
        if (is_dir($base_content_folder_path)) {
            $files                  =   glob($base_content_folder_path . '/*');
            foreach ($files as $file) {
                unlink($file);
            }
            // Remove the folder itself
            rmdir($base_content_folder_path);
        }
        if (PageBuilderBlocks::WHERE('id', $request->id)->delete()) {
            return response()->JSON([
                'status'            =>  'success',
                'msg'               =>  'deleted'
            ]);
        } else {
            return response()->JSON([
                'status'            =>  'failed',
                'msg'               =>  'not_deleted'
            ]);
        }
    }
}
