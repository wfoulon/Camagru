<?php
session_start();
set_include_path("../");
include 'config/database.php';

if (isset($_POST['button']) == "Send mail")
{
    $db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (!empty($_POST['login']) && !empty($_POST['email']))
    {
        if (preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/", $_POST['login']))
        {
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['email']))
            {
                $login = trim(htmlentities($_POST['login']));
                $email = trim(htmlentities($_POST['email']));
                try
                {
                    $user_req = $db->prepare("SELECT * FROM users WHERE login = ?");
                    $user_req->execute(array($login));
                    $user_info = $user_req->fetch();
                    $user_exist = $user_req->rowCount();
                }
                catch (PDOexception $e)
                {
                print "ERROR! The mistake comes from: ".$e->getMessage()."";
                die();
                }
                if ($user_exist == 1)
                {
                    if ($email == $user_info['email'])
                    {
                        send_email($email, $login);
                        $_SESSION['login'] = $login;
                        $ret = "An email has just been sent to reset your password.";
                    }
                    else{
                        $ret = "Email address doesn't match.";
                    }
                }
                else{
                    $ret = "This login doesn't exist.";
                }
            }
            else {
                $ret = "This email format isn't valid.";
            }
        }
        else {
            $ret = "This login isn't valid. Please try again.";
        }
    }
    else {
        $ret = "Please field all the inputs.";
    }
}

if (isset($_POST['button']) == "Change password")
{
    $db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['newpassword']) && !empty($_POST['confirmnewpassword']))
    {
        if (preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/", $_POST['login']))
        {
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['email']))
            {
                if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST['newpassword']))
                {
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST['confirmnewpassword']))
                    {
                        $login = htmlentities($_POST['login']);
                        $email = htmlentities($_POST['email']);
                        $newpsd = hash("whirlpool", htmlentities($_POST['newpassword']));
                        $confnewpsd = hash("whirlpool", htmlentities($_POST['confirmnewpassword']));
                        try
                        {
                            $user_req = $db->prepare("SELECT * FROM users WHERE login = ? AND email = ?");
                            $user_req->execute(array($login, $email));
                            $user_info = count($user_req->fetchAll());
                        }
                        catch (PDOexception $e)
                        {
                            print "ERROR! The mistake comes from: ".$e->getMessage()."";
                            die();
                        }
                        if ($user_info)
                        {
                            if ($newpsd == $confnewpsd)
                            {
                                try
                                {
                                    $change_psd = $db->prepare("UPDATE users SET password = ? WHERE login = ?");
                                    $change_psd->execute(array($confnewpsd, $login));
                                    $ret = "Password has been updated successfully";
                                }
                                catch (PDOexception $e)
                                {
                                    print "ERROR! the mistake comes from: ".$e->getMessage()."";
                                    die();
                                }
                            }
                            else{
                                $ret = "Passwords doesn't match. Please try again";
                            }
                        }
                        else {
                            $ret = "Incorrect login or email";
                        }
                    }
                    else{
                        $ret = "Password isn't valid, you must have at least eight characters, one uppercase letter, one lowercase letter and one number";
                    }
                }
                else{
                    $ret = "Password isn't valid, you must have at least eight characters, one uppercase letter, one lowercase letter and one number";
                }
            }
            else{
                $ret = "This email format isn't valid.";
            }
        }
        else{
            $ret = "This login isn't valid. Please try again.";
        }
    }
    else{
        $ret = "Please field all the inputs.";
    }
}

/* Change email user */
if (isset($_POST['reset']) == "Change email")
{
    $db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if (!empty($_POST['newemail']) && !empty($_POST['confirmnewemail']))
    {
        /* Check if the email format is valid */
        if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['newemail']))
        {
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['confirmnewemail']))
            {
                $newemail = htmlentities($_POST['newemail']);
                $confirmnewemail = htmlentities($_POST['confirmnewemail']);
                try
                {
                    $user_req = $db->prepare("SELECT * FROM users WHERE id = ?");
                    $user_req->execute(array($_SESSION['id']));
                    $user_info = $user_req->fetch();
                }
                catch (PDOexception $e)
                {
                    print "ERROR! the mistake comes from: ".$e->getMessage()."";
                    die();
                }
                /* Check if the email match */
                if ($newemail = $confirmnewemail)
                {
                    try
                    {
                        $check_email = $db->prepare("SELECT * FROM users WHERE id =?");
                        $check_email->execute(array($confirmnewemail));
                        $email_info = $check_email->rowCount();
                    }
                    catch (PDOexception $e)
                    {
                        print "ERROR! the mistake comes from: ".$e->getMessage()."";
                        die();
                    }
                    /* Check if the email already exist */
                    if (!$email_info)
                    {
                        try
                        {
                            $insert_email = $db->prepare("UPDATE users SET email = ? WHERE id = ?");
                            $insert_email->execute(array($confirmnewemail, $_SESSION['id']));
                        }
                        catch (PDOexception $e)
                        {
                            print "ERROR! the mistake comes from: ".$e->getMessage()."";
                            die();
                        }
                        $_SESSION['email'] = $confirmnewemail;
                        header("Location : reset_email.php");
                    }
                    else {
                        $ret = "This email already exist";
                    }
                }
                else {
                    $ret = "Email doesn't match";
                }
            }
            else {
                $ret = "This email format isn't valid.";
            }
        }
        else {
            $ret = "This email format isn't valid.";
        }
    }
    else {
        $ret = "Please field all the inputs.";
    }
}

function send_email($mail, $login)
{
    $destinataire = $mail;
	$sujet = "Modification du mot de passe Camagru " .$login;
	/* $entete = "From: inscription@votresite.com" ;*/
	$host = exec("hostname -f");
	/* Le lien d'activation est composé du login(log) et de la clé(cle) */
	$message = 'Vous venez de demander la reinitialisation de votre mot de passe.
    Pour changer votre mot de passe cliquez sur le lien ci-dessous.
			 
	http://'.$host.':8080/Camagru/change_password.php?login='.$login.'
			 
			 
	---------------
	Ceci est un mail automatique, Merci de ne pas y repondre.';

	/* Envoi du mail */
	mail($destinataire, $sujet, $message);
}

?>
