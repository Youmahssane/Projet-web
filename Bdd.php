<?php 


$host='localhost';
$user='redacteur';
$pass='helb';
$db='bdd';
$dsn = "mysql:host=$host;dbname=$db";

try 
{
	$dbh = new PDO($dsn, $user, $pass); //db handle
} 
catch (PDOException $e) 
{
	die( "Erreur ! : " . $e->getMessage() );
}
?>