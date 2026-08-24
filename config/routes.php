<?php

use Application\Middleware\AuthenticationMiddleware;
use Controllers\Auth\LoginController;
use Controllers\Auth\RegisterController;
use Controllers\ErrorController;
use Controllers\HomeController;
use Domain\Route;
use Infrastructure\Http\HttpMethod;
/**
 * Returns and configures all the routes of the application.
 */
return function(\FastRoute\RouteCollector $r) {
    $r->addRoute(HttpMethod::GET->value, '/', new Route(HomeController::class, 'index'));
    $r->addRoute(HttpMethod::GET->value, '/index', new Route(HomeController::class, 'index'));
    
    $r->addRoute(HttpMethod::GET->value, '/login', new Route(LoginController::class, 'index', [AuthenticationMiddleware::class]));
    $r->addRoute(HttpMethod::POST->value, '/login', new Route(LoginController::class, 'login', [AuthenticationMiddleware::class]));
    $r->addRoute(HttpMethod::GET->value, '/register', new Route(RegisterController::class, 'index', [AuthenticationMiddleware::class]));

    $r->addRoute(HttpMethod::GET->value, '/not-found', new Route(ErrorController::class, 'notFound'));
    $r->addRoute(HttpMethod::GET->value, '/forbidden', new Route(ErrorController::class, 'forbidden'));
}

?>