<?php  

$host = "localhost";
$user = "root";
$password = "";
$dbname = "admin_registration";
$dsn = "mysql:host={$host};dbname={$dbname}";
$pdo = new PDO($dsn, $user, $password);

?>
