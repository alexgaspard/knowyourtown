<?php
	session_start();
	include "fonctions.php";

	$id_article = htmlspecialchars($_POST['id_article']);

	include_once "connect2DB.php";

	if (isAdmin($bdd)) {

		$id_article_edite=0;
		$req = $bdd->prepare("SELECT * FROM articles WHERE id=:id_article");	
		$req->execute(array(
			'id_article' => $id_article
			));			
		while ($donnees = $req->fetch())
		{
			$id_universite = htmlspecialchars($donnees['id_universite']);
			$id_categorie = htmlspecialchars($donnees['id_categorie']);
			$id_article_edite = htmlspecialchars($donnees['id_article_edite']);
		}
		$req->closeCursor();

		$req = $bdd->prepare("UPDATE articles SET id_article_edite = :id_article_edite WHERE id_article_edite = :id_article");
		$req->execute(array(
			'id_article_edite' => $id_article_edite,
			'id_article' => $id_article
			));

		$req = $bdd->prepare("DELETE FROM articles WHERE id = :id_article");
		$req->execute(array(
			'id_article' => $id_article
			));
	}

	// Redirection du visiteur vers la page précédente
	header('Location:../categorie.php?id_universite='.$id_universite.'&id_categorie='.$id_categorie);
?>