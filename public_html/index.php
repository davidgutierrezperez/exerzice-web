<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/init.php';

use Application\Security\AlreadyAuthenticatedException;
use Application\Security\AuthenticationException;
use Application\Security\AuthorizationException;
use Application\Security\EmptyRequestException;
use Controllers\ErrorController;
use Infrastructure\Http\RouteRedirector;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Twig loader
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../frontend/templates');
$twig = new \Twig\Environment($loader);

// Loading routes
$dispatcher = FastRoute\simpleDispatcher(require __DIR__ . '/../config/routes.php');

// Getting URL information
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Cleaning query string
$uri = strtok($uri, '?');
$uri = rawurldecode($uri);

$uri = rtrim($uri, '/');

if ($uri === '') {
    $uri = '/';
}

// Route information
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

// Router state
$routerState = $routeInfo[0];

// Router handling
switch ($routerState) {
    case FastRoute\Dispatcher::NOT_FOUND:
        (new ErrorController($twig))->notFound();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        (new ErrorController($twig))->forbidden();
        break;
    case FastRoute\Dispatcher::FOUND:
        try {
            $route = $routeInfo[1];
            $vars = $routeInfo[2];

            // Execute middlewares
            foreach ($route->getMiddlewares() as $middlewareClass) {
                (new $middlewareClass())->execute();
            }

            // Controller instancing
            $controller = new ($route->getHandler())($twig);

            // Calling the method to execute
            $response = $controller->{$route->getHandlerMethod()}(...array_values($vars));
        } catch (AuthenticationException){
            RouteRedirector::redirect('/login');
        } catch (AuthorizationException){
            RouteRedirector::redirect('/forbidden');
        } catch (AlreadyAuthenticatedException){
            RouteRedirector::redirect('/');
        } catch (EmptyRequestException){
            RouteRedirector::redirect('/uups');
        }

        break;
}
?>