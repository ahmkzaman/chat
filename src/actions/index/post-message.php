<?php
require_once '../src/class/Auth.php';
require_once '../src/class/Chat.php';
require_once '../src/class/User.php';

$auth = new Auth();
if ( ($user = $auth->getLoggedInUser()) !== false ) {
    $chat = new Chat();
    $chat->addMessage($_POST['message'], $user);
} else {
    header("location: index.php?action=index&controller=users");
}