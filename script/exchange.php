<?php
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//Protection for the link of the picture in the URL
if (!isset($_GET['picture']))
{
    header("Location: index.php");
}
else{
    $link = htmlentities($_GET['picture']);
    $link = "pictures/".$link."";
}
$bdd_link = "../$link";
//request for the picture we are looking for
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
//Request for the number of likes
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
//Request for the number of comments
try {
    $req = $db->prepare('SELECT * FROM comments WHERE id_picture = :id ORDER BY `creation_date` DESC');
    $res = $req->execute(array('id' => $req_pic[0]['id']));
    $res = $req->fetchAll();
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
$nbcom = count($res);

//Display in the html page
echo '<div class="pic"><img src="'.$link.'"/></div>';
echo '<div class="icn">';
echo    '<div class="num"><i class="test1 fas fa-comments fa-2x"></i><span id="nbcom">'.$nbcom.'</span></div>';
if (isset($_SESSION['login']))
    echo    '<div class="num"><i value="'.$req_pic[0]['id'].'" id="like" class="test fas fa-heart fa-2x"></i><span id="likeSpan">'.$nb.'</span></div>';
else
    echo    '<div class="num"><i class="test fas fa-heart fa-2x"></i>'.$nb.'</div>';
echo '</div>';
if (isset($_SESSION['login'])) {
    echo '<div id="form-content" class="form-content">';
    // echo    '<form class="comments" method="POST" action="" autocomplete="off">';
    echo    '<textarea id="text-com"  name="com" placeholder="Write your comment"></textarea>';
    echo    '<input id="send-com" type="submit" name="comment" value="SEND" class="button" style="margin-top:10px"></input>';
    // echo    '</form>';
    echo '</div>';
}

foreach ($res as $key => $value) {
    try {
        $req = $db->query("SELECT login FROM users WHERE id = '".$value['login']."';");
        $res2 = $req->fetchAll();
    }
    catch (PDOexception $e)
    {
        die("ERROR! The mistake comes from: ".$e->getMessage()."");
    }
    if (count($res2) !== 0) {
   ?>
    <div class="com-content">
        <span><strong><?php echo $res2[0]['login'] ?></strong></span>
        <br />
        <span><?php echo $value['text'] ?></span>
        <br />
    </div>
   <?php }
}
?>
