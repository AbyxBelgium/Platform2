<?php

namespace App\Http\Controllers\Api;

use App\Managers\SystemResourceManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SystemResourceManager $resourceManager)
    {
        return Response([
            "cpu" => $resourceManager->getCPULoad(),
            "memory" => $resourceManager->getMemoryLoad(),
            "storage" => $resourceManager->getStorageUsage()
        ]);
    }
}
