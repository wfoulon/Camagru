<?php
set_include_path('../');
include 'config/setup.php';
session_start();

if (isset($_POST['like']) && isset($_SESSION['login'])) {
    $id = $_SESSION['id'];
    $pid = htmlentities($_POST['like']);
    try {
        $req = $db->prepare('SELECT * FROM likes WHERE login = :id');
        $res = $req->execute(array('id' => $id));
        $res = $req->fetchAll();
    }
    catch (PDOexception $e)
    {
        print "ERROR! The mistake comes from: ".$e->getMessage()."";
        die();
    }
    if (count($res) !== 0) {
        try {
            $req = $db->prepare('DELETE FROM likes WHERE login = :id');
            $res = $req->execute(array('id' => $id));
        }
        catch (PDOexception $e)
        {
            print "ERROR! The mistake comes from: ".$e->getMessage()."";
            die();
        }
    }
    else {
        try {
            $req = $db->prepare('INSERT INTO likes(login, id_picture) VALUES(:uid, :pid)');
            $res = $req->execute(array('uid' => $id, 'pid' => $pid));
        }
        catch (PDOexception $e)
        {
            print "ERROR! The mistake comes from: ".$e->getMessage()."";
            die();
        }
    }
    try {
        $req = $db->prepare('SELECT * FROM likes WHERE id_picture = :id');
        $res = $req->execute(array('id' => $pid));
        $res = $req->fetchAll();
    }
    catch (PDOexception $e)
    {
        print "ERROR! The mistake comes from: ".$e->getMessage()."";
        die();
    }
    $nb = count($res);
    echo $nb;
}

if (isset($_POST['comment']) && isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $com = htmlspecialchars($_POST['comment']);
    if (strlen($com) !== 0) {
        try{
            $prep = $db->prepare('SELECT * FROM post WHERE id=:id');
            $prep->bindParam(':id', $id);
            $prep->execute();
            $req_pic = $prep->fetchAll();
        }
        catch (PDOexception $e)
        {
            print "ERROR!";
            die();
        }
        if (count($req_pic) !== 0) {
            $link = explode('/', $req_pic[0]['link'])[2];
            $date = date('Y-m-j H:i:s');
            $id_picture = $id;
            $id = $_SESSION['id'];
            try
            {
                $req = $db->prepare("INSERT INTO comments(`login`, `id_picture`, `text`, `creation_date`) VALUES(:login, :id_picture, :text, :creation_date);");
                $res = $req->execute(array('login' => $id, 'id_picture' => $id_picture, 'text' => $com, 'creation_date' => $date));
            }
            catch (PDOexception $e)
            {
                print "ERROR!";
                die();
            }
            try{
                $prep = $db->prepare('SELECT * FROM comments WHERE id_picture=:id');
                $prep->bindParam(':id', $id_picture);
                $prep->execute();
                $req_pic = $prep->fetchAll();
            }
            catch (PDOexception $e)
            {
                print "ERROR!";
                die();
            }
            $mail = $_SESSION['email'];
            $login = $_SESSION['login'];
            send_email($mail, $login, $link);
            $return['user'] = $_SESSION['login'];
            $return['com'] = $com;
            $return['nb'] = count($req_pic);
            $return = json_encode($return);
            echo $return;
        }
        else {
            echo "ERROR!";
        }
    }
    else
        echo "ERROR!";
}

function send_email($mail, $login, $link)
{
    $destinataire = $mail;
	$sujet = "Nouveau commentaire :" .$login;
	$entete = "From: Camagru@42.fr" ;
	/* Le lien d'activation est composé du login(log) et de la clé(cle) */
    $message = 'Un nouveau commentaire a été ajouté à votre photo,
    si vous souhaitez le consultez il vous suffit de cliquer sur le
    lien suivant:
			 
	http://'.$_SERVER['HTTP_HOST'].'/Camagru/likes_comments.php?picture='.$link.'
			 
			 
	---------------
	Ceci est un mail automatique, Merci de ne pas y repondre.';

	/* Envoi du mail */
	mail($destinataire, $sujet, $message);
}

?>
