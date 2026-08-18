<?php

use Controllers\ErrorController;
use Controllers\HomeController;
use Infrastructure\Http\HttpMethod;
/**
 * Returns and configures all the routes of the application.
 */
return function(\FastRoute\RouteCollector $r) {
    $r->addRoute(HttpMethod::GET->value, '/', HomeController::class . '@index');
    $r->addRoute(HttpMethod::GET->value, '/index', HomeController::class . '@index');

    $r->addRoute(HttpMethod::GET->value, '/not-found', ErrorController::class . '@notFound');
    $r->addRoute(HttpMethod::GET->value, '/forbidden', ErrorController::class . '@forbidden');
}

?>