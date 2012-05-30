<?php

$form = new LoginForm($_POST);

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if ( $form->isValid() ) {
        $userStorage = new User_Storage();
        $user = $userStorage->findUserByNickname($_POST['nickname']);
        $auth = new Auth();
        $auth->login($user);
        header("location: index.php");
    } else {
        include "../src/templates/login-form.php";
    }
    
} else {
    include "../src/templates/login-form.php";
}
