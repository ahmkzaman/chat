<?php

class Drozd_Validator_Required implements Drozd_Validator_Interface 
{
    const IS_REQUIRED = 1;
    
    public function isValid($value, $data = array()) 
    {
        if ( $value !== null ) {
            return true;
        }
        
        return self::IS_REQUIRED;
    }
}
