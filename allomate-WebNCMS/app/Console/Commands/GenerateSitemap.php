<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command execute and generate site map.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return Sitemap
     */
    public function handle()
    {
        // $route_names    =   array('privacy-policy', 'terms-of-use');
        $route_names    =   [];
        $urlsToCheck    =   ['/privacy-policy', '/terms-of-use'];
        $other_routes   =   DB::table('footer_content')->select('footer_menu')->get();
        $collection     =   collect($other_routes);

        // Use the contains method to check if any of the URLs exist
        $exists         =   $collection->contains(function ($item) use ($urlsToCheck, &$route_names) {
            $footerMenu =   json_decode($item->footer_menu, true);
            foreach ($footerMenu as $menu) {
                if (in_array($menu['url'], $urlsToCheck)) {
                    $route_names[] = str_replace('/','',$menu['url']);
                }
            }
        });
        $blogs          =   DB::table('blogs')->where('published',1)->whereRaw("JSON_EXTRACT(page_meta_tags, '$.is_indexable') = '1'")->pluck("slug")->toArray();
        $careers        =   DB::table('careers')->where('status',1)->whereRaw("JSON_EXTRACT(page_meta_tags, '$.is_indexable') = '1'")->pluck("slug")->toArray();
        $pages          =   [];
    
        if (count($pages) > 0) {
            foreach ($pages as $key => $value) {
                $route_names[]  =   str_replace( '/', '', $value);
            }
        }
        if (count($blogs) > 0) {
            foreach ($blogs as $key => $blog) {
                $route_names[]  =   'blogs/blog-details/'.str_replace( '/', '', $blog);
            }
        }
        if (count($careers) > 0) {
            foreach ($careers as $key => $career) {
                $route_names[]  =   'career/'.str_replace( '/', '', $career);
            }
        }
        if (file_exists(public_path('sitemap.xml'))) {
            unlink(public_path('sitemap.xml'));
        }
        $siteUrl    =   rtrim(env('APP_URL', 'https://dottscale.com'), '/');
        $sitemap    =   Sitemap::create()->add(Url::create($siteUrl));

        $robotsTxtContent    =   "User-agent: *\n";
        $robotsTxtContent   .=  "Disallow: /admin/\n";
        $robotsTxtContent   .=  "Disallow: /login/\n";

        if (count($route_names) > 0) {
            foreach ($route_names as $key => $value) {
                $sitemap->add(Url::create($siteUrl.'/'.$value));
                $robotsTxtContent   .=  "Allow: /$value/\n";
            }
        }
        $sitemap->writeToFile(public_path('sitemap.xml'));
        $robotsTxtContent   .=  "Sitemap: ".$siteUrl."/sitemap.xml"; 
        $robotsTxtFilePath  =   public_path('robots.txt');
        if (file_exists($robotsTxtFilePath)) {
            unlink($robotsTxtFilePath);
        }
        // Write the content to the robots.txt file
        file_put_contents($robotsTxtFilePath, $robotsTxtContent);
        return $sitemap;
    }
}
