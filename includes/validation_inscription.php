<div class="row-fluid">
	<div class="col-md-12 text-center">
<?php
 
		// Connexion à la base de données
		include_once "$includes/connect2DB.php";

		// Récupération des variables nécessaires à l'activation
		$mail = htmlspecialchars($_GET['mail']);
		$clef = htmlspecialchars($_GET['clef']);
		 
		// Récupération de la clé dans la base de données
		$req = $bdd->prepare("SELECT * FROM users WHERE mail = :mail AND clef = :clef");	
		$req->execute(array(
			'mail' => $mail,
			'clef' => $clef
			));								
		while ($donnees = $req->fetch())
		{
		    $actif = $donnees['actif']; // $actif contiendra alors 0 ou 1
		}
		$req->closeCursor();
		 
		 
		if (!isset($actif))
		{
?>
			<div class="alert alert-danger">
				<p>
					L'adresse mail ou la clef n'ont pas été trouvées dans la base, si votre inscription remonte à plus d'un jour, vous avez été effacé, vous pouvez vous réinscrire <a href="sign.php">ici</a>.
				</p>
			</div>
<?php

		} else if ($actif == '1') // Si le compte est déjà actif on propose de changer le mot de passe.
		{
			if (!empty($_POST['new_password']))
			{
				$new_password = chiffrer(htmlspecialchars($_POST['new_password']));

				if (strlen(htmlspecialchars($_POST['new_password']))>5 and strlen(htmlspecialchars($_POST['new_password']))<31) 
			    {
					$req = $bdd->prepare("UPDATE users SET password = :password WHERE mail = :mail AND actif=1");
					$req->execute(array(
						'password' => $new_password,
						'mail' => $mail
						));
	?>
					<div class="row-fluid">
						<div class="col-md-12">
							<div class="alert alert-success">
								<p>
									Votre mot de passe a été modifié.<br>
									<a href="sign.php">Se connecter</a>
								</p>
							</div>
						</div>
					</div>
	<?php
				} else
				{
	?>
					<div class="row-fluid">
						<div class="col-md-12">
							<div class="alert alert-danger">
								<p>
									Votre nouveau mot de passe a une taille invalide (il doit être de 6 à 30 caractères).
								</p>
							</div>
						</div>
					</div>
	<?php
				}
			}
?>
			<!--<div class="alert alert-info">
				<p>
					Votre compte est déjà actif.<br>
					<a href="sign.php">Se connecter</a>
				</p>
			</div>-->


			<div class="row-fluid">
				<div class="col-md-4 col-md-offset-4">
					<div class="well">
						<form action="validation.php?mail=<?php echo $mail; ?>&clef=<?php echo $clef; ?>" method="post" enctype="multipart/form-data" role="form">
							<div class="form-group">
								<label for="new_password">Nouveau mot de passe</label>
								<input type="password" name="new_password" class="form-control" id="new_password" placeholder="Votre nouveau mot de passe"/>
								<p class="help-block">Votre mot de passe doit faire entre 6 et 30 caractères.</p>
								<input type="hidden" name="mail" value="<?php echo $mail; ?>"/>
								<input type="hidden" name="clef" value="<?php echo $clef; ?>"/>
							</div>
							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<button type="submit" class="btn btn-info">Changer</button>
								</div>
							</div>
						</form>
					</div>
				</div>	
			</div>
<?php
		} else // Si ce n'est pas le cas on passe en actif
		{	
			// La requête qui va passer notre champ actif de 0 à 1
			$req = $bdd->prepare("UPDATE users SET actif = 1 WHERE clef = :clef");
			$req->execute(array(
				'clef' => $clef
				));
?>
			<div class="alert alert-success">
				<p>
					Votre compte a bien été activé !<br>
					<a href="sign.php">Se connecter</a>
				</p>
			</div>
<?php
		}

?>
	</div>
</div>