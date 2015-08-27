<div class="row-fluid">
	<div class="col-md-12 text-center">
<?php
	// Récupération des variables nécessaires au mail de confirmation
	/*$mail = htmlspecialchars($_POST['mail']);
	$password = htmlspecialchars($_POST['password']);
	// Connexion à la base de données
	include_once "$includes/connect2DB.php";

	//$req = $bdd->query("SELECT * FROM users WHERE mail = '$mail' AND actif=1");
	$req = $bdd->query("SELECT * FROM users WHERE mail = '$mail'");								
	while ($donnees = $req->fetch())
	{
		if ($donnees['actif'] != 1) {
			$user_actif = false;
		} else {
			$user_actif = true;
		}
	}
	$req->closeCursor();*/

		if (isset($user_actif))
		{
			if ($user_actif) 
			{

				/*$password = chiffrer($password);
				$connection_success = connect_user($mail, $password, $bdd);*/
				if ($connection_success)
				{
?>
					<div class="alert alert-success">
						<p>
							Vous êtes maintenant connecté sous l'adresse <?php echo $_SESSION['mail']; ?>.
						</p>
					</div>
<?php
				} else 
				{
?>
					<div class="alert alert-danger">
						<p>
							Vous avez entré un mot de passe erroné.
						</p>
					</div>
<?php
				}
			} else 
			{
?>
				<div class="alert alert-info">
					<p>
						Vous devez d'abord activer votre compte, cliquez ici pour renvoyer le mail de validation :<br>
						<form action="" method="post" enctype="multipart/form-data" role="form">
							<input type="hidden" name="mail_validation" value="connexion" />
							<input type="hidden" name="mail" value="<?php echo $mail; ?>" />
							<button type="submit" class="btn btn-primary">Renvoyer le mail de validation <span class="glyphicon glyphicon-send"></span></button>
						</form>
					</p>
				</div>
<?php
			}
		} else 
		{
			include_once "$includes/inscription.php";
		}
?>
	</div>
</div>