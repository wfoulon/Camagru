<?php
session_start();
include "config/setup.php";
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>My Gallery</title>
        <link href="stylesheets/main_page.css" rel="stylesheet">
        <link href="stylesheets/my_gallery.css" rel ="stylesheet">
        <link rel="icon" type="image/png" href="img/homelogo.png">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    </head>
    <body>
        <div class="site-container">
            <div class="site-pusher">
                <header class="header">
                    <img id="logo-menu" onclick="window.location.href='index.php'" src="img/logo.png" alt="logo"/>
                        <div class="menu-buttons">
                            <a href="index.php"><img class="menu-btn" src="img/mygallery.png" alt="mygallery"/></a>
                            <?php
                            if (isset($_SESSION['login'])) { ?>
                            <a href="main_page.php"><img class="menu-btn" src="img/post.png" alt="post"/></a>
                            <a href="account.php"><img class="menu-btn" src="img/account.png" alt="account"/></a>
                            <a href="logout.php"><img class="menu-btn" src="img/logout.png" alt="logout"/></a>
                            <?php }
                            else { ?>
                                <a href="connect.php"><img class="menu-btn" src="img/account.png" alt="logout"/></a>
                            <?php }?>
                        </div>
                </header>
                <div class="site-content">
                    <?php
                        include "script/display_gallery.php";
                        if (isset($ret))
                        {
                            echo $ret;
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
