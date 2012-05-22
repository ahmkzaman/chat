<?php

class NicknameExists implements Drozd_Validator_Interface 
{
    const NOT_EXISTS = 1;
    
    public function isValid($value, $data = array()) 
    {
        if ( $userStorage->findUserByNickname($value) !== false ) {
            return true;
        }
         
        return self::NOT_EXISTS;
    }
}
