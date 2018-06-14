<?php
set_include_path('../');
include 'config/setup.php';
session_start();

if (isset($_POST['deleteimg'])){
    $img = htmlspecialchars($_POST['deleteimg']);
    try
    {
        $req = $db->prepare("SELECT * FROM post WHERE id=:id AND login=:uid");
        $res = $req->execute(array('id' => $img, 'uid' => $_SESSION['id']));
        $res = $req->fetchAll();
    }
    catch (PDOexception $e)
    {
        print "ERROR! The mistake comes from: ".$e->getMessage()."";
        die();
    }
    if (count($res) !== 0)
    {
        try
        {
            $req = $db->prepare("DELETE FROM post WHERE id=:id");
            $res = $req->execute(array('id' => $img));
        }
        catch (PDOexception $e)
        {
            print "ERROR! The mistake comes from: ".$e->getMessage()."";
            die();
        }
        echo 'good';
    }
    else
        echo 'ERROR!';
}
?>
