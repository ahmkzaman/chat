<?php
    
$sessDir = "../data/sess";
$currentCookie = $_COOKIE['chatSessId'];
$usersFile = $sessDir . "/" . $currentCookie;
unlink($usersFile);
header("location: index.php");