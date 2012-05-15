<?php

require_once '../src/class/Chat.php';

if ( user_is_logged_in() ) {
    $chat = new Chat();
    echo $chat->getMessages(50);
} else {
    header("location: index.php?action=index&controller=users");
}