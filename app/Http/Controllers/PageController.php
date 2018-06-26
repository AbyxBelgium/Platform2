<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Managers\AppManager;
use App\Managers\PageManager;
use App\Page;
use http\Env\Response;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.page.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appManager = new AppManager();
        return view('backend.pages.page.create', ['elements' => $appManager->getAllElements()]);
    }

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
