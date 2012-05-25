<?php

$auth = new Auth();
if ( ($user = $auth->getLoggedInUser()) !== false ) {
    include "../src/templates/index.php";
} else {
    header("location: index.php?action=index&controller=users");
}
