<?php

if (!empty($_POST['nom_universite']) and !empty($_POST['ville_universite']) and !empty($_POST['pays_universite'])) 
{
	$new_universite = true;
}

if (!empty($_POST['nom_categorie'])) 
{
	$new_categorie = true;
}

if (empty($_POST['titre']) or empty($_POST['article']) or (empty($_POST['universite']) and empty($new_universite)) or (empty($_POST['categorie']) and empty($new_categorie)) )
{
	$echec = true;
} else
{

	$titre = htmlspecialchars($_POST['titre']);
	$article = htmlspecialchars($_POST['article']);
	$universite = empty($_POST['universite']) ? '' : htmlspecialchars($_POST['universite']);
	$categorie = empty($_POST['categorie']) ? '' : htmlspecialchars($_POST['categorie']);
	$dernier_redacteur =  !empty($_POST['keep_author']) ? htmlspecialchars($_POST['keep_author']) : get_user_id($bdd, htmlspecialchars($_SESSION['mail']));
	$id_article_edite = !empty($_POST['id_article_edite']) ? htmlspecialchars($_POST['id_article_edite']) : 0;

	if (!empty($new_universite))
	{
		$nom_new_universite = htmlspecialchars($_POST['nom_universite']);
		$ville_new_universite = htmlspecialchars($_POST['ville_universite']);
		$pays_new_universite = htmlspecialchars($_POST['pays_universite']);

		$req = $bdd->prepare("INSERT INTO universites(nom, ville, id_pays) VALUES(:nom, :ville, :id_pays)");
		$req->execute(array(
			'nom' => $nom_new_universite,
			'ville' => $ville_new_universite,
			'id_pays' => $pays_new_universite
			));
		$universite = $bdd->lastInsertId();
	}
	if (!empty($new_categorie))
	{
		$nom_new_categorie = htmlspecialchars($_POST['nom_categorie']);

		$req = $bdd->prepare("INSERT INTO categories(nom) VALUES(:nom)");
		$req->execute(array(
			'nom' => $nom_new_categorie
			));	
		$categorie = $bdd->lastInsertId();
	}

	// Connexion à la base de données
	include_once "connect2DB.php";

	$date_ajout=date('Y-m-d H:i:s');
	// Insertion de la clé dans la base de données (à adapter en INSERT si besoin)
	$req = $bdd->prepare("INSERT INTO articles(titre, contenu, id_universite, id_categorie, date_modification, dernier_redacteur, approuve, id_article_edite) VALUES(:titre, :contenu, :id_universite, :id_categorie, STR_TO_DATE(:date_ajout, '%Y-%m-%d %H:%i:%s'), :dernier_redacteur, 0, :id_article_edite)");
	$req->execute(array(
		'titre' => $titre,
		'contenu' => $article,
		'id_universite' => $universite,
		'id_categorie' => $categorie,
		'date_ajout' => $date_ajout,
		'dernier_redacteur' => $dernier_redacteur,
		'id_article_edite' => $id_article_edite
		));

	$id_article = $bdd->lastInsertId();

	if (!empty($_POST['tags'])) 
	{
		$tags = htmlspecialchars($_POST['tags']);
		$pattern = "/(\S+?)(?:[=,|;]|\s+)/";
		preg_match_all($pattern, $tags, $matches);
		foreach ($matches[1] as $key => $value) {
			if (!preg_match("#[,|;]#", $value))
			{
				$req = $bdd->prepare("INSERT INTO tags(tag, id_article) VALUES(:tag, :id_article)");
				$req->execute(array(
					'tag' => $value,
					'id_article' => $id_article
					));
			}
		}
	}


	if (isAdmin($bdd) and $id_article_edite <> 0 and !empty($_POST['keep_author']))
	{
		include_once "validation_article_fonction.php";
	} else
	{

		// On envoie un mail aux modérateurs

		// Préparation du mail contenant le lien d'activation
		$sujet = "[KnowYourTown] Article à modérer - $titre" ;
		$entete = "From: moderation@resel.fr" ;
		 
		$message = 'Un nouvel article a été posté par '.$_SESSION['mail'].' :

http://knowyourtown.resel.fr/article.php?id_article='.urlencode($id_article).'


---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
	 

		$req = $bdd->prepare("SELECT mail FROM users WHERE actif = 1 AND admin = 1");
		$req->execute();								
		while ($donnees = $req->fetch())
		{
			$destinataire = $donnees['mail'];
			mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
		}
		$req->closeCursor();
	}

}
?>