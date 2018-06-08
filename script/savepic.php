<?php
set_include_path("../");
include 'config/database.php';
session_start();
$bdd = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
echo $_POST['name'];
if (isset($_POST['img']) && isset($_POST['all']) && isset($_POST['name'])) {
    $img = htmlspecialchars($_POST['img']);
    $name = htmlspecialchars($_POST['name']);
    $mask = $_POST['all'];
    $mask = json_decode($mask, true);
    $data = explode(',', $img);
    $ext = strpos($data[0], "image");
    if ($ext !== false) {
        $img = $data[1];
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
        file_put_contents("../tmp/tmp.png", $data);
        list($largeur_image, $hauteur_image) = getimagesize("../tmp/tmp.png");
        foreach ($mask as $key => $value) {
            $dest = imagecreatefrompng("../tmp/tmp.png");
            if ($key === 0 && $value === 'block') {
                $src = imagecreatefrompng("../contents/16.png");
                list($wori, $hori) = getimagesize("../contents/16.png");
                $top = 3;
                $left = 230;
                $w = 100;
                $h = 100;
                imagecopyresized($dest, $src, $left, $top, 0, 0, $w, $h, $wori, $hori);
                $res = imagepng($dest, "../tmp/tmp.png", 0);
                imagedestroy($src);
			    imagedestroy($dest);
            }
            else if ($key === 1 && $value === 'block') {
                $src = imagecreatefrompng("../contents/2.png");
                list($wori, $hori) = getimagesize("../contents/2.png");
                $top = 280;
                $left = 230;
                $w = 100;
                $h = 100;
                imagecopyresized($dest, $src, $left, $top, 0, 0, $w, $h, $wori, $hori);
                $res = imagepng($dest, "../tmp/tmp.png", 0);
                imagedestroy($src);
			    imagedestroy($dest);
            }
            else if ($key === 2 && $value === 'block') {
                $src = imagecreatefrompng("../contents/14.png");
                list($wori, $hori) = getimagesize("../contents/14.png");
                $top = 150;
                $left = 230;
                $w = 100;
                $h = 100;
                imagecopyresized($dest, $src, $left, $top, 0, 0, $w, $h, $wori, $hori);
                $res = imagepng($dest, "../tmp/tmp.png", 0);
                imagedestroy($src);
			    imagedestroy($dest);
            }
            else if ($key === 3 && $value === 'block') {
                $src = imagecreatefrompng("../contents/20.png");
                list($wori, $hori) = getimagesize("../contents/20.png");
                $top = 3;
                $left = 1;
                $w = 100;
                $h = 100;
                imagecopyresized($dest, $src, $left, $top, 0, 0, $w, $h, $wori, $hori);
                $res = imagepng($dest, "../tmp/tmp.png", 0);
                imagedestroy($src);
			    imagedestroy($dest);
            }
            else if ($key === 4 && $value === 'block') {
                $src = imagecreatefrompng("../contents/21.png");
                list($wori, $hori) = getimagesize("../contents/21.png");
                $top = 280;
                $left = 400;
                $w = 100;
                $h = 100;
                imagecopyresized($dest, $src, $left, $top, 0, 0, $w, $h, $wori, $hori);
                $res = imagepng($dest, "../tmp/tmp.png", 0);
                imagedestroy($src);
			    imagedestroy($dest);
            }
        }
        if ($res === true) {
            $dest = imagecreatefrompng("../tmp/tmp.png");
            $tok = md5(uniqid(rand()));
            while (file_exists("../pictures/".$tok.".png"))
                $tok = md5(uniqid(rand()));
            $res = imagepng($dest, "../pictures/".$tok.".png", 0);
            imagedestroy($dest);
            if ($res === true) {
                $path = "../pictures/".$tok.".png";
                $date = date('Y-m-j H:i:s');
                $id = $_SESSION['id'];
                try {
                    $req = $bdd->prepare("INSERT INTO post(`login`, `creation_date`, `link`, `name`) VALUES(:login, :date, :link, :name);");
                    $res = $req->execute(array('login' => $id, 'date' => $date, 'link' => $path, 'name' => $name));
                }
                catch(PDOException $e){
                    die('Erreur : ' . $e->getMessage());
                }
            }
        }
    }
}

?>
