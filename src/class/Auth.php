<?php

class Auth {    
    
    private $sessDir = "../data/sess/";
    private $sessId = 'chatSessId';
    
    public function login(User $user) {
        $chatSessIdValue = md5(uniqid($user->getNickname(), true));
        setcookie($this->sessId, $chatSessIdValue);

        if ( !file_exists($this->sessDir) ) {
            mkdir($this->sessDir);
            chmod($this->sessDir, 0777);
        }
        
        file_put_contents($this->sessDir . $chatSessIdValue, $user->getNickname());
        chmod($this->sessDir . $chatSessIdValue, 0777);
    }
    
    public function getLoggedInUser() {
        $currentCookie = $_COOKIE[$this->sessId];
        $usersFile = $this->sessDir . $currentCookie;
        
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
    
     public function getLoggedInUsers() {
        $userStorage = new User_Storage();
        $result = array();
         
        if ( ($handle = opendir($this->sessDir)) !== false ) {
            while (false !== ($entry = readdir($handle))) {
                
                if ($entry != "." && $entry != "..") {
                    $userTimeStamp = filemtime($this->sessDir . $entry);
                    $currentTimeStamp = time();
                    $userLife = 10;

                    if (($userTimeStamp + $userLife) > $currentTimeStamp) {
                        $nickname = file_get_contents($this->sessDir . $entry);
                        $user = $userStorage->findUserByNickname($nickname);
                        if ( $user !== false ) {
                            $result[] = $user;
                        }
                    } 
                }
            }
            
            closedir($handle);
        }
        return $result;  
    }
    
    public function logout() {
        $currentCookie = $_COOKIE[$this->sessId];
        $usersFile = $this->sessDir . $currentCookie;
        unlink($usersFile);
    }
}