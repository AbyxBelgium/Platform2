<?php

use App\Catalogue\AppRoute;
use App\Managers\AppManager;

function appRoute(string $app, string $route) {
    $appManager = new AppManager();
    $appInstance = $appManager->getApp($app);
    $routes = $appInstance->getRoutes();

    /**
     * @var AppRoute $route
     */
    $route = null;

    /**
     * @var AppRoute $appRoute
     */
    foreach ($routes as $appRoute) {
        if ($appRoute->getName() === $route) {
            $route = $appRoute;
            break;
        }
    }

    $type = $route->getType();

    switch($type) {
        case "GET": {
            return route('app/get', ["app" => $app, "route" => $route]);
            break;
        }
        case "POST": {
            return route('app/post', ["app" => $app, "route" => $route]);
            break;
        }
        case "PUT": {
            return route('app/put', ["app" => $app, "route" => $route]);
            break;
        }
        case "DELETE": {
            return route('app/delete', ["app" => $app, "route" => $route]);
            break;
        }
    }

    // TODO REROUTE TO SOME ERROR CAPTURING ROUTE
    return "";
}

?>
