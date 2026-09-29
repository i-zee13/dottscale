<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Home;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;

class FrontendController extends Controller
{
    public function page(string $page = 'home')
    {
        $view = 'frontend.' . str_replace('/', '.', $page);

        if (!view()->exists($view)) {
            abort(404);
        }

        $data = [];
        if ($page === 'home') {
            $data['home'] = Schema::hasTable('home') ? Home::first() : null;
            $data['services'] = Schema::hasTable('services')
                ? Service::where('status', 1)->orderBy('sort_order')->orderBy('id')->get()
                : collect();
        }
        if ($page === 'about-us') {
            $data['about'] = Schema::hasTable('abouts') ? AboutUs::first() : null;
        }

        return view($view, $data);
    }
}
