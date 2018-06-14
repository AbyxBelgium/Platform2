<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
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
        $posts = DB::table('posts')->simplePaginate(15);
        return view('backend.pages.post.index', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO sort by alphabet -- but uncategorized always first!
        $categories = Category::all()->sortBy(function($category) {
            if ($category->name == "Uncategorized") {
                return "A";
            } else {
                return $category->name;
            }
        });
        return view('backend.pages.post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'category' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('backend/post/create')->withErrors($validator->errors())->withInput();
        } else {
            $post = new Post();

            $splittedTags = array_unique(explode(', ', Input::get('tags')));
            $tags = [];

            foreach ($splittedTags as $tag) {
                $currentTag = Tag::where('name', $tag)->first();
                if (!$currentTag) {
                    $currentTag = new Tag();
                    $currentTag->name = $tag;
                    $currentTag->save();
                }
                array_push($tags, $currentTag->id);
            }


            $post->title = Input::get('title');
            $post->content = Input::get('content');
            $post->user(Auth::user());

            $category = Category::find(Input::get('category'));
            $post->category($category);

            $post->save();

            $post->tags()->sync($tags);

            return redirect()->route('backend/post/index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        Post::destroy($id);
        return redirect()->route('backend/post/index');
    }
}
