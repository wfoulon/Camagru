<?PHP
$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if ($_POST['connect'] == "sign in")
{
    if (!empty($_POST['login1']) && !empty($_POST['passsword1']))
    {
        /* Convert all applicable characters to HTML entities */
        $login1 = htmlentities($_POST['login1']);
        /* hashage du mot de passe utilisateur */
        $mdp1 = hash("whirlpool", htmlentities($_POST['password1']));
        try
        {
            /* Ajouter un utilisateur a la bdd  */
            $user_req = "SELECT * FROM users WHERE login= ? AND password= ? AND confirmation= 1";
            $user_req = $db->prepare($user_req);
            $user_req->execute(array($login1, $mdp1));
            $user_exist = $user_req->rowCount();
            /* Returns the number of rows affected by the last SQL statement */
        }
        catch (PDOexception $e)
        {
            print "ERROR: the mistake comes from: ".$e->getMessage()."";
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
        }
        else {
            $ret = "Wrong password or user not registered yet";
        }
    }
    else {
        $ret = "Please field all the inputs";
    }
}
if ($_POST['inscription'] == "sign up")
{
    if (!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmpassword']))
    {
        $login = trim(htmlentities($_POST['login']));
        $email = trim(htmlentities($_POST['email']));
        try
        {
            $check_email = $db->prepare("SELECT * FROM users WHERE email= ?");
            $check_email = execute(array($email));
            $email_exist = $check_email->rowCount();
            $check_login = $db->prepare("SELECT * FROM users WHERE login= ?");
            $check_login = execute(array($login));
            $login_exist = $check_login->rowCount();    
        }
        catch (PDOexception $e)
        {
            print "ERROR: the mistake comes from: ".$e->getMessage()."";
            die();
        }
    }
}

function send_email($mail, $login, $token)
{
    if (!preg_match("#^[a-zA-Z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
        $passage_ligne = "\r\n";
    else
        $passage_ligne = "\n";
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
	Ceci est un mail automatique, Merci de ne pas y répondre.';

	/* Envoi du mail */
	mail($destinataire, $sujet, $message);
}

?>
