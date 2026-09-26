<?php

namespace App\Http\Controllers;

use App\Models\Home;

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
            $data['home'] = Home::first();
        }

        return view($view, $data);
    }
}
