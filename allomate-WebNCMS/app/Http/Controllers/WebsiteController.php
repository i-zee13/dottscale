<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    //
    /**
 * Show the website page that corresponds with the current URI.
 */
    public function uri()
    {
        abort(404);
    }
}
