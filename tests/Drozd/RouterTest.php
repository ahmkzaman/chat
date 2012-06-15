<?php

class Drozd_RouterTest extends PHPUnit_Framework_TestCase
{
    public function testGetControllerNameReturnsIndexControllerByDefault()
    {
        $router = new Drozd_Router();
        
        $actual = $router->getControllerName();
        $expected = "IndexController";
        $this->assertEquals($expected, $actual);
    }
    
    public function testGetControllerNameFromRequest()
    {
        $router = new Drozd_Router();
        $_REQUEST['controller'] = 'suchka';
        $actual = $router->getControllerName();
        $expected = "SuchkaController";
        $this->assertEquals($expected, $actual);
    }
    
    public function testGetActionNameReturnsIndexActionByDefault()
    {
        $router = new Drozd_Router();
        $actual = $router->getActionName();
        $expected = "indexAction";
        $this->assertEquals($expected, $actual);
    }
    
    public function testGetActionNameFromRequest()
    {
        $router = new Drozd_Router();
        $_REQUEST['action'] = 'kaka-sraka-biaka';
        $actual = $router->getActionName();
        $expected = "kakaSrakaBiakaAction";
        $this->assertEquals($expected, $actual);
    }
}