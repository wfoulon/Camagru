<?php
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
try{
    $prep = $db->prepare('SELECT * FROM post WHERE login=:id ORDER BY creation_date DESC');
    $prep->bindParam(':id', $_SESSION['id']);
    $prep->execute();
    $req_pic = $prep->fetchAll();
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
foreach($req_pic as $key => $value){
    $link = explode('/', $value['link'])[2];
    echo '<div class="pic-cont"><div class="del"><i id="'.$value['id'].'" style="color:red" class="fas fa-times fa-2x"></i></div>';
    echo '<div class="min"><img src="pictures/'.$link.'"/></div></div>';

}
?>
