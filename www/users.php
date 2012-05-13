<?php

require_once "../src/functions/common.php";

if (!isset($_REQUEST['action']) || $_REQUEST['action'] == "login-user") {
    
    include "../src/actions/users/login-user.php";
   
} else if ($_REQUEST['action'] == "register-user") {

    $isNicknameValid = true;
    $nicknameError = "";
    if (!isset($_POST['nickname']) || $_POST['nickname'] == "") {
        $isNicknameValid = false;
        $nicknameError = 'Nickname required';
    } else if (preg_match('/\s/', $_POST['nickname'])) {
        $isNicknameValid = false;
        $nicknameError = 'Invalid nickname. Nickname should contain no spaces.<br />';
    } else if (user_find_by_nickname($_POST['nickname']) !== false) {
        $isNicknameValid = false;
        $nicknameError = "This username is aready taken";
    }

    $isEmailValid = true;
    $emailError = "";
    if (!isset($_POST['email']) || trim($_POST['email']) == "") {
        $isEmailValid = false;
        $emailError = 'Email required';
    } else if (!preg_match('/^[^0-9][a-zA-Z0-9_]*([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i', $_POST['email'])) {
        $isEmailValid = false;
        $emailError = 'Email invalid';
    } else if (user_find_by_email($_POST['email']) !== false) {
        $isEmailValid = false;
        $emailError = "This e-mail is aready taken";
    }

    $isPasswordValid = true;
    $passwordError = "";
    if (!isset($_POST['password']) || trim($_POST['password']) == "") {
        $isPasswordValid = false;
        $passwordError = 'Password required';
    } else if (strlen($_POST['password']) < 8) {
        $isPasswordValid = false;
        $passwordError = 'Password must contain 8 or more symbols';
    }

    $isConfPassValid = true;
    $confPassError = "";
    if (!isset($_POST['confirm-password']) || trim($_POST['confirm-password']) == "") {
        $isConfPassValid = false;
        $confPassError = "Retype your password";
    } else if ($_POST['confirm-password'] != $_POST['password']) {
        $isConfPassValid = false;
        $confPassError = "Passwords don't match";
    }

    if ($isConfPassValid && $isEmailValid && $isNicknameValid && $isPasswordValid) {
        user_register($_POST['nickname'], $_POST['email'], $_POST['password']);
        // 2. Send email with confirmation link

        header("location: index.php");
    } else {

        include "../src/templates/registration-form.php";
    }

} else if ($_REQUEST['action'] == "registration-form") {
    echo '<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
         <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.css" />
        <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
    </head>
    <body>
        <div id="wraper">
        <h1>Registration form</h1>
        <form action="users.php?action=register-user" method="POST">
            <label for="nickname">Nickname</label><br/>
            <input id="nickname" type="text" value="" name="nickname" /><br/><br/>
            <label for="email">E-Mail</label><br/>
            <input id="email" type="text" value="" name="email" /><br/><br/>
            <label for="password">Password</label><br/>
            <input id="password" type="password" value="" name="password" /><br/><br/>
            <label for="confirm-password">Retype password</label><br/>
            <input id="confirm-password" type="password" value="" name="confirm-password" /><br/><br/>
           <input type="submit" value="Register" />
        </form>
        <div>
    </body>
</html>';

} else if ($_REQUEST['action'] == "logout-user") {
    include "../src/actions/users/logout-user.php";
    
} else {
    include "../src/actions/error/404.php";
}