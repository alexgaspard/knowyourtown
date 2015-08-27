<?php
	session_start();
	$_SESSION['mail'] = '';
	$_SESSION['password'] = '';
	// Redirection du visiteur vers la page précédente
	header('Location:'. $_SERVER['HTTP_REFERER']);
?>