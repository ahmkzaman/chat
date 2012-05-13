<?php

/**
 * Useful functions
 */

function user_is_logged_in() 
{
    if ( !isset($_COOKIE["chatSessId"]) ) {
        return false;
    }
    
    if ( !file_exists("../data/sess/" . $_COOKIE["chatSessId"]) ) {
        return false;
    }
    
    return true;
}

function user_get_logged_in_nickname() 
{
    return file_get_contents("../data/sess/" . $_COOKIE['chatSessId']);
   
}

function  chat_add_message($message) {
    if (trim($message) != ''){
        $date = date('m/d/Y h:i:s a');
        var_dump(user_get_logged_in_nickname());
        file_put_contents("../data/messages.txt", "[" . $date . "] " . user_get_logged_in_nickname() . ": " . $_POST['message']."\r\n", FILE_APPEND);
    }
}

function chat_get_last_messages ($messagesToDisplay) {
    if ( file_exists('../data/messages.txt') ){
        $messages = file('../data/messages.txt');
        $messages = array_slice($messages, -$messagesToDisplay);

        foreach ($messages as $key => $value ){
            $messages[$key] = htmlspecialchars($value);
        }

        return implode('<br/>', $messages);
    } else {
        return "Chat is not working. Sorry.";
    }
}

function user_find_by_nickname($nickname) {
    $usersArray = file('../data/users.dat');
    foreach ($usersArray as $value) {
        $userInfo = explode(" ", $value);
        if ($userInfo[0] == $nickname) {
            return array(
                'nickname' => $userInfo[0],
                'email' => $userInfo[1],
                'password' => trim($userInfo[2]),
            );
        }   

    }    
    return false;
}

function user_find_by_email($email) {
    $usersArray = file('../data/users.dat');
    foreach ($usersArray as $value) {
        $userInfo = explode(" ", $value);
        if ($userInfo[1] == $email) {
            return array(
                'nickname' => $userInfo[0],
                'email' => $userInfo[1],
                'password' => trim($userInfo[2]),
            );
        }   

    }    
    return false;
}

function user_register($nickname, $email, $password) {
    $filePath = "../data/users.dat";
    $userInfo = $nickname . " " . $email . " " . md5($password) . "\n";
    $fp = fopen($filePath, "a+");     
    chmod($filePath, 0777);
    fwrite($fp, $userInfo);
    fclose($fp);
}

function user_login($nickname) {
    $chatSessIdValue = md5(uniqid($nickname, true));
    setcookie("chatSessId", $chatSessIdValue);
    $sessDir = "../data/sess";

    if ( !file_exists($sessDir) ) {
        mkdir($sessDir);
        chmod($sessDir, 0777);
    }
    file_put_contents($sessDir . "/" . $chatSessIdValue, $nickname);
    chmod($sessDir . "/" . $chatSessIdValue, 0777);
}
