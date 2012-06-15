<?php

class IndexController extends Drozd_Controller
{
    public function indexAction()
    {
        $auth = new Auth();
        if ( ($user = $auth->getLoggedInUser()) !== false ) {
            include "../src/templates/index.php";
        } else {
            header("location: index.php?action=index&controller=users");
        }
    }
    
    public function postMessageAction()
    {
        $auth = new Auth();
        if ( ($user = $auth->getLoggedInUser()) !== false ) {
            $chat = new Chat();
            $chat->addMessage($_POST['message'], $user);
        } else {
            header("location: index.php?action=index&controller=users");
        }
    }
        
    public function getMessagesAction()
    {
        $auth = new Auth();
        if ($auth->getLoggedInUser() !== false) {
            $chat = new Chat();
            echo $chat->getMessages(50);
        } else {
            header("location: index.php?action=index&controller=users");
        }
    }
}