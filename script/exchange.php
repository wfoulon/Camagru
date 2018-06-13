<?php
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if (!isset($_GET['picture']))
{
    header("Location: my_gallery.php");
}
else{
    $link = htmlentities($_GET['picture']);
    $link = "pictures/".$link."";
}
$bdd_link = "../$link";
try{
    $prep = $db->prepare('SELECT * FROM post WHERE link=:link');
    $prep->bindParam(':link', $bdd_link);
    $prep->execute();
    $req_pic = $prep->fetchAll();
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
try {
    $req = $db->prepare('SELECT * FROM likes WHERE id_picture = :id');
    $res = $req->execute(array('id' => $req_pic[0]['id']));
    $res = $req->fetchAll();
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
$nb = count($res);
try {
    $req = $db->prepare('SELECT * FROM comments WHERE id_picture = :id');
    $res = $req->execute(array('id' => $req_pic[0]['id']));
    $res = $req->fetchAll();
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
$nbcom = count($res);
echo '<div class="pic"><img src="'.$link.'"/></div>';
echo '<div class="icn">';
echo    '<div class="num"><i class="test1 fas fa-comments fa-2x"></i>'.$nbcom.'</div>';
if (isset($_SESSION['login']))
    echo    '<div class="num"><i value="'.$req_pic[0]['id'].'" id="like" class="test fas fa-heart fa-2x"></i><span id="likeSpan">'.$nb.'</span></div>';
else
    echo    '<div class="num"><i class="test fas fa-heart fa-2x"></i>'.$nb.'</div>';
echo '</div>';
echo '<div class="form-content">';
echo    '<form class="comments" method="POST" action="" autocomplete="off">';
echo    '<textarea name="com" placeholder="Write your comment"></textarea>';
echo    '<input type="submit" name="comment" value="SEND" class="button" style="margin-top:10px"></input>'; 
echo    '</form>';
echo '</div>';

if (isset($_POST['comment']) == "SEND")
{
    if (!empty($_POST['com']))
    {
        if (preg_match("/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/",$_POST['com']))
        {
            $comment = htmlentities($_POST['com']);
            try
            {
                $req = $db->prepare("INSERT INTO comments");
            }
            catch (PDOexception $e)
            {
                print "ERROR! The mistake comes from: ".$e->getMessage()."";
                die();
            }
        }
        else{
            $ret = "Injections are not allowed";
        }
    }
    else{
        $ret = "Please write a comment! At least one word!";
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
