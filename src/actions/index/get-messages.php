<?php

$auth = new Auth();
if ($auth->getLoggedInUser() !== false) {
    $chat = new Chat();
    echo $chat->getMessages(50);
} else {
    header("location: index.php?action=index&controller=users");
}