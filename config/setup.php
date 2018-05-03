<?PHP
include 'database.php';

try{
$db = new PDO($DB_DSN.";dbname=".$DB_NAME, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(PDOException $e){
    print "Failure to connect with the servor! the mistake comes from: ".$e;
    try{
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $req = "CREATE DATABASE IF NOT EXISTS `".$DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $db->query($req);
        $db->query("USE ".$DB_NAME);
    }
    catch(PDOException $e){
        print "Fail to create the database! the mistake comes from: ".$e;
    }
    
    try{
        if ($db){
            $users_table = "CREATE TABLE IF NOT EXISTS users(
                            `id` INT(5) NOT NULL AUTO_INCREMENT,
                            `login` VARCHAR(255) NOT NULL,
                            `email` VARCHAR(255) NOT NULL,
                            `password` VARCHAR(255) NOT NULL,
                            `confirmation` INT(1) NOT NULL DEFAULT 0,
                            `token` VARCHAR(255) NOT NULL,
                            PRIMARY KEY (`id`)
                            );";
            $users_table = $db->prepare($users_table);
            $users_table->execute();
        }
    }
    catch(PDOException $e){
        print "ERROR! The mistake comes from: ".$e;
    }
}


?>
