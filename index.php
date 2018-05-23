<?PHP
session_start();
/* include 'config/database.php'; */
include 'config/setup.php';
include 'script/connexion.php';
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <!-- Cette ligne définit la largeur du « viewport » pour être la même que la taille de l'écran de l'appareil utilisé pour afficher le site -->
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <title>Camagru</title>
        <!-- Mettre un logo dans la barre onglet -->
        <link rel="icon" type="image/png" href="img/homelogo.png"/>
        <!-- Charger les différentes polices  -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
        <link href="stylesheets/index.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="sign-bar">
            <img src="img/logme.png" alt="login-logo" width="90px"/>Welcome
            <form method="POST" action="" id="sign_in" autocomplete="off">
            <div>Login</div>
            <input class="input-header" type="text" name="login1" onblur="verif_login(this)" required/>
            <div>Password</div>
            <input class ="input-header" type="password" name="password1" onblur="verif_password(this)" required/>
            <input type="submit" name="connect" value ="signin" id="sign" />
            <div style="font-size:10px" style="display:inline-block"><a href="reset_password.php">Forgot your password?</a></div> 
            </form>
        </div>
        <div class="page-container" align="center">
            <div class="welcome">
                <a href="my_gallery.php"><img src="img/homelogo.png" alt="homelogo"></a>
            </div>
            <div class="form-content">
                <img text-align="center" src="img/user.png" alt="logo_user" class="img_form" />
                <script language="javascript" src="js/function.js"></script>
                <form align="center" method="POST" action="" class="form" autocomplete="off">
                    <div class="item">Login</div>
                    <input style="text-align:center" type="text" name="login" onblur="verif_login(this)" required/>
                    <div class="item">Email</div>
                    <input style="text-align:center" type="text" name="email" onblur="verif_email(this)" required/>
                    <div class="item">Password</div>
                    <input style="text-align:center" type="password" name="password" onblur="verif_password(this)" required/>
                    <div class="item">Confirm password</div>
                    <input style="text-align:center" type="password" name="confirmpassword" onblur="verif_password(this)" required/>
                    <br />
                    <br />
                    <br />
                    <input type="submit" name="inscription" value="signup" class="button" />
                </form>
            </div>
            <div class="separator">
            <?php
                if (isset($ret))
                {
                    echo $ret;
                }
            ?>
            </div>
        </div>
    </body>
</html>
