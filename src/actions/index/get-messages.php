<?php

if ( user_is_logged_in() ) {
    echo chat_get_last_messages(50);
} else {
    header("location: index.php?action=index&controller=users");
}