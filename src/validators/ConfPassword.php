<?php

class ConfPassword implements Drozd_Validator_Interface 
{
    const NOT_SAME = 1;
    
    public function isValid($value, $data = array()) 
    {
        if ($value != $data['password']) {
            return self::NOT_SAME;
        }
            
        return true;
    }
}
