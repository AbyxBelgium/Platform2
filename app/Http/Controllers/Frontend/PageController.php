<?php

namespace App\Http\Controllers\Frontend;

use App\Managers\PageManager;
use App\Page;
use App\System\Page\PageRepresentation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PageController extends Controller
{
    /**
     * Initialize the current page.
     *
     * @return Response
     */
    public function show($id) {
        $pageManager = new PageManager();
        $pageRepresentation = $pageManager->parsePageConfiguration(Page::find($id));
        return response($pageRepresentation->createView());
    }
}
