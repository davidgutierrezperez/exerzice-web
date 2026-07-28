<?php 

require_once __DIR__ . '/../backend/infraestructure/http/HttpMethod.php'; 
require_once __DIR__ . '/../backend/controllers/HomeController.php';

/**
 * Returns and configures all the routes of the application.
 */
return function(\FastRoute\RouteCollector $r) {
    $r->addRoute(HttpMethod::GET->value, '/', 'HomeController@index');
    $r->addRoute(HttpMethod::GET->value, '/index', 'HomeController@index');
}

?>