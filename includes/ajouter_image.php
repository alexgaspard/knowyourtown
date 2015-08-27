<?php
	// Connexion à la base de données
	include_once "connect2DB.php";

	$id = 0;
	$id_article = 0;

	// On teste si le fichier a bien été envoyé et s'il n'y a pas d'erreur
	if (isset($_POST['script']) AND isset($_FILES['image_article']) AND $_FILES['image_article']['error'] == 0)
	{
		// Testons si le fichier n'est pas trop gros
		if ($_FILES['image_article']['size'] <= 10000000)
		{
			// Testons si l'extension est autorisée
			$infosfichier = pathinfo($_FILES['image_article']['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('jpg', 'jpeg', 'png');
			if (in_array($extension_upload, $extensions_autorisees))
			{
				$date_ajout=date('Y-m-d H:i:s');
				$req = $bdd->prepare("INSERT INTO images(date_ajout) VALUES(STR_TO_DATE(:date_ajout, '%Y-%m-%d %H:%i:%s'))");
				$req->execute(array(
					'date_ajout' => $date_ajout
					));
				$id = $bdd->lastInsertId();
				// On peut valider le fichier et le stocker définitivement
				move_uploaded_file($_FILES['image_article']['tmp_name'], '../img/img_articles/img_' . $id .'.'.$extension_upload);//basename($_FILES['image']['name']));
				
				echo 'id='.$id.',ext='.$extension_upload;
			} else
			{
				echo 'extension';
			}
		} else
		{
			echo 'size';
		}
	} else
	{
		echo 'unset';
	}
	// Redirection du visiteur vers la page précédente
	//header('Location:'. $_SERVER['HTTP_REFERER']);
?>