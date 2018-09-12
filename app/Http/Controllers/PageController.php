<?php

namespace App\Http\Controllers;

use App\Managers\AppManager;
use App\Managers\PageManager;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = DB::table('pages')->simplePaginate(15);
        return view('backend.pages.page.index', ["pages" => $pages]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appManager = new AppManager();
        $user = Auth::user();
        return view('backend.pages.page.create', [
            'elements' => $appManager->getAllElements(),
            'token' => $user->generateApiToken()
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        // TODO check that all necessary components are present in parsed json
        $parsed = json_decode(Input::get("content"), true);
        $page->name = Input::get("title");
        // TODO implement icons
        $page->icon = "android";
        $page->save();

        Storage::disk('local')->put('pages/' . $page->name . '.json', json_encode($parsed, JSON_PRETTY_PRINT));

        return redirect()->route('backend/page/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        Storage::disk('local')->delete('pages/' . $page->name . '.json');
        Page::destroy($id);
        return redirect()->route('backend/page/index');
    }
}
