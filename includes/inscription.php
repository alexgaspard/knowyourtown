<div class="row-fluid">
	<div class="col-md-12 text-center">
<?php
 
		// Connexion à la base de données
		include_once "$includes/connect2DB.php";
		// Vérification des données saisies par l'utilisateur
		//if (preg_match("#^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$#", $mail))
		if (preg_match("#^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@telecom-bretagne.eu$#", $mail))
		{
		    if (strlen($password)>5 and strlen($password)<31) 
		    {

				$password = chiffrer($password);

				$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail");	
				$req->execute(array(
					'mail' => $mail
					));								
				while ($donnees = $req->fetch())
				{
					$mail_existant = true;
				}
				$req->closeCursor();

				if (isset($mail_existant))
				{
?>
					<div class="alert alert-danger">
						<p>
							Cette adresse mail est déjà utilisée.
						</p>
					</div>
<?php
				} else
				{
					// Génération aléatoire d'une clé
					$clef = md5(microtime(TRUE)*100000);
					 
					$date_derniere_connexion=date('Y-m-d H:i:s');
					// Insertion de la clé dans la base de données
					$req = $bdd->prepare("INSERT INTO users(mail, password, clef, actif, derniere_connexion) VALUES(:mail, :password, :clef, 0, STR_TO_DATE(:date_derniere_connexion, '%Y-%m-%d %H:%i:%s'))");
					$req->execute(array(
						'mail' => $mail,
						'password' => $password,
						'clef' => $clef,
						'date_derniere_connexion' => $date_derniere_connexion
						));			 

					mail_validation($mail, $bdd);
?>
					<div class="alert alert-info">
						<p>
							Un mail de confirmation vous a été envoyé, pensez à vérifier votre boîte spam.<br>
							Vous pouvez renvoyer le mail en cliquant sur ce bouton.<br>
							<form action="" method="post" enctype="multipart/form-data" role="form">
								<input type="hidden" name="mail_validation" value="inscription" />
								<input type="hidden" name="mail" value="<?php echo $mail; ?>" />
								<button type="submit" class="btn btn-primary">Renvoyer le mail de validation <span class="glyphicon glyphicon-send"></span></button>
							</form>
						</p>
					</div>
<?php
			    }
			} else 
			{
?>
				<div class="alert alert-danger">
					<p>
						Le mot de passe que vous avez choisi ne fait pas la bonne taille.<br>
						Il doit être de 6 à 30 caractères.
					</p>
				</div>
<?php
			}
		}
		else
		{
?>
			<div class="alert alert-danger">
				<p>
					Cette adresse mail n'est pas valide.<br>
					Vous devez utiliser votre adresse de Télécom.
				</p>
			</div>
<?php
		}

// Redirection du visiteur vers la page précédente
//header('Location:'. $_SERVER['HTTP_REFERER']);
?>
	</div>
</div>