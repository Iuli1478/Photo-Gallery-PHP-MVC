<?php

session_start();

require_once 'includes/config.php';

$requestParts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$controllerName = DEFAULT_CONTROLLER;
$actionName = DEFAULT_ACTION;

$params = array_splice($requestParts, 3);

if (count($requestParts) >= 2 && $requestParts[1] != "") {
    $controllerName = $requestParts[1];
}

if (count($requestParts) >= 3 && $requestParts[2] != "") {
    $actionName = $requestParts[2];
}

$controllerClassName = ucfirst(strtolower($controllerName)) . 'Controller';
$controllerFileName = "controllers/" . $controllerClassName . '.php';
 
if (class_exists($controllerClassName )) {
    $controller  = new $controllerClassName($actionName, $controllerName);
} else {
    die("Cannot find controller '$controllerName' in class '$controllerFileName'");
}

if (method_exists($controller, $actionName )) {
   // $controller -> {$actionName}($params);
    call_user_func_array(array($controller, $actionName), $params);
    $controller->renderView();
} else {
    die("Cannot find action '$actionName' in class '$controllerClassName'");
}

$controller->renderView();

function __autoload($class_name) {
    if (file_exists("controllers/$class_name.php")) {
        include "controllers/$class_name.php";
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
}