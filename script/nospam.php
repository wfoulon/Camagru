<?php
set_include_path('../');
include 'config/setup.php';
session_start();

if (isset($_POST['spam']))
{
    if ($_POST['spam'] === 0)
        $spam = '0';
    else
        $spam = '1';
    $spam = htmlspecialchars($_POST['spam']);
    echo $spam;
    try
    {
        $req = $db->prepare("UPDATE users SET notif = :noti WHERE id=:id");
        $res = $req->execute(array('noti' => $spam, 'id' => $_SESSION['id']));
        $_SESSION['notif'] = $spam;
    }
    catch(PDOException $e){
        die('Error: '.$e);
    }
    echo 'ok';
}
?>
