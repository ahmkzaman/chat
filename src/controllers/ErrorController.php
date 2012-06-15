<?php

class ErrorController extends Drozd_Controller
{
    public function notFoundAction()
    {
        header('HTTP/1.1 404 Not Found');
        include "../src/templates/page404.php";
    }
}