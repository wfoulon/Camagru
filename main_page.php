<?php
session_start();
include "config/setup.php";
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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
                            <a href="feed.php"><img class="menu-btn" src="img/feed.png" alt="feed"/></a>
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
        <script language="javascript" src="js/camera.js"></script>
    </body>
</html>
