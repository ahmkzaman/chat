<?php
$chat = new Chat;
$users = $chat->getLoggedInUsers();
include "../src/templates/logged-in-users.php";
