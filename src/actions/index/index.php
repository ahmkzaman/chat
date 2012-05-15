<?php

if ( user_is_logged_in() ) {
    include "../src/templates/index.php";
} else {
    header("location: index.php?action=index&controller=users");
}
