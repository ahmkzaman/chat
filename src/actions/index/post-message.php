<?php

if ( user_is_logged_in() ) {
    chat_add_message($_POST['message']);
} else {
    header("location: users.php?action=login-user");
}