<?php

namespace App\Http\Controllers;

use App\Category;
use App\Managers\IconManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $rules = [
        'name' => 'required',
        'icon' => 'required'
    ];

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
        $categories = DB::table('categories')->simplePaginate(15);
        return view('backend.pages.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(IconManager $iconManager)
    {
        return view('backend.pages.category.create', ['iconManager' => $iconManager]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, IconManager $iconManager)
    {
        return $this->storeOrUpdate(new Category(), $iconManager);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, IconManager $iconManager)
    {
        $category = Category::find($id);
        return view('backend.pages.category.edit', ['category' => $category, 'iconManager' => $iconManager]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, IconManager $iconManager)
    {
        $category = Category::find($id);
        return $this->storeOrUpdate($category, $iconManager);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('backend/category/index');
    }

    private function storeOrUpdate(Category $category, IconManager $iconManager) {
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return redirect()->route('backend/category/create')->withErrors($validator->errors())->withInput();
        } else if (!in_array(Input::get('icon'), $iconManager->icons)) {
            return redirect()->route('backend/category/create')->withErrors(['icon' => 'The provided icon is not a valid icon!'])->withInput();
        } else {
            $category->name = Input::get('name');
            $category->icon = Input::get('icon');
            $category->save();

            return redirect()->route('backend/category/index');
        }
    }
}
