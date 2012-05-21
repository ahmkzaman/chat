<?php
require_once '../src/class/User.php';

class User_Storage {
    public function addUser(User $user) {
        $nickname = $user->getNickname();
        $email = $user->getEmail();
        $password = $user->getPassword();
        
        $filePath = "../data/users.dat";
        $userInfo = $nickname . " " . $email . " " . md5($password) . "\n";
        $fp = fopen($filePath, "a+");     
        chmod($filePath, 0777);
        fwrite($fp, $userInfo);
        fclose($fp);
    }
    
    /**
     * 
     * @param string $nickname
     * @return User
     */
    public function findUserByNickname($nickname) {
        $usersArray = file('../data/users.dat');
        foreach ($usersArray as $value) {
            $userInfo = explode(" ", $value);
            if ($userInfo[0] == $nickname) {
                $user = new User();
                $user->setNickname($userInfo[0])
                    ->setEmail($userInfo[1])
                    ->setPassword(trim($userInfo[2]));
                return $user;
            }   

        }    
        return false;
    }
    
    public function findUserByEmail($email) {
        $usersArray = file('../data/users.dat');
        foreach ($usersArray as $value) {
            $userInfo = explode(" ", $value);
            if ($userInfo[1] == $email) {
                $user = new User();
                $user->setNickname($userInfo[0])
                    ->setEmail($userInfo[1])
                    ->setPassword(trim($userInfo[2]));
            }   

        }    
        return false;
    }
}