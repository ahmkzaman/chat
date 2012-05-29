<?php

class NicknameUnique implements Drozd_Validator_Interface 
{
    const NOT_UNIQUE = 1;
    
    public function isValid($value, $data = array()) 
    {   
         $userStorage = new User_Storage();
        if ( $userStorage->findUserByNickname($value) == false ) {
            return true;
        }
         
        return self::NOT_UNIQUE;

    }
}