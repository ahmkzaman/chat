<?php

class Chat {

    private $storage = "../data/messages.txt";

    public function addMessage($message, User $user) {
        if (trim($message) != '') {
            $date = date('m/d/Y h:i:s a');
            file_put_contents($this->storage, "[" . $date . "] " . $user->getNickname() . ": " . $message . "\r\n", FILE_APPEND);
        }
    }

    public function getMessages($messagesToDisplay) {
        $messages = file($this->storage);
        $messages = array_slice($messages, -$messagesToDisplay);

        foreach ($messages as $key => $value) {
            $messages[$key] = htmlspecialchars($value);
        }

        return implode('<br/>', $messages);
    }
    
    public function getLoggedInUsers() {
        $userStorage = new User_Storage();
        $result = array();
         
        if ( ($handle = opendir('../data/sess')) !== false ) {
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                
                if ($entry != "." && $entry != "..") {
                    $date = new DateTime();
                    $userTimeStamp = filemtime("../data/sess/". $entry);
                    $currentTimeStamp = $date->getTimestamp();
                    $userLife = 10;

                    if (($userTimeStamp + $userLife) > $currentTimeStamp) {
                        $nickname = file_get_contents("../data/sess/". $entry);
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
    
}