<?php 
require_once __DIR__ . '/vendor/autoload.php';

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/frontend/templates');
$twig = new \Twig\Environment($loader);

?>