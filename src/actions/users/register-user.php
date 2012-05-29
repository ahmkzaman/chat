<?php

$form = new RegistrationForm($_POST);

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( $form->isValid() ) {
        $user = new User();
        $user->setNickname($_POST['nickname'])
            ->setEmail($_POST['email'])
            ->setPassword($_POST['password']);
        $userStorage = new User_Storage();
        $userStorage->addUser($user);
        
        header("location: index.php");
    } else {
        include "../src/templates/registration-form.php";
    }
    
} else {
    include "../src/templates/registration-form.php";
}

return;

$userStorage = new User_Storage();
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    


    $isEmailValid = true;
    $emailError = "";
    if (!isset($_POST['email']) || trim($_POST['email']) == "") {
        $isEmailValid = false;
        $emailError = 'Email required';
    } else if (!preg_match('/^[^0-9][a-zA-Z0-9_]*([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i', $_POST['email'])) {
        $isEmailValid = false;
        $emailError = 'Email invalid';
    } else if ($userStorage->findUserByEmail ($_POST['email']) !== false) {
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
        $user = new User();
        $user->setNickname($_POST['nickname'])
            ->setEmail($_POST['email'])
            ->setPassword($_POST['password']);
        $userStorage->addUser($user);
        // 2. Send email with confirmation link

        header("location: index.php");
    } else {
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $confirmPassword = $_POST['confirm-password'];
        include "../src/templates/registration-form.php";
    }
    
} else {
    $isNicknameValid = true;
    $isPasswordValid = true;
    $isEmailValid = true;
    $isConfPassValid = true;
    $nickname = '';
    $password = '';
    $email = '';
    $confirmPassword = '';

    include "../src/templates/registration-form.php";
}