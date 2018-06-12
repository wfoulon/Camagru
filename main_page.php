<?php
include "config/setup.php";
include "script/security.php";
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
                            <a href="my_gallery.php"><img class="menu-btn" src="img/mygallery.png" alt="mygallery"/></a>
                            <a href="main_page.php"><img class="menu-btn" src="img/post.png" alt="post"/></a>
                            <a href="account.php"><img class="menu-btn" src="img/account.png" alt="account"/></a>
                            <a href="logout.php"><img class="menu-btn" src="img/logout.png" alt="logout"/></a>
                        </div>
                </header>
                <div class="site-content">
                    <div class="container" align="center">
                        <div class="vid">
                        <!-- Drag and drop upload file -->
                        <div class="Content" id="drop_zone" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
                            <div class="Content">
                                <video id="video"></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                                <div class="MaskContent">
                                    <div class="VideoMask" style="display: none; left: 45%;">
                                        <img src="contents/16.png" />
                                    </div>
                                    <div class="VideoMask" style="display: none;bottom: 2px;left: 45%;">
                                        <img src="contents/2.png" />
                                    </div>
                                    <div class="VideoMask" style="display: none;left: 45%; bottom: 35%;">
                                        <img src="contents/14.png" />
                                    </div>
                                    <div class="VideoMask" style="display: none">
                                        <img src="contents/20.png" />
                                    </div>
                                    <div class="VideoMask" style="display: none; right:0; bottom:0;">
                                        <img src="contents/21.png" />
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div id='save-all' class="cam">
                            <br />
                            <input id="namePic" style="width: 60%" placeholder="Name for the pic"></input>
                            <br />
                            <a id="startbutton"><img src="img/cam.png" alt="camera" class="cam-logo" onClick="takepicture()"/></a>
                            <a id="deletesnap"><img src="img/erase.png" alt="delete" class="cam-logo"/></a> 
                            <a><img id="save" style="cursor: not-allowed;" src="img/check.png" alt="save" class="cam-logo" onClick="savepicture()"/></a>
                        </div>
                        <div id="collage-content" class="collage-content">
                            <div class="collage-items">
                                <div class="mask"><img src="contents/16.png"></div>
                            </div>
                            <div class="collage-items">
                                <div class="mask"><img src="contents/2.png"></div>
                            </div>
                            <div class="collage-items">
                                <div class="mask"><img src="contents/14.png"></div>
                            </div>
                            <div class="collage-items">
                                <div class="mask"><img src="contents/20.png"></div>
                            </div>    
                            <div class="collage-items">
                                <div class="mask"><img src="contents/21.png"></div>
                            </div>
                        </div>                  
                    </div>
                    <div class="flex-box">
                        <?php
                            include "script/display_miniature.php";
                            if (isset($ret))
                            {
                                echo $ret;
                            }
                        ?>
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
        <script type="text/javascript" src="js/function.js"></script>
    </body>
</html>
