<?php
session_start();
include 'script/reset.php';
?>

<html>
    <head>
        <meta charset="utf-8" />
        <link href="stylesheets/reset_password.css" rel="stylesheet" />
        <link href="stylesheets/index.css" rel="stylesheet" />
        <link rel="icon" type="image/png" href="img/homelogo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Change email</title>
    </head>
    <body>
        <div class="page-container" align="center">
            <div class="form-content">
                <img text-align="center" src="img/locked.png" alt="logo_user" class="img_form" />
                <script language="javascript" src="js/function.js"></script>
                <div class="title" align="center">Modify email</div>
                <?php
                    echo '<center>actual email : '.$_SESSION['email'].'</center>';
                ?>
                <form align="center" class="form" method="POST" action="">
                    <div class="item">New email</div>
                        <input style="text-align:center" type="text" class="input" name="newemail" onblur="verif_email(this)" required>
                    <br />
                    <div class="item">Confirmation email</div>
                        <input style="text-align:center" type="text" class="input" name="confirmnewemail" onblur="verif_email(this)" required>
                    <br />
                    <div align="center">
                        <input type="submit" name="reset" value="Change email" class="button" />
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
