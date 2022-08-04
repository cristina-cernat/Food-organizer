<?php
$host = 'localhost';
$dbname = 'forg';
$user = 'root';
$pass = '';
try
{
	$options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
    );
	$dbh = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass, $options);
}
catch(PDOException $e)
{
	echo "<script>location.href = 'ErrorPage/connection.php'</script>";
}
?>