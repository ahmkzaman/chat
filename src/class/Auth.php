<?php

class Auth {
    public function login(User $user) {
        $chatSessIdValue = md5(uniqid($user->getNickname(), true));
        setcookie("chatSessId", $chatSessIdValue);
        $sessDir = "../data/sess";

        if ( !file_exists($sessDir) ) {
            mkdir($sessDir);
            chmod($sessDir, 0777);
        }
        
        file_put_contents($sessDir . "/" . $chatSessIdValue, $user->getNickname());
        chmod($sessDir . "/" . $chatSessIdValue, 0777);
    }
    
    public function getLoggedInUser() {
        $sessDir = "../data/sess";
        $currentCookie = $_COOKIE['chatSessId'];
        $usersFile = $sessDir . "/" . $currentCookie;
        
        if (!isset ($currentCookie)) {
            return false;
        }
        if ( !file_exists($usersFile) ) {
            return false;
        }
        $nickname = file_get_contents($usersFile);
       
        touch($usersFile);
        
        $storage = new User_Storage();
        return $storage->findUserByNickname($nickname);
    }
    
    public function logout() {
        $sessDir = "../data/sess";
        $currentCookie = $_COOKIE['chatSessId'];
        $usersFile = $sessDir . "/" . $currentCookie;
        unlink($usersFile);
        header("location: index.php");
    }
}