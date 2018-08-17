<?php

use App\Catalogue\AppRoute;
use App\Managers\AppManager;

function appRoute(string $app, string $routeName) {
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
        if ($appRoute->getName() == $routeName) {
            $route = $appRoute;
            break;
        }
    }

    // TODO some way to notify user of error here!
    if ($route == null) {
        return "";
    }

    $type = $route->getType();

    switch($type) {
        case "GET": {
            return route('app/get', ["app" => $app, "route" => $routeName]);
            break;
        }
        case "POST": {
            return route('app/post', ["app" => $app, "route" => $routeName]);
            break;
        }
        case "PUT": {
            return route('app/put', ["app" => $app, "route" => $routeName]);
            break;
        }
        case "DELETE": {
            return route('app/delete', ["app" => $app, "route" => $routeName]);
            break;
        }
    }

    // TODO REROUTE TO SOME ERROR CAPTURING ROUTE
    return "";
}

?>
