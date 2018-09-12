<?php


namespace App\Catalogue\Apps\Base;

use App\Catalogue\App;
use App\Catalogue\AppController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class HTMLContentController extends AppController
{
    public function create(Request $request)
    {
        $keyValuePairs = Input::get('data-pairs');
        $dataResults = json_decode($keyValuePairs, true);

        $propertyHandler = $this->app->getPropertyHandler();
        $propertyHandler->setProperty("content-" . Input::get('uuid'), $dataResults['Content']);

        return response()->json([
            "status" => 1
        ]);
    }

    public function show($request, App $app, string $uuid)
    {
        $propertyHandler = $app->getPropertyHandler();
        return View::make('Base.any-html-content', ["content" => $propertyHandler->getProperty("content-" . $uuid, "")]);
    }
}
