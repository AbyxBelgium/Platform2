<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Initialize the user's homepage.
     *
     * @return Response
     */
    public function show() {
        return view('frontend.pages.home');
    }
}
