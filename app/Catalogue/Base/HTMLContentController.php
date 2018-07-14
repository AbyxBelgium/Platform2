<?php


namespace App\Catalogue\Base;


use App\Catalogue\AppController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class HTMLContentController extends AppController
{
    public function create(Request $request) {
        $content = Input::get('content');
        dd($content);
    }
}
