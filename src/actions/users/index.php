<?php
require_once __DIR__ . '/../../class/Auth.php';
require_once __DIR__ . '/../../class/User.php';
require_once __DIR__ . '/../../class/User/Storage.php';

$userStorage = new User_Storage();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $isNicknameValid = true;
    $nicknameError = "";
    if (!isset($_POST['nickname']) || $_POST['nickname'] == "") {
        $isNicknameValid = false;
        $nicknameError = 'Nickname required';
    } else if ($userStorage->findUserByNickname($_POST['nickname']) === false) {
        $isNicknameValid = false;
        $nicknameError = "Invalid nickname";
    }

    $isPasswordValid = true;
    $passwordError = "";
    if (!isset($_POST['password']) || trim($_POST['password']) == "") {
        $isPasswordValid = false;
        $passwordError = 'Password required';
    } else {
        $user = $userStorage->findUserByNickname($_POST['nickname']);
        if ($user !== false) {
            if ($user->getPassword() != md5($_POST['password'])) {
                $isPasswordValid = false;
                $passwordError = "Incorrect password";
            }
        }
    }

    if ($isNicknameValid && $isPasswordValid) {
        $auth = new Auth();
        $user = $userStorage->findUserByNickname($_POST['nickname']);
        $auth->login($user);
        header("location: index.php");
    } else {
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];
        include "../src/templates/login-form.php";
    }
    
} else {
    $isNicknameValid = true;
    $isPasswordValid = true;
    $nickname = '';
    $password = '';
    include "../src/templates/login-form.php";
}