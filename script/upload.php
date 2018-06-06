<?php
header("Location: ../main_page.php");
if (!empty($_FILES))
{
    $img = $_FILES['img'];
    // Check the extension of the file 
    $ext = strtolower(substr($img['name'], -3));
    $allow_ext = array("jpg", "png", "gif");
    if (in_array($ext, $allow_ext)){
        // Move uploaded file into the repertory
        move_uploaded_file($img['tmp_name'], "../pictures/".$img['name']);
    }
    else{
        $ret = "Your file isn't an image";
    }
}
?>
