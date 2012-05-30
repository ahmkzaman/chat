<?php

class RegPasswordValid implements Drozd_Validator_Interface 
{
    const NOT_LONG = 1;
    
    public function isValid($value, $data = array()) 
    {
        if (strlen($value) < 8) {
            return self::NOT_LONG; 
        }
            
        return true;
    }
}
