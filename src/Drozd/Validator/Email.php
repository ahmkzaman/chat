<?php


class Drozd_Validator_Email implements Drozd_Validator_Interface 
{
    const INVALID_EMAIL = 1;
    
    public function isValid($value, $data = array()) 
    {
        if ( preg_match('/^[^0-9][a-zA-Z0-9_]*([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i', $value) ) {
            return true;
        }
        
        return self::INVALID_EMAIL;
    }
}
