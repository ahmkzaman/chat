<?php

require_once "../src/functions/common.php";

if ( !isset($_REQUEST['action']) || $_REQUEST['action'] == "index" ) {
    if ( user_is_logged_in() ) {
        include "../src/templates/index.php";
    } else {
        header("location: users.php?action=login-form");
    }
   
} else if ( $_REQUEST['action'] == "post-message" ) {
    
    if ( user_is_logged_in() ) {
        chat_add_message($_POST['message']);
    } else {
        header("location: users.php?action=login-form");
    }
        
} else if ( $_REQUEST['action'] == "get-messages" ){
    
    if ( user_is_logged_in() ) {
        echo chat_get_last_messages(50);
    } else {
        header("location: users.php?action=login-form");
    }
    
} else {
    header('HTTP/1.1 404 Not Found');
     include "../src/templates/page404.php";
}
