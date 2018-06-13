<?PHP
include 'database.php';

/* try{
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e){
    print "Failure to connect with the servor! the mistake comes from: ".$e; */
    try{
        $db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // $db->query($req);
    }
    catch(PDOException $e){
/*         session_start(); */
        session_destroy();
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $req = $db->query("CREATE DATABASE IF NOT EXISTS `".$DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
        $db->query("USE ".$DB_NAME);
        // print "Fail to create the database! the mistake comes from: ".$e;
        try{
            // if ($db){
               /*  users table */
                $users_table = "CREATE TABLE IF NOT EXISTS users(
                                `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                `login` VARCHAR(255) NOT NULL,
                                `email` VARCHAR(255) NOT NULL,
                                `password` VARCHAR(255) NOT NULL,
                                `confirmation` INT(1) NOT NULL DEFAULT 0,
                                `token` VARCHAR(255) NOT NULL,
                                PRIMARY KEY (`id`)
                                );";
                $req_users_table = $db->prepare($users_table);
                $req_users_table->execute();
                
                /* post table */
                $post_table = "CREATE TABLE IF NOT EXISTS post(
                                `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                `login` VARCHAR(255) NOT NULL,
                                `creation_date` DATETIME,
                                `nb_likes` INT UNSIGNED DEFAULT 0,
                                `nb_comments` INT UNSIGNED DEFAULT 0,
                                `link` VARCHAR(255) CHARACTER SET latin1 NOT NULL,
                                `name` VARCHAR(255) CHARACTER SET latin1 NOT NULL,
                                PRIMARY KEY(`id`)
                                );";
                $req_post_table = $db->prepare($post_table);
                $req_post_table->execute();
    
                /* likes table */
                $like_table = "CREATE TABLE IF NOT EXISTS likes(
                                `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                `login` VARCHAR(255) NOT NULL,
                                `id_picture` INT NOT NULL,
                                PRIMARY KEY(`id`)
                                );";
                $req_like_table = $db->prepare($like_table);
                $req_like_table->execute();
    
                /* Comments table */
                $comment_table = "CREATE TABLE IF NOT EXISTS comments(
                                    `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                    `login` VARCHAR(255) NOT NULL,
                                    `id_picture` INT NOT NULL,
                                    `text` VARCHAR(255),
                                    `creation_date` DATETIME,
                                    PRIMARY KEY (`id`)
                                    );";
                $req_comment_table = $db->prepare($comment_table);
                $req_comment_table->execute();
            // }        
        }
        catch(PDOException $e){
            print "ERROR! The mistake comes from: ".$e;
        }
    }
    



?>
