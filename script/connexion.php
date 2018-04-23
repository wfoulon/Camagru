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
        catch (PDOexeption $e)
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

    }
}

function send_email($mail, $login, $token)
{
    
}
?>
