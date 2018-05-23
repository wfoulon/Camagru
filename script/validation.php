<?php
set_include_path("../");
include 'config/database.php';
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$login = (isset($_GET['login'])) ? htmlentities($_GET['login']) : NULL;
$token = (isset($_GET['token'])) ? htmlentities($_GET['token']) : NULL;
try
{
    $update_users = $db->prepare("UPDATE users SET confirmation = 1 WHERE token = ?");
    $res = $update_users->execute(array($token));
    $update_users2 = $db->prepare("SELECT token FROM users WHERE login = ? LIMIT 1");
    $update_users2->execute(array($login));
    $user_info = $update_users2->fetchAll();
    if ($user_info[0]['token'] == 0)
    {
        $ret = "Your account has been validated";
    }
    else 
    {
        $ret = "Your account hasn't been validated yet. Please try again.";
    }
    $update_users2 = $db->prepare("UPDATE users SET token = 0 WHERE login = ?");
    $update_users2->execute(array($login));
    echo $ret;
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
?>
<script language="JavaScript">
setTimeout(function(){
document.location.href="../index.php";
}, 3000);
</script>
