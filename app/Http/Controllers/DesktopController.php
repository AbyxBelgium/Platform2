<?php

namespace App\Http\Controllers;

use App\Managers\SystemResourceManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DesktopController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Initialize the desktop page.
     *
     * @param SystemResourceManager Current ResourceManager that can be used to monitor system usage.
     * @return Response
     */
    public function show(SystemResourceManager $resourceManager) {
        return view('backend.pages.desktop', ["resourceManager" => $resourceManager]);
    }
}
