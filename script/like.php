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

?>
