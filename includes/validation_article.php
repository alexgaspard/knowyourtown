<?php
	session_start();
	include "fonctions.php";


	/*function deleteOldArticles($bdd, $id_nouvel_article, $id_article) 
	{
		$req = $bdd->prepare("SELECT * FROM articles WHERE id=:id_article");	
		$req->execute(array(
			'id_article' => $id_article
			));			
		while ($donnees = $req->fetch())
		{
			$id_article_edite = htmlspecialchars($donnees['id_article_edite']);
		}
		$req->closeCursor();

		if (!empty($id_article_edite))
		{
			deleteOldArticles($bdd, $id_article, $id_article_edite);
		}

		$req = $bdd->prepare("UPDATE articles SET id_article_edite = :id_nouvel_article WHERE id_article_edite = :id_article");
		$req->execute(array(
			'id_nouvel_article' => $id_nouvel_article,
			'id_article' => $id_article
			));

		$req = $bdd->prepare("DELETE FROM articles WHERE id=:id_article");
		$req->execute(array(
			'id_article' => $id_article
			));
	}*/

	$id_article = htmlspecialchars($_POST['id_article']);

	include_once "validation_article_fonction.php";

	/*include_once "connect2DB.php";

	if (isAdmin($bdd)) {

		$req = $bdd->prepare("SELECT * FROM articles WHERE id=:id_article");	
		$req->execute(array(
			'id_article' => $id_article
			));			
		while ($donnees = $req->fetch())
		{
			$id_article_edite = htmlspecialchars($donnees['id_article_edite']);
		}
		$req->closeCursor();

		if (!empty($id_article_edite))
		{
			deleteOldArticles($bdd, $id_article, $id_article_edite);
		}

		$req = $bdd->prepare("UPDATE articles SET approuve = 1, id_article_edite = 0 WHERE id = :id_article");
		$req->execute(array(
			'id_article' => $id_article
			));
	}*/

	// Redirection du visiteur vers la page précédente
	header('Location:'. $_SERVER['HTTP_REFERER']);
?>