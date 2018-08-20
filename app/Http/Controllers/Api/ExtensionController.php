<?php
/**
 * @author Pieter Verschaffelt
 */


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Managers\AppManager;
use Illuminate\Support\Facades\Response;

class ExtensionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }

    /**
     * Returns the HTML representing the extension's frontend.
     *
     * @param string $appName
     * @param string $extensionName
     * @return Response
     */
    public function extensionView(string $appName, string $extensionName)
    {
        $extension = $this->getExtensionByApp($appName, $extensionName);
        return $extension->getContent();
    }

    /**
     * Returns the HTML representing the extension's backend, used for configuring this particular extension.
     *
     * @param string $appName
     * @param string $extensionName
     * @return \Illuminate\Http\JsonResponse
     */
    public function extensionSettings(string $appName, string $extensionName)
    {
        $extension = $this->getExtensionByApp($appName, $extensionName);
        return response()->json(
            [
                "content" => $extension->getBackendContent()
            ]
        );
    }

    private function getExtensionByApp(string $appName, string $extensionName)
    {
        $appManager = new AppManager();
        $app = $appManager->getApp($appName);
        return $app->getElementByIdentifier($extensionName);
    }
}
