<?php
// Inicialize a aplicação e carregue as configurações
require './config.php';

function autoloader($class) {
    if (str_contains($class, 'Controller')) {
        include './src/Controllers/' . $class . '.php';
    }

    if (str_contains($class, 'Service')) {
        include './src/Services/' . $class . '.php';
    }
}

spl_autoload_register('autoloader');

$request_uri = str_replace(BASE_PATH, '', $_SERVER['REQUEST_URI']);

require './routes.php';

$route = isset($routes[$request_uri]) ? $routes[$request_uri] : die('Rota não cadastrada.');
$route = explode('@', $route);

if (!isset($route[0]) || !isset($route[1])) {
    die('Rota configurada incorretamente: ');
}

$controller = $route[0];
$method = $route[1];

$controllerInstance = new $controller();
$controllerInstance->$method();