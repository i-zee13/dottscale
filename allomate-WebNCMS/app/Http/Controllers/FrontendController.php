<?php

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function page(string $page = 'home')
    {
        $view = 'frontend.' . str_replace('/', '.', $page);

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }
}
