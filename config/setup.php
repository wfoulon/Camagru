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
                                `notif` ENUM('0', '1') NOT NULL,
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

        try{
            $req = $db->query("INSERT INTO `users` (`id`, `login`, `email`, `password`, `confirmation`, `token`, `notif`) VALUES
            (1, 'wfoulon', 'wfoulon@student.42.fr', '3ea96d2f377f3e1af344eeda0e6d65a47a4959034e3e9e79ad2b1e9b27739e87847004f284505721170b9526dec31208c600c9c234e246b777ab28c33cb6f69d', 1, '5e4450165df6540c58124ff5088515b7e0aae341', '1'),
            (2, 'llonger', 'llonger@hotmail.com', '7a39afbf5124c00aa63cb619bc23bbd76018d80ddebab307a2689e7cca53b09327e0eb680e1968480f4b07307e5aa1d6012e1e7b5fc3eced56179836b8609764', 1, '62951522dbaaefa19b27f9242a774f2645a7017c', '1'),
            (3, 'lsauvage', 'savage@gmail.com', '593f76fb7dcd54473b58da72ff03057080e3f0ad46039e6a2484f14de1367abdb72503c79f2cdef81672c79640551eb094ade1a995395402933d4ee6967ed476', 1, 'd36a0f8f4eee85dba52371680eb21651299ff66a', '1'),
            (4, 'flgazeau', 'gazgaz@gmail.com', '593f76fb7dcd54473b58da72ff03057080e3f0ad46039e6a2484f14de1367abdb72503c79f2cdef81672c79640551eb094ade1a995395402933d4ee6967ed476', 1, 'd36a0f8f4eee85dba52371680eb21651299ff66a', '1');");
        }
        catch(PDOException $e){
            print "ERROR1".$e;
        }

        try{
            $req = $db->query("INSERT INTO `post` (`id`, `login`, `creation_date`, `link`, `name`) VALUES
            (1, '1', '2018-06-06 04:45:09', '../pictures/dbb2afdf93eead01ee10dc73dd5f35a7.png', 'Bonjour'),
            (2, '2', '2018-06-07 06:47:24', '../pictures/e3ceb29526bba90dd26b461c3fdae822.png', 'oklm'),
            (3, '3', '2018-06-09 07:55:18', '../pictures/2743fe0eb210a193b2880948e385d254.png', 'cosmos'),
            (4, '4', '2018-06-11 12:15:13', '../pictures/1856904479d1e20e781075d6ae86a04e.png', 'wolfy'),
            (5, '1', '2018-06-12 11:29:12', '../pictures/2855e33f9166c74dc90a88e4271b875c.png', 'lightsaber'),
            (6, '4', '2018-06-13 19:30:55', '../pictures/3eba74fdd09ef488a49538a93a9d00e5.png', 'Chill'),
            (7, '1', '2018-06-14 21:00:00', '../pictures/2fccef334fcb104f2bd0b28810c2f29e.png', 'Earth');");
        }
        catch(PDOException $e){
            print "ERROR2".$e;
        }

         try{
            $req = $db->query("INSERT INTO `comments` (`id`, `login`, `id_picture`, `text`, `creation_date`) VALUES
            (1, '1', 1, 'Hello World', '2018-06-14 13:25:17'),
            (2, '2', 2, 'Hi men', '2018-06-11 14:25:17'),
            (3, '3', 3, 'Wonderful', '2018-06-12 15:25:17'),
            (4, '4', 4, 'Amazing', '2018-06-10 16:25:17'),
            (5, '2', 5, 'Extraordinary', '2018-06-11 17:25:17'),
            (6, '1', 6, 'Super', '2018-06-13 18:25:17'),
            (7, '4', 7, 'This is spectacular', '2018-06-15 19:25:17'),
            (8, '3', 7, 'WTF', '2018-06-09 20:25:17');");
        }
        catch(PDOException $e){
            print "ERROR3".$e;
        }

        try{
            $req = $db->query("INSERT INTO `likes` (`id`, `login`, `id_picture`) VALUES
            (1, '1', 1),
            (2, '2', 2),
            (3, '3', 3),
            (4, '4', 4),
            (5, '2', 5),
            (6, '3', 7);");
        }
        catch(PDOException $e){
            print "ERROR4".$e;
        }
    }
?>
