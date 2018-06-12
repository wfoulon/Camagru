<?php
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
try{
    $req_post = $db->prepare("SELECT * FROM post ORDER BY creation_date DESC");
    $req_post->execute();
    $req_info = $req_post->fetchAll();
}
catch (PDOexception $e)
{
    print "ERROR! The mistake comes from: ".$e->getMessage()."";
    die();
}
if (!$req_info)
{
    $ret = "There is no pictures yet";
}

else{
    foreach($req_info as $key => $value)
    {
        try {
            $req_login = $db->prepare("SELECT login FROM users WHERE id = :login");
            $req_login->execute(array('login' => $value['login']));
            $login_info = $req_login->fetchAll();
        }
        catch (PDOexception $e)
        {
            print "ERROR! The mistake comes from: ".$e->getMessage()."";
            die();
        }
        
        $link = explode('/', $value['link'])[2];
        echo '<div class="display"><img src="pictures/'.$link.'"/>';
        echo '<a href="likes_comments.php?picture='.$link.'"><div class="namepic">'.$value['name'].'</div></a>';
        echo '<div class="pb">Posted by: '.$login_info[0]['login'].'</div>';
        echo '<div class="time"> Uploaded on: '.$value['creation_date'].'</div>';
        echo '<div class="num"><i class="test1 fas fa-comments fa-2x"></i>'.$value['nb_comments'].'</div>';
        echo '<div class="num"><i class="test fas fa-heart fa-2x"></i>'.$value['nb_likes'].'</div>';
        echo '</div>';
    }
}
?>
