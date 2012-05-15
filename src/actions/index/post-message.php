<?php

if ( user_is_logged_in() ) {
    chat_add_message($_POST['message']);
} else {
    header("location: index.php?action=index&controller=users");
}