<?php
require_once("MySiteDB.php");

$login = $_POST['login'];
$password = $_POST['password'];
$rights = $_POST['rights'];

if(($login)&&($password)&&($rights))
{
$query = "INSERT INTO authors VALUES (NULL, '$login', '$password', '$rights')";
mysqli_query($link, $query);
header( "refresh:1;url=admin.php" );
}
?>