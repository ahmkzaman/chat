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
        <form action="index.php?action=register-user&controller=users" method="POST">

        <?php if ( $isNicknameValid ): ?>
            <label for="nickname">Nickname</label><br/>
            <input id="nickname" type="text" value="<?php echo htmlspecialchars($nickname) ?>" name="nickname" /><br/><br/>
        <?php else: ?>
            <label for="nickname" class="error">Nickname</label><br/>
            <input id="nickname" type="text" value="<?php echo htmlspecialchars($nickname) ?>" name="nickname" class="error" /><span class="error"><?php echo $nicknameError ?></span><br/><br/>
        <?php endif; ?>
            
        <?php if ($isEmailValid ) :?>
                <label for="email">E-Mail</label><br/>
                <input id="email" type="text" value="<?php echo  htmlspecialchars($email) ?>" name="email" /><br/><br/>
        <?php else: ?>
                <label for="email" class="error">E-Mail</label><br/>
                <input id="email" type="text" value="<?php echo  htmlspecialchars($email) ?> " name="email" class="error" /><span class="error"><?php echo $emailError ?></span><br/><br/>
        <?php endif  ?>

        <?php if ($isPasswordValid): ?>
                <label for="password">Password</label><br/>
                <input id="password" type="password" value="<?php echo  htmlspecialchars($password) ?>" name="password" /><br/><br/>
        <?php else: ?>
                <label for="password" class="error">Password</label><br/>
                <input id="password" type="password" value="<?php echo  htmlspecialchars($password) ?>" name="password" class="error" /><span class="error"><?php echo $passwordError ?></span><br/><br/>
        <?php endif ?>

        <?php if ($isConfPassValid): ?>
                <label for="confirm-password" >Retype password</label><br/>
                <input id="confirm-password" type="password" value="<?php echo htmlspecialchars($confirmPassword) ?>" name="confirm-password" /><br/><br/>
        <?php else: ?>
                <label for="confirm-password" class="error">Retype password</label><br/>
                <input id="confirm-password" type="password" value="<?php echo htmlspecialchars($confirmPassword) ?>" name="confirm-password" class="error" /><span class="error"><?php echo $confPassError ?></span><br/><br/>
        <?php endif ?>

            <input type="submit" value="Register" />
        </form>
        <div>
    </body>
</html>
