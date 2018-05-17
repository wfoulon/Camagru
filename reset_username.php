<?php
session_start();
include "script/reset.php";
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link href="stylesheets/index.css" rel="stylesheet"/>
        <link href=stylesheets/reset_password.css rel="stylesheet"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <link rel="icon" type="image/png" href="img/homelogo.png" />
        <title>Change username</title>
    </head>
    <body>
        <div class="page-container" align="center">
            <div class="form-content">
                <img text-align="center" src="img/locked.png" alt="logo_user" class="img_form" />
                <script language="javascript" src="js/function.js"></script>
                    <div class="title">Change username</div>
                    <?php
                        echo '<center>actual username : '.$_SESSION['login'].'</center>';
                    ?>
                <form align="center" method="POST" action="" class="form">
                    <div class="item">New login</div>
                        <input style="text-align:center" type="text" class="input" name="newlogin" onblur="verif_login(this)" required>
                    <br />
                    <div class="item">Confirmation login</div>
                        <input style="text-align:center" type="text" class="input" name="confirmnewlogin" onblur="verif_login(this)" required>
                    <br />
                    <div align="center">
                        <input type="submit" name="button" value="Change login" class="button" />
                    </div>
                </form>
            </div>
            <div class="separator"></div>
            <a class="back" href="account.php">Back</a>
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
