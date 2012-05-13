<?php

require_once "../src/functions/common.php";

if ( !isset($_REQUEST['action']) || $_REQUEST['action'] == "index" ) {
    include "../src/actions/index/index.php";
   
} else if ( $_REQUEST['action'] == "post-message" ) {
    include "../src/actions/index/post-message.php";
        
} else if ( $_REQUEST['action'] == "get-messages" ){
    include "../src/actions/index/get-messages.php";
  
} else {
    include "../src/actions/error/404.php";
}
