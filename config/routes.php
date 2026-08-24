<?php

use Application\Middleware\RequireAuthenticatedMiddleware;
use Application\Middleware\RequireUnauthenticatedMiddleware;
use Controllers\Action\Auth\LoginController;
use Controllers\Action\Auth\RegisterController;
use Controllers\ErrorController;
use Controllers\View\Auth\LoginViewController;
use Controllers\View\Auth\RegisterViewController;
use Controllers\View\HomeViewController;
use Domain\Route;
use Infrastructure\Http\HttpMethod;
/**
 * Returns and configures all the routes of the application.
 */
return function(\FastRoute\RouteCollector $r) {
    $r->addRoute(HttpMethod::GET->value, '/', new Route(HomeViewController::class, 'index'));
    $r->addRoute(HttpMethod::GET->value, '/index', new Route(HomeViewController::class, 'index'));
    
    $r->addRoute(HttpMethod::GET->value, '/login', new Route(LoginViewController::class, 'index', [RequireUnauthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::POST->value, '/login', new Route(LoginController::class, 'login', [RequireUnauthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::GET->value, '/logout', new Route(LoginController::class, 'logout', [RequireAuthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::GET->value, '/register', new Route(RegisterViewController::class, 'index', [RequireUnauthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::POST->value, '/register', new Route(RegisterController::class, 'register', [RequireUnauthenticatedMiddleware::class]));

    $r->addRoute(HttpMethod::GET->value, '/not-found', new Route(ErrorController::class, 'notFound'));
    $r->addRoute(HttpMethod::GET->value, '/forbidden', new Route(ErrorController::class, 'forbidden'));
    $r->addRoute(HttpMethod::GET->value, '/uups', new Route(ErrorController::class, 'uups'));
}

?>