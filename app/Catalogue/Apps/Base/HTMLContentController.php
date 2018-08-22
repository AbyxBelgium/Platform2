<?php


namespace App\Catalogue\Apps\Base;

use App\Catalogue\AppController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class HTMLContentController extends AppController
{
    public function create(Request $request) {
        $keyValuePairs = Input::get("data-pairs");
        $dataResults = json_decode($keyValuePairs, true);

        return response()->json([
            "status" => 1
        ]);
    }
}
