<?php

if ( !isset($_REQUEST['action']) || $_REQUEST['action'] == "index" ) {
    echo '<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
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
    
} else if ( $_REQUEST['action'] == "post-message" ) {
    if (trim($_POST['message']) != ''){
       file_put_contents("../data/messages.txt", $_POST['message']."\r\n", FILE_APPEND); 
    } 
        
} else if ( $_REQUEST['action'] == "get-messages" ){
    if ( file_exists('../data/messages.txt') ){
        $messages = file('../data/messages.txt');
        $messages = array_slice($messages, -50);
        
        foreach ($messages as $key => $value ){
            $messages[$key] = htmlspecialchars($value);
        }
        
        echo implode('<br/>', $messages);
    } else {
        echo "Chat is not working. Sorry.";
         
    }
    
    
} else {
    header('HTTP/1.1 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
}

