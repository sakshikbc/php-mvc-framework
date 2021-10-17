<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MVC\App\Controllers\AuthController;
use MVC\App\Controllers\SiteController;
use MVC\Core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

// $app->router->get('/contact', function() {
//     return "Hello Contact";
// });
// var_dump(dirname(__DIR__));

$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->run();