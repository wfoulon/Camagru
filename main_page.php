<?php
session_start();
include "config/setup.php";
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Camagru</title>
        <link href="stylesheets/main_page.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="img/homelogo.png">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="site-container">
            <div class="site-pusher">
                <header class="header">
                    <img id="logo-menu" src="img/logo.png" alt="logo"/>
                        <div class="menu-buttons">
<!--                             <a href="feed.php"><img class="menu-btn" src="img/feed.png" alt="feed"/></a> -->
                            <a href="my_gallery.php"><img class="menu-btn" src="img/mygallery.png" alt="mygallery"/></a>
                            <a href="main_page.php"><img class="menu-btn" src="img/post.png" alt="post"/></a>
                            <a href="account.php"><img class="menu-btn" src="img/account.png" alt="account"/></a>
                            <a href="logout.php"><img class="menu-btn" src="img/logout.png" alt="logout"/></a>
                        </div>
                </header>
                <div class="site-content">
                    <div class="container" align="center">
                        <div class="vid">
                            <video id="video"></video>
                            <canvas id="canvas" style="display: none;"></canvas>
                        </div>
                        <div class="cam">
                            <a id="startbutton"><img src="img/cam.png" alt="camera" class="cam-logo" onClick="takepicture()"/></a>
                            <a id="deletesnap"><img src="img/erase.png" alt="delete" class="cam-logo"/></a> 
                            <a id="save"><img src="img/check.png" alt="save" class="cam-logo" onClick="removepicture()"/></a>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <footer class="footer">
                <div class="copyright">
                    Copyright © 2018 - Tous droits réservés.
                    Contact: wfoulon@student.42.fr
                </div>
            </footer>
        </div>
        <script type="text/javascript" src="js/camera.js"></script>
    </body>
</html>
