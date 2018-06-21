<?php

namespace App\Http\Controllers\Frontend;

use App\System\Page\Page;
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
        $page = new Page("Dit is de titel van een pagina", []);
        return response($page->createView());
    }
}
