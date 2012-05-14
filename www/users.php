<?php

require_once "../src/functions/common.php";

$action = 'login-user';
if ( isset($_REQUEST['action']) ) {
    $action = $_REQUEST['action'];
}  

$dir = "../src/actions/users/";
if ( file_exists($dir . $action . ".php") ) {
    include $dir . $action . ".php";   
} else {
    include "../src/actions/error/404.php";
}
