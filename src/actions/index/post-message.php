<?php

$auth = new Auth();
if ( ($user = $auth->getLoggedInUser()) !== false ) {
    $chat = new Chat();
    $chat->addMessage($_POST['message'], $user);
} else {
    header("location: index.php?action=index&controller=users");
}