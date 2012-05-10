<!DOCTYPE html>
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

        <?php if ( $isNicknameValid ): ?>
            <label for="nickname">Nickname</label><br/>
            <input id="nickname" type="text" value="<?php echo htmlspecialchars($_POST['nickname']) ?>" name="nickname" /><br/><br/>
        <?php else: ?>
            <label for="nickname" class="error">Nickname</label><br/>
            <input id="nickname" type="text" value="<?php echo htmlspecialchars($_POST['nickname']) ?>" name="nickname" class="error" /><span class="error"><?php echo $nicknameError ?></span><br/><br/>
        <?php endif; ?>


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
</html>'
