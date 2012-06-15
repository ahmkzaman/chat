<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

include '../src/autoload.php';

$router = new Drozd_Router();
$controllerName = $router->getControllerName();
$actionName = $router->getActionName();

/**
 * @todo FIX 404 error 
 */
$controller = new $controllerName();
call_user_func(array($controller, $actionName));

