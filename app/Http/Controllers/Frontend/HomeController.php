<?php

namespace App\Http\Controllers\Frontend;

use App\System\MarkdownConverter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Initialize the user's homepage.
     *
     * @return Response
     */
    public function show() {
        $posts = DB::table('posts')->take(3)->get();
        return view('frontend.pages.home', [
            'posts' => $posts
        ]);
    }
}
