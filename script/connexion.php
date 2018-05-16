<?PHP
set_include_path("../");
include 'config/database.php';
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

/* Script: connection of the user on the website */
if (isset($_POST['connect']) == "signin")
{
    if (!empty($_POST['login1']) && !empty($_POST['password1']))
    {
        /* Convert all applicable characters to HTML entities */
        $login1 = htmlentities($_POST['login1']);
        /* hashage du mot de passe utilisateur */
        $mdp1 = hash("whirlpool", htmlentities($_POST['password1']));
        try
        {
            /* Ajouter un utilisateur a la bdd  */
            $user_req = "SELECT * FROM `users` WHERE `login`= ? AND password= ? AND confirmation= 1";
            $user_req = $db->prepare($user_req);
            $user_req->execute(array($login1, $mdp1));
            $user_exist = $user_req->rowCount();
            /* Returns the number of rows affected by the last SQL statement */
        }
        catch (PDOexception $e)
        {
            print "ERROR! The mistake comes from: ".$e->getMessage()."";
            die();
        }
        if ($user_exist == 1)
        {
            /* Récupère la ligne suivante d'un jeu de résultats PDO */
            $user_info = $user_req->fetch();
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['login'] = $user_info['login'];
            $_SESSION['email'] = $user_info['email'];
            $_SESSION['password'] = $mdp1;
            echo '<script language="javascript">
                document.location.href="main_page.php";
                </script>';
        }
        else {
            $ret = "Wrong password or user not registered yet";
        }
    }
    else {
        $ret = "Please field all the inputs";
    }
}
/* Script: inscription of the user on the website */
if (isset($_POST['inscription']) == "signup")
{
    if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmpassword']))
    {
        if (preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/", $_POST['login']))
        {
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['email']))
            {
                if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST['password']))
                {
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST['confirmpassword']))
                    {
                        $login = trim(htmlentities($_POST['login']));
                        $email = trim(htmlentities($_POST['email']));
                        try
                        {
                            $check_email = $db->prepare("SELECT * FROM users WHERE email = ?");
                            $check_email2 = $check_email->execute(array($email));
                            $email_exist = count($check_email->fetchAll());
                            $check_login = $db->prepare("SELECT * FROM users WHERE login = ?");
                            $check_login2 = $check_login->execute(array($login));
                            $login_exist = count($check_login->fetchAll());
                        }
                        catch (PDOexception $e)
                        {
                            print "ERROR! The mistake comes from: ".$e->getMessage()."";
                            die();
                        }
                        if ($login_exist == 0)
                        {
                            
                            if ($email_exist == 0)
                            {
                                /* hash password */
                                $mdp = hash("whirlpool", htmlentities($_POST['password']));
                                $mdp2 = hash("whirlpool", htmlentities($_POST['confirmpassword']));
                                $token = sha1(uniqid());
                                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
                                {
                                    if ($mdp == $mdp2)
                                    {
                                        try
                                        {
                                            $insert_users = $db->prepare("INSERT INTO users(login, email, password, confirmation, token) VALUES(?, ?, ?, 0, ?)");
                                            $insert_users = $insert_users->execute(array($login, $email, $mdp, $token));
                                            send_email($email, $login, $token);
                                            $ret = "Your account have been created, check your email to confirm it!";
                                        }
                                        catch (PDOexception $e)
                                        {
                                            print "ERROR! The mistake comes from: ".$e->getMessage()."";
                                            die();
                                        }
                                    }
                                    else{
                                        $ret = "Passwords doesn't match! Try again.";
                                    }
                                }
                                else{
                                    $ret = "Email format is invalid!";
                                }
                            }
                            else{
                                $ret = "This email already exist. Please choose another one.";
                            }
                        }    
                        else{
                            $ret = "This login already exist. Please choose another one.";
                        }
                    }
                    else {
                        $ret = "Password isn't valid, you must have at least eight characters, one uppercase letter, one lowercase letter and one number";
                    }
                }
                else {
                    $ret = "Password isn't valid, you must have at least eight characters, one uppercase letter, one lowercase letter and one number";
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

function send_email($mail, $login, $token)
{
    $destinataire = $mail;
	$sujet = "Activer votre compte " .$login;
	/* $entete = "From: inscription@votresite.com" ;*/
	$host = exec("hostname -f");
	/* Le lien d'activation est composé du login(log) et de la clé(cle) */
	$message = 'Bienvenue sur Camagru,
			 
	Pour activer votre compte, veuillez cliquer sur le lien ci dessous
	ou copier/coller dans votre navigateur internet.
			 
	http://'.$host.':8080/Camagru/script/validation.php?login='.$login.'&token='.$token.'
			 
			 
	---------------
	Ceci est un mail automatique, Merci de ne pas y repondre.';

	/* Envoi du mail */
	mail($destinataire, $sujet, $message);
}

?>
