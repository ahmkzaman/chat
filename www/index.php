<?php

error_reporting(E_ALL | E_STRICT);

include '../src/autoload.php';

$controller = "index";
if ( isset($_REQUEST['controller']) ) {
    $controller = $_REQUEST['controller'];
}

$action = 'index';
if ( isset($_REQUEST['action']) ) {
    $action = $_REQUEST['action'];
}  

$dir = "../src/actions/" . $controller . "/";
if ( file_exists($dir . $action . ".php") ) {
    include $dir . $action . ".php";   
} else {
    include "../src/actions/error/404.php";
}

