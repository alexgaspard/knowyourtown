<?php

	$host='localhost';
	$user='knowyourtown';
	$pwd='PUUbzMZYyDKDZvvB';
	$base='knowyourtown';

	try
	{
		// On se connecte à MySQL
		$bdd = new PDO('mysql:host='.$host.';dbname='.$base, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		// En cas d'erreur, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
?>