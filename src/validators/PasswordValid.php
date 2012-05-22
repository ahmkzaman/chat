<?php

class PasswordValid implements Drozd_Validator_Interface 
{
    const NOT_VALID = 1;
    const USER_NOT_FOUND = 2;
    
    public function isValid($value, $data = array()) 
    {
        $user = $userStorage->findUserByNickname($data['nickname']);
        
        if ( $user === false ) {
            return self::USER_NOT_FOUND;
        }
        
        if ($user->getPassword() != md5($value)) {
            return self::NOT_VALID;
        }
            
        return true;
    }
}
