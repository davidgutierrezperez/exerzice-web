<?php

use Controllers\Auth\LoginController;
use Controllers\Auth\RegisterController;
use Controllers\ErrorController;
use Controllers\HomeController;
use Infrastructure\Http\HttpMethod;
/**
 * Returns and configures all the routes of the application.
 */
return function(\FastRoute\RouteCollector $r) {
    $r->addRoute(HttpMethod::GET->value, '/', HomeController::class . '@index');
    $r->addRoute(HttpMethod::GET->value, '/index', HomeController::class . '@index');
    
    $r->addRoute(HttpMethod::GET->value, '/login', LoginController::class . '@index');
    $r->addRoute(HttpMethod::POST->value, '/login', LoginController::class . '@login');
    $r->addRoute(HttpMethod::GET->value, '/register', RegisterController::class . '@index');

    $r->addRoute(HttpMethod::GET->value, '/not-found', ErrorController::class . '@notFound');
    $r->addRoute(HttpMethod::GET->value, '/forbidden', ErrorController::class . '@forbidden');
}

?>