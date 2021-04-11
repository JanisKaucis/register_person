<?php
require_once '../../vendor/autoload.php';
//pievieno vards uzvards, personas kods,piezimju bloks
//meklesana pec personas koda var atrast personu vai uzvarda
//iespeja dzest vai labot kad atrod, var labot tikai pierakstu bloku
//izvedo personas, vertibas, parbauda vai strada ar testu

use App\Controllers\PageController;
use App\Controllers\PersonLoginController;
use App\Controllers\HomeController;
session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute(['GET', 'POST'], '/', [HomeController::class, 'getPersonsList', 'searchPerson', 'SearchAfterCode', 'refreshData']);
    $r->addRoute('POST', '/PersonLoginPage', [PersonLoginController::class, 'login']);
    $r->addRoute('GET', '/GetTokenPage', [PersonLoginController::class, 'getToken']);
    $r->addRoute('POST', '/TokenPage', [PersonLoginController::class, 'enterToken']);
    $r->addRoute('GET', '/Page', [PageController::class, 'findPerson']);
    $r->addRoute('POST', '/index', [HomeController::class, 'getPersonsList', 'searchPerson', 'SearchAfterCode', 'refreshData']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $controller = $handler[0];
        $class = new $controller;
        $firstFunction = $handler[1];

        $class->$firstFunction();
        if (!empty($handler[2])) {
            $secondFunction = $handler[2];
            $class->$secondFunction();
        }
        if (!empty($handler[3])) {
            $thirdFunction = $handler[3];
            $class->$thirdFunction();
        }
        if (!empty($handler[4])) {
            $fourthFunction = $handler[4];
            $class->$fourthFunction();
        }

        // ... call $handler with $vars
        break;
}

if ($httpMethod == 'GET' && isset($_SESSION['person'])) {
    unset($_SESSION['person']);
}