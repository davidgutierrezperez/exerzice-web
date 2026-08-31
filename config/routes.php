<?php

use Application\Middleware\RequireAuthenticatedMiddleware;
use Application\Middleware\RequireUnauthenticatedMiddleware;
use Controllers\Action\Auth\LoginController;
use Controllers\Action\Auth\RegisterController;
use Controllers\Action\PostController;
use Controllers\ErrorController;
use Controllers\View\Auth\LoginViewController;
use Controllers\View\Auth\RegisterViewController;
use Controllers\View\HomeViewController;
use Controllers\View\PostViewController;
use Controllers\View\ProfileViewController;
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

    $r->addRoute(HttpMethod::GET->value, '/user/{id:[0-9a-fA-F-]{36}}', new Route(ProfileViewController::class, 'profile'));
    $r->addRoute(HttpMethod::GET->value, '/me', new Route(ProfileViewController::class, 'me', [RequireAuthenticatedMiddleware::class]));

    $r->addRoute(HttpMethod::GET->value, '/create-post', new Route(PostViewController::class, 'create', [RequireAuthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::GET->value, '/post/{id:[0-9a-fA-F-]{36}}', new Route(PostViewController::class, 'index'));
    $r->addRoute(HttpMethod::POST->value, '/post', new Route(PostController::class, 'create', [RequireAuthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::POST->value, '/post/{id:[0-9a-fA-F-]{36}}/like', new Route(PostController::class, 'like', [RequireAuthenticatedMiddleware::class]));
    $r->addRoute(HttpMethod::POST->value, '/post/{id:[0-9a-fA-F-]{36}}/unlike', new Route(PostController::class, 'unlike', [RequireAuthenticatedMiddleware::class]));

    $r->addRoute(HttpMethod::GET->value, '/not-found', new Route(ErrorController::class, 'notFound'));
    $r->addRoute(HttpMethod::GET->value, '/forbidden', new Route(ErrorController::class, 'forbidden'));
    $r->addRoute(HttpMethod::GET->value, '/uups', new Route(ErrorController::class, 'uups'));
}

?>