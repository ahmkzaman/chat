<?php

  /*** nullify any existing autoloads ***/
    spl_autoload_register(null, false);

    /*** specify extensions that may be loaded ***/
    spl_autoload_extensions('.php');

    /*** class Loader ***/

    function formsLoader($class)
    {
        $filename = $class . '.php';
        $file ='../src/forms/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }

    function drozdLoader($class)
    {
        $filename = str_replace('_', '/', $class . '.php');
        $file ='../src/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
    
    
    function validatorLoader($class)
    {
        $filename = $class . '.php';
        $file ='../src/validators/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
    
    function classLoader($class)
    {
        $filename = str_replace('_', '/', $class . '.php');
        $file ='../src/class/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
    
    function controllersLoader($class)
    {
        $filename = str_replace('_', '/', $class . '.php');
        $file ='../src/controllers/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
    

    
    spl_autoload_register('classLoader');
    spl_autoload_register('formsLoader');
    spl_autoload_register('drozdLoader');
    spl_autoload_register('validatorLoader');
    spl_autoload_register('controllersLoader');