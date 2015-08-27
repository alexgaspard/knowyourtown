<?php
	// Récupération des variables nécessaires au mail de confirmation
	$mail = empty($_POST['mail']) ? '' : htmlspecialchars($_POST['mail']);
	$password = empty($_POST['password']) ? '' : htmlspecialchars($_POST['password']);
	// Connexion à la base de données
	include_once "$includes/connect2DB.php";

	//$req = $bdd->query("SELECT * FROM users WHERE mail = '$mail' AND actif=1");
	$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail");	
	$req->execute(array(
		'mail' => $mail
		));							
	while ($donnees = $req->fetch())
	{
		if ($donnees['actif'] != 1) {
			$user_actif = false;
		} else {
			$user_actif = true;
		}
	}
	$req->closeCursor();

	if (isset($user_actif))
	{
		if ($user_actif) 
		{

			$password = chiffrer($password);
			$connection_success = connect_user($mail, $password, $bdd);

			// Si l'utilisateur se connecte depuis une autre page, on le renvoie là d'où il vient (ex. la page contribuer)
			if (!preg_match("#sign.php$#", $_SERVER['HTTP_REFERER']))
			{
				// Redirection du visiteur vers la page précédente
				//header('Location:'. $_SERVER['HTTP_REFERER']);
			}
		}
	}
?>