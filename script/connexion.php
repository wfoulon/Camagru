<?PHP
$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if ($_POST['connect'] == "sign in")
{
    if (!empty($_POST['login1']) && !empty($_POST['passsword1']))
    {
        
    }
}

?>
