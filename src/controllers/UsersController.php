<?php

class UsersController extends Drozd_Controller
{
    public function indexAction()
    {
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
    }
    
    public function loggedInUsersAction()
    {
        $auth = new Auth();
        if ($auth->getLoggedInUser() !== false) {
            $users = $auth->getLoggedInUsers();
            include "../src/templates/logged-in-users.php";
        } else {
            header("location: index.php?action=index&controller=users");
        }
    }
    
    public function logoutUserAction()
    {
        $auth= new Auth();
        $auth->logout();
        header("location: index.php");
    }
    
    public function registerUserAction()
    {
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
    }
}
