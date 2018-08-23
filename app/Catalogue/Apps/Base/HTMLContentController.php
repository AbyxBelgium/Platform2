<?php


namespace App\Catalogue\Apps\Base;

use App\Catalogue\App;
use App\Catalogue\AppController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class HTMLContentController extends AppController
{
    public function create(Request $request) {
        $keyValuePairs = Input::get("data-pairs");
        $dataResults = json_decode($keyValuePairs, true);

        $propertyHandler = $this->app->getPropertyHandler();
        $propertyHandler->setProperty("content", "blub! Dit is data!");

        return response()->json([
            "status" => 1
        ]);
    }
}
