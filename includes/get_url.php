<?php

	// Initialisation des variables
	$id_pays = empty($_GET['id_pays']) ? 0 : htmlspecialchars($_GET['id_pays']);
	$id_universite = empty($_GET['id_universite']) ? 0 : htmlspecialchars($_GET['id_universite']);
	$id_categorie = empty($_GET['id_categorie']) ? 0 : htmlspecialchars($_GET['id_categorie']);
	$id_article = empty($_GET['id_article']) ? 0 : htmlspecialchars($_GET['id_article']);

	$nom_pays = '';
	$nom_universite = '';
	$nom_categorie = '';
	$titre_article = '';
?>