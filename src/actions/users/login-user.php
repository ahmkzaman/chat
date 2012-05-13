<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $isNicknameValid = true;
    $nicknameError = "";
    if (!isset($_POST['nickname']) || $_POST['nickname'] == "") {
        $isNicknameValid = false;
        $nicknameError = 'Nickname required';
    } else if (user_find_by_nickname($_POST['nickname']) === false) {
        $isNicknameValid = false;
        $nicknameError = "Invalid nickname";
    }

    $isPasswordValid = true;
    $passwordError = "";
    if (!isset($_POST['password']) || trim($_POST['password']) == "") {
        $isPasswordValid = false;
        $passwordError = 'Password required';
    } else {
        $userInfo = user_find_by_nickname($_POST['nickname']);
        if ($userInfo !== false) {
            if ($userInfo['password'] != md5($_POST['password'])) {
                $isPasswordValid = false;
                $passwordError = "Incorrect password";
            }
        }
    }

    if ($isNicknameValid && $isPasswordValid) {
        user_login($_POST['nickname']);
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