<?php

class Drozd_Router
{
    public function getControllerName()
    {
        $controller = "Index";
        if ( isset($_REQUEST['controller']) ) {
            $controller = $_REQUEST['controller'];
        }
        
        $controller = ucfirst($controller . "Controller");
        
        return $controller;
    }
    
    public function getActionName()
    {
        $action = 'index';
        if ( isset($_REQUEST['action']) ) {
            $action = $_REQUEST['action'];
        }  
        
        $action = str_replace('-', ' ', $action);
        $action = ucwords($action);
        $action = lcfirst($action);
        $action = str_replace(' ', '', $action);
        $action .= "Action";
        
        return $action;
    }
}