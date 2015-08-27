<?php
	function isConnected($bdd) 
	{
		if (empty($_SESSION['mail']) or empty($_SESSION['password']))
		{
			return false;
		} else
		{
			$mail = htmlspecialchars($_SESSION['mail']);
			$password = htmlspecialchars($_SESSION['password']);

			return connect_user($mail, $password, $bdd);
		}
	}

	function connect_user($mail, $password, $bdd) 
	{
		// Vérification des données saisies par l'utilisateur
		$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail AND actif=1");	
		$req->execute(array(
			'mail' => $mail
			));								
		while ($donnees = $req->fetch())
		{
			$passwordDB = $donnees['password'];
			$id_user = $donnees['id'];
		}
		$req->closeCursor();

		if ($password == $passwordDB) // C'est le bon mot de passe de cet utilisateur
		{
			$_SESSION['mail'] = $mail;
			$_SESSION['password'] = $password;
	
			$date_derniere_connexion=date('Y-m-d H:i:s');
			$req = $bdd->prepare("UPDATE users SET derniere_connexion = STR_TO_DATE(:date_derniere_connexion, '%Y-%m-%d %H:%i:%s') WHERE id = :id_user");
			$req->execute(array(
				'id_user' => $id_user,
				'date_derniere_connexion' => $date_derniere_connexion
				));

			return true;
		} else {
			return false;
		}
	}

	function get_user_id($bdd, $mail) 
	{
		$id_user=0;
		// Vérification des données saisies par l'utilisateur
		$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail AND actif=1");		
		$req->execute(array(
			'mail' => $mail
			));							
		while ($donnees = $req->fetch())
		{
			$id_user = $donnees['id'];
		}
		$req->closeCursor();

		return $id_user;
	}

	function isAdmin($bdd) 
	{
		if (empty($_SESSION['mail']) or empty($_SESSION['password']))
		{
			return false;
		} else
		{
			$mail = htmlspecialchars($_SESSION['mail']);
			$password = htmlspecialchars($_SESSION['password']);

			// Vérification des données saisies par l'utilisateur
			$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail AND actif=1");	
			$req->execute(array(
				'mail' => $mail
				));								
			while ($donnees = $req->fetch())
			{
				$passwordDB = $donnees['password'];
				$admin = $donnees['admin'];
			}
			$req->closeCursor();

			if (($password == $passwordDB) and ($admin==1)) // C'est le bon mot de passe et il est admin
			{
				return true;
			} else {
				return false;
			}
		}
	}

	function lightbox($id, $url_img, $caption) 
	{
?>
		<div id="<?php echo $id; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
			<div class='lightbox-content'>
				<img src="<?php echo $url_img; ?>">
				<div class="lightbox-caption"><p><?php echo $caption; ?></p></div>
			</div>
		</div>
<?php
	}

	function connect2DB($host, $user, $pwd, $base) 
	{
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

		return $bdd;
	}

	function mail_validation($mail, $bdd) 
	{
		$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail");	
		$req->execute(array(
			'mail' => $mail
			));								
		while ($donnees = $req->fetch())
		{
			$clef = $donnees['clef'];
		}
		$req->closeCursor();
		 
		// Préparation du mail contenant le lien d'activation
		$destinataire = $mail;
		$sujet = "[KnowYourTown] Activer votre compte" ;
		$entete = "From: inscription@resel.fr" ;
		 
		// Le lien d'activation est composé du login(log) et de la clef(clef)
		$message = 'Bienvenue sur KnowYourTown,
		 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.

http://knowyourtown.resel.fr/validation.php?mail='.urlencode($mail).'&clef='.urlencode($clef).'


---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
		 
		mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
	}

	function mail_mot_de_passe_oublie($mail, $bdd) 
	{
		$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail");	
		$req->execute(array(
			'mail' => $mail
			));								
		while ($donnees = $req->fetch())
		{
			$clef = $donnees['clef'];
		}
		$req->closeCursor();
		 
		// Préparation du mail contenant le lien d'activation
		$destinataire = $mail;
		$sujet = "[KnowYourTown] Mot de passe oublié" ;
		$entete = "From: inscription@resel.fr" ;
		 
		// Le lien d'activation est composé du login(log) et de la clef(clef)
		$message = 'Message de KnowYourTown,

Une demande de changement de mot de passe a été émise pour votre compte. Si vous n\'en êtes	pas l\'auteur, veuillez ignorer ce message.

Pour changer votre mot de passe, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.

http://knowyourtown.resel.fr/validation.php?mail='.urlencode($mail).'&clef='.urlencode($clef).'


---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
		 
		mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail
	}

	function collapse($id, $alt_img, $url_img, $caption) 
	{
?>
		<div id="<?php echo $id; ?>" class="collapse out">
			<div class="row-fluid">
				<div class="span6">
					<img src="<?php echo $url_img; ?>" alt="<?php echo $alt_img; ?>" class="thumbnail left" style="height:50px;">
				</div>
				<div class="span6">
					<?php echo $caption; ?>
				</div>
			</div>
		</div>
<?php
	}

	function chiffrer($password) 
	{
		$salt = "Ai!~&@46NVuP%5d4";
		$password_crypte = sha1(sha1($password).$salt);
		return $password_crypte;
	}
	
	function display_imgs_from($dir) 
	{
		$listephotos = array();
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {

				$ext_list = array("jpg", "jpeg", "bmp", "gif", "png"); // Liste des extensions de photo
		        while (($file = readdir($dh)) !== false) {
		        	if(filetype($dir . $file) == "file"){ // Si c'est un fichier
			        	if(in_array(preg_replace("#(.+)\.(.+)#", "$2", strtolower($file)), $ext_list))
						{ // Si c'est une image
							$listephotos[] = $file; // Ajoute la photo
						}
					}

		        }
		        closedir($dh);
				sort($listephotos); // Trie par ordre alphabétique
				// Et maintenant, on affiche.
				/*foreach($listephotos as $nom)
				{
					echo $nom."<br>"; // Le nom de la photo + un retour à la ligne
				}*/
				return $listephotos;
		    }
		}
	}
?>