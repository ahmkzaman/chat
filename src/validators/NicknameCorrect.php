<?php

class NicknameCorrect implements Drozd_Validator_Interface 
{
    const NOT_CORRECT = 1;
    
    public function isValid($value, $data = array()) 
    {   
        if ( preg_match('/\s/', $value) ) {
            return self::NOT_CORRECT;
        }
         
        return true;
    }
}