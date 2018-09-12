<?php


namespace App\Http\Controllers\App;


use App\Catalogue\AppRoute;
use App\Managers\AppManager;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AppController
{
    public function resolveRoute(Request $request, string $app, string $route) {
        $appManager = new AppManager();
        $appMainClass = $appManager->getApp($app);

        /**
         * @var AppRoute[] $routes
         */
        $routes = $appMainClass->getRoutes();

        /**
         * @var AppRoute $appRoute
         */
        $appRoute = null;
        $route = urldecode($route);

        foreach ($routes as $currentRoute) {
            if ($currentRoute->getName() === $route) {
                $appRoute = $currentRoute;
                break;
            }
        }

        if ($appRoute == null) {
            abort(404);
        }

        return $appManager->invokeControllerFunction($appMainClass, $appRoute->getExecutor(), $request);
    }
}
