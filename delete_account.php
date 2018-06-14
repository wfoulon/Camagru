<?php
session_start();
include 'config/setup.php';
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
                    <div class="title">Delete your account</div>
                <form align="center" method="POST" action="" class="form" autocomplete="off">
                    <div class="item">Password</div>
                        <input style="text-align:center" type="password" class="input" name="delpsd">
                    <br />
                    <div align="center">
                        <input type="submit" name="delete" value="delete account" class="button" />
                    </div>
                </form>
            </div>
            <div class="separator"></div>
            <a class="back" href="account.php">Back</a>
            <div class="separator"></div>
        </div>
    </body>
</html>
<?php
if (isset($_POST['delete']) == "delete account" && isset($_POST['delpsd']))
{
    $delete = htmlspecialchars($_POST['delpsd']);
    $delete = hash('whirlpool', $delete);
    try{
        $req = $db->prepare("SELECT * FROM users WHERE password = :psd AND id = :id");
        $res = $req->execute(array('psd' => $delete, 'id' => $_SESSION['id']));
        $res = $req->fetchAll();
    }
    catch (PDOexception $e)
    {
        print "ERROR! The mistake comes from: ".$e->getMessage()."";
        die();
    }
    if (count($res) !== 0)
    {
        try{
            $req = $db->query("DELETE FROM users WHERE id= '".$_SESSION['id']."';");
            $req = $db->query("DELETE FROM post WHERE login= '".$_SESSION['id']."';");
            $req = $db->query("DELETE FROM comments WHERE login= '".$_SESSION['id']."';");
            $req = $db->query("DELETE FROM likes WHERE login= '".$_SESSION['id']."';");
        }
        catch (PDOexception $e)
        {
            print "ERROR! The mistake comes from: ".$e->getMessage()."";
            die();
        }
        session_destroy();
        header("Location: index.php");
    }
}
?>
