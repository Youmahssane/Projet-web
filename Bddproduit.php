<?php

$host='localhost';
$user='redacteur';
$pass='helb';
$db='bddvente';
$dsn = "mysql:host=$host;dbname=$db";

try 
{
	$dbs = new PDO($dsn, $user, $pass); //db handle
} 
catch (PDOException $e) 
{
	die( "Erreur ! : " . $e->getMessage() );
}
?>