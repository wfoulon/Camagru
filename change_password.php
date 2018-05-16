<?php
include 'script/reset.php'
?>

<html>
    <head>
        <meta charset="utf-8" />
        <link href=stylesheets/reset_password.css rel="stylesheet"/>
        <link href=stylesheets/index.css rel="stylesheet" />
        <link rel="icon" type="image/png" href="img/homelogo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Change Password</title>
    </head>
    <body>
        <div class="page-container" align="center">
            <div class="form-content">
                <img text-align="center" src="img/locked.png" alt="logo_user" class="img_form" />
                <script language="javascript" src="js/function.js"></script>
                <div class="title">Modify password</div>
                <form align="center" method="POST" action="" class="form">
                    <div class="item">Login</div>
                        <input style="text-align:center" type="text" name="login" class="input" onblur="verif_login(this)" required/>
                    <br>
                    <div class="item">Email</div>
                        <input style="text-align:center" type="email" name="email" class="input" onblur="verif_email(this)" required/>
                    <br>
                    <div class="item">New password</div>
                        <input style="text-align:center;" class="input" type="password" name="newpassword" onblur="verif_password(this)" required />
                    <br>
                    <div class="item">Confirmation</div>
                        <input style="text-align:center;" class="input" type="password" name="confirmnewpassword" onblur="verif_password(this)" required/>
                    <br>
                    <div align="center">
                        <input type="submit" name="button" value="Change password" class="button" />
                    </div>
                </form>
            </div>
            <div class="separator"></div>
            <a class="back" href="index.php">Back</a>
            <div class="separator"></div>
            <?php
                if (isset($ret))
                {
                    echo $ret;
                }
            ?>
        </div>
    </body>
</html>
