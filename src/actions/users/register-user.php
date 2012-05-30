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