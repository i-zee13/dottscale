<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function productPage()
    {
        return view('learn-more');
    }
    public function getDemoPage()
    {
        return view('getdemo');
    }
    public function iosDeveloperPage()
    {
        return view('ios-developer');
    }
    public function fieldTranerPage()
    {
        return view('field-traner');
    }
    public function businessDevelopmentPage()
    {
        return view('business-development');
    }
    public function privacyPolicyPage()
    {
        return view('privacy-policy');
    }
    public function softwareQualityPage()
    {
        return view('software-quality');
    }
    public function contactUsPage()
    {
        return view('contact');
    }
    public function siteMap()
    {
        Artisan::call('sitemap:generate');
        $routes =   genrateSiteMap(); 
        return view('sitemap', compact('routes'));
    }
}
