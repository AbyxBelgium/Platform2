<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Managers\SystemResourceManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DesktopController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Initialize the desktop page.
     *
     * @return Response
     */
    public function show() {
        $posts = DB::table('posts')->orderByDesc('created_at')->take(10)->get();

        $categoryCount = DB::table('categories')->count();
        $postCount = DB::table('posts')->count();
        $userCount = DB::table('users')->count();

        $user = Auth::user();
        $token = $user->createToken('Platform2')->accessToken;

        return view('backend.pages.desktop', [
            'categoryCount' => $categoryCount,
            'postCount' => $postCount,
            'userCount' => $userCount,
            'posts' => $posts,
            'token' => $token
        ]);
    }
}
