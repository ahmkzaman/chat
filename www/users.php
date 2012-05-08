<?php

if ( !isset($_REQUEST['action']) || $_REQUEST['action'] == "login-form" ) {
        echo '<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <div id="wraper">
        <h1>Login</h1>
        <form action="users.php?action=login-user" method="POST">
            <label for="nickname">Nickname</label><br/>
            <input id="nickname" type="text" value="" name="nickname" /><br/><br/>
            <label for="password">Password</label><br/>
            <input id="password" type="password" value="" name="password" /><br/><br/>
            <input type="submit" value="Login" />
        </form>
        <div>
    </body>
</html>';
    
} else if($_REQUEST['action'] == "register-user" ) {
    
    $isNicknameValid = true;
    $nicknameError = "";
    if ( !isset($_POST['nickname']) || $_POST['nickname'] == "" ) {
        $isNicknameValid = false;
        $nicknameError = 'Nickname required'; 
        
    } else if ( preg_match('/\s/', $_POST['nickname']) ) {
        $isNicknameValid = false;
        $nicknameError = 'Invalid nickname. Nickname should contain no spaces.<br />';
        
    } else { 
        
        $usersArray = file('../data/users.dat');

        foreach ($usersArray as $value) {
            $userInfo = explode(" ", $value);
            if ($userInfo[0] == $_POST['nickname']) {
                $isNicknameValid = false;
                $nicknameError = "This username is aready taken";
                break;
            }   

        }       
    }
    
    $isEmailValid = true;
    $emailError = "";
    if ( !isset($_POST['email']) || trim($_POST['email']) == "" ) {
        $isEmailValid = false;
        $emailError = 'Email is required';
                
    } else if ( !preg_match('/^[^0-9][a-zA-Z0-9_]*([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i', $_POST['email']) ) { 
        $isEmailValid = false;
        $emailError = 'Email invalid';
    
    } else {
        $usersArray = file('../data/users.dat');

        foreach ($usersArray as $value) {
            $userInfo = explode(" ", $value);
            if ($userInfo[1] == $_POST['email']) {
                $isEmailValid = false;
                $emailError = "This e-mail is aready taken";
                break;
            } 

        }
    }
    
    $isPasswordValid = true;
    $passwordError = "";
    if ( !isset($_POST['password']) || trim($_POST['password']) == "" ) {
        $isPasswordValid = false;
        $passwordError = 'Password is required';
        
    } else if ( strlen($_POST['password']) < 8 ) { 
        $isPasswordValid = false;
        $passwordError = 'Password must contain 8 or more symbols'; 
    }
    
    $isConfPassValid = true;
    $confPassError = "";
    if ( !isset($_POST['confirm-password']) || trim($_POST['confirm-password']) == "" ) {
        $isConfPassValid = false;
        $confPassError = "Retype your password";
        
        
    } else if ( $_POST['confirm-password'] != $_POST['password'] ) { 
        $isConfPassValid = false;
        $confPassError = "Passwords don't match";
    }
    
    if ($isConfPassValid && $isEmailValid && $isNicknameValid && $isPasswordValid) {
        $filePath = "../data/users.dat";
        $userInfo = $_POST['nickname'] . " " . $_POST['email'] . " " . md5($_POST['password']) . "\n";
        $fp = fopen($filePath, "a+");     
        chmod($filePath, 0777);
        fwrite($fp, $userInfo);
        fclose($fp);
        
        // 2. Send email with confirmation link
        
        header("location: index.php");
    } else {
        

        echo '<!DOCTYPE html>
    <html>
        <head>
            <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
            <link rel="stylesheet" type="text/css" href="css/main.css" />
            <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
            <script type="text/javascript" src="js/main.js"></script>
        </head>
        <body>
            <div id="wraper">
            <h1>Registration form</h1>
            <form action="users.php?action=register-user" method="POST">';

        if ( $isNicknameValid ) {
            echo '<label for="nickname">Nickname</label><br/>
                <input id="nickname" type="text" value="' . htmlspecialchars($_POST['nickname']) . '" name="nickname" /><br/><br/>';
        } else {
            echo '<label for="nickname" class="error">Nickname</label><br/>
                <input id="nickname" type="text" value="' . htmlspecialchars($_POST['nickname']) . '" name="nickname" class="error" /><span class="error">' . $nicknameError . '</span><br/><br/>';
        }


        if ( $isEmailValid ) {
            echo '<label for="email">E-Mail</label><br/>
                <input id="email" type="text" value="' . htmlspecialchars($_POST['email']) . '" name="email" /><br/><br/>';
        }  else {
            echo '<label for="email" class="error">E-Mail</label><br/>
                <input id="email" type="text" value="' . htmlspecialchars($_POST['email']) . '" name="email" class="error" /><span class="error">' . $emailError . '</span><br/><br/>';
        }

        if ($isPasswordValid) {
            echo '<label for="password">Password</label><br/>
                <input id="password" type="password" value="' . htmlspecialchars($_POST['password']) . '" name="password" /><br/><br/>';
        } else {
            echo '<label for="password" class="error">Password</label><br/>
                <input id="password" type="password" value="' . htmlspecialchars($_POST['password']) . '" name="password" class="error" /><span class="error">' . $passwordError . '</span><br/><br/>';
        }

        if ($isConfPassValid) {
            echo '<label for="confirm-password" >Retype password</label><br/>
                <input id="confirm-password" type="password" value="' . htmlspecialchars($_POST['confirm-password']) . '" name="confirm-password" /><br/><br/>';
        } else {
            echo '<label for="confirm-password" class="error">Retype password</label><br/>
                <input id="confirm-password" type="password" value="' . htmlspecialchars($_POST['confirm-password']) . '" name="confirm-password" class="error" /><span class="error">' . $confPassError . '</span><br/><br/>';
        }

        echo '<input type="submit" value="Register" />
            </form>
            <div>
        </body>
    </html>';


    }    
    
} else if ( $_REQUEST['action'] == "confirm-registration" ) {
    echo 'Confirm registration';
    
} else if ( $_REQUEST['action'] == "registration-form" ) {    
    echo '<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
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
    
} else if ( $_REQUEST['action'] == "login-user" ) {
    $isNicknameValid = true;
    $nicknameError = "";
    $isPasswordValid = true;
    $passwordError = "";
    
    if ( !isset($_POST['nickname']) || $_POST['nickname'] == "" ) {
        $isNicknameValid = false;
        $nicknameError = 'Nickname required'; 
    } else {
        
        $usersArray = file('../data/users.dat');

        $userExists = false;
        foreach ($usersArray as $value) {
            $userInfo = explode(" ", $value);
            if ($userInfo[0] == $_POST['nickname']) {
                $userExists = true;
                break;
            }
        }
        
        if ( !$userExists ) {
            $isNicknameValid = false;
            $nicknameError = "Invalid nickname";
        }
    
    }
    
    if ( !isset($_POST['password']) || trim($_POST['password']) == "" ) {
        $isPasswordValid = false;
        $passwordError = 'Password is required';
    } else {
        $usersArray = file('../data/users.dat');
        
        $passwordMatch = false;
        foreach ($usersArray as $value) {
            $userInfo = explode(" ", $value);
            if ($userInfo[0] == $_POST['nickname']) {
                if (trim($userInfo[2]) == md5($_POST['password'])) {
                    $passwordMatch = true;
                    break;
                }
            }
        }
        
        if ( !$passwordMatch ) {
            $isPasswordValid = false;
            $passwordError = "Incorrect password";
        }
    }
    
    if ($isNicknameValid && $isPasswordValid) {
        echo'Logging in';
    } else {
        echo '<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="content-type" />
        <link rel="stylesheet" type="text/css" href="css/main.css" />
        <script type="text/javascript" src="js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <div id="wraper">
        <h1>Login</h1>
        <form action="users.php?action=login-user" method="POST">';
            
            if ( $isNicknameValid ) {
                echo '<label for="nickname">Nickname</label><br/>
                    <input id="nickname" type="text" value="' . htmlspecialchars($_POST['nickname']) . '" name="nickname" /><br/><br/>';
            } else {
                echo '<label for="nickname" class="error">Nickname</label><br/>
                    <input id="nickname" type="text" value="' . htmlspecialchars($_POST['nickname']) . '" name="nickname" class="error" /><span class="error">' . $nicknameError . '</span><br/><br/>';
            }
            
            if ($isPasswordValid) {
                echo '<label for="password">Password</label><br/>
                <input id="password" type="password" value="' . htmlspecialchars($_POST['password']) . '" name="password" /><br/><br/>';
            } else {
                echo '<label for="password" class="error">Password</label><br/>
                <input id="password" type="password" value="' . htmlspecialchars($_POST['password']) . '" name="password" class="error" /><span class="error">' . $passwordError . '</span><br/><br/>';
            }
            
            echo '<input type="submit" value="Login" />
        </form>
        <div>
    </body>
</html>';
    }
} else if ( $_REQUEST['action'] == "forgot-password-form" ) {
    echo 'Forgot password';
    
}  else if ( $_REQUEST['action'] == "reset-password-form" ) {
    echo 'Reset password form';
    
} else if ( $_REQUEST['action'] == "reset-password" ) {
    echo 'Reset password';
    
} else {
    header('HTTP/1.1 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    
}