<?php
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
try{
    $req_post = $db->prepare("SELECT * FROM post ORDER BY creation_date DESC");
    $req_post->execute();
    $req_info = count($req_post->fetchAll());
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}

?>
