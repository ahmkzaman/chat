<?php

if ( user_is_logged_in() ) {
    include "../src/templates/index.php";
} else {
    header("location: users.php?action=login-user");
}
