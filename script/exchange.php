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
echo '<div class=pic><img src="'.$link.'"/>';
echo '</div>';

?>
