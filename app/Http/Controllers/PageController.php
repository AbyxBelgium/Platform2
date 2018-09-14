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

        if (request()->wantsJson()) {
            $output = array();
            foreach ($pageRepresentation->getContainers() as $container) {
                $containerData = [];
                foreach ($container->getElements() as $element) {
                    array_push($containerData, [
                        "app" => $element->getApp()->getName(),
                        "identifier" => $element->getIdentifier(),
                        "uuid" => $element->getUuid()
                    ]);
                }
                array_push($output, [
                    "elements" => $containerData
                ]);
            }

            return response([
                "containers" => $output
            ]);
        } else {
            return response($pageRepresentation->createView());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appManager = new AppManager();
        $user = Auth::user();
        $page = Page::find($id);
        $pageManager = new PageManager();
        $pageRepresentation = $pageManager->parsePageConfiguration($page);
        return view('backend.pages.page.edit', [
            'elements' => $appManager->getAllElements(),
            'token' => $user->generateApiToken(),
            'page' => $page,
            'pageRepresentation' => $pageRepresentation
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
