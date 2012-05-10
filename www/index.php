<?php

require_once "../src/functions/common.php";

if ( !isset($_REQUEST['action']) || $_REQUEST['action'] == "index" ) {
    
    if ( user_is_logged_in() ) {
        echo '<!DOCTYPE html>
    <html>
        <head>
            <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
            <link rel="stylesheet" type="text/css" href="css/main.css" />
            <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css" />
            <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
            <script type="text/javascript" src="js/main.js"></script>
        </head>
        <body>
            <div id="wraper">
               <h1>Chat Local</h1>
               <div id="message_viewer">Mssage viewere</div>
               <form id="chat_form">
               <input id="message_input" type="text" value="Enter message here" />
               <input id="send_button" type="button" value="Send" />
               </form>
            <div>
        </body>
    </html>';
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
    echo "<h1>404 Not Found</h1>";
    echo "The page that you've requested could not be found.";
}

