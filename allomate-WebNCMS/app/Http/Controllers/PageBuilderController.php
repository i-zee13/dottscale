<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function build($pageId = null)
    {
        $route = $_GET['route'] ?? null;
        $action = $_GET['action'] ?? null;
        $pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
        $pageRepository = new \PHPageBuilder\Repositories\PageRepository;
        $page = $pageRepository->findWithId($pageId); //getting record from DB
        $phpPageBuilder = app()->make('phpPageBuilder');
        $pageBuilder = $phpPageBuilder->getPageBuilder();
        //  dd($page,$route,$action);

        $customScripts = view("pagebuilder.scripts")->render();
        $pageBuilder->customScripts('head', $customScripts);
        $pageBuilder->handleRequest($route, $action, $page);
        
    }
}
