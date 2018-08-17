<?php


namespace App\Catalogue\Apps\Base;


use App\Catalogue\AppController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class HTMLContentController extends AppController
{
    public function create(Request $request) {
        $content = Input::get('content');
    }
}
