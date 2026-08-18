<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/init.php';

use Application\AuthenticationException;
use Application\AuthoritationExcepcion;
use Controllers\ErrorController;
use Controllers\HomeController;

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
            $handler = $routeInfo[1]; 
            $vars = $routeInfo[2];   

            // Getting the controller and method to call
            [$controllerName, $method] = explode('@', $handler);

            // Controller instancing
            $controller = new $controllerName($twig);

            // Calling the method to execute
            $controller->$method(...array_values($vars));
        } catch (AuthenticationException){
            header('Location: /login');
        } catch (AuthoritationExcepcion){
            header('Location: /forbidden');
        }

        break;
}
?>