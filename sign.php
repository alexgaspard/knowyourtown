<?php include "includes/paths.php" ?>
<?php include "$includes/variables.php" ?>
<?php date_default_timezone_set('Europe/Paris'); ?>
<?php include "$includes/fonctions.php" ?>

<?php include_once "$includes/sign.php"; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Know Your Town</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include "$includes/links.php"; ?>
</head>
<body>
	<div class="row-fluid">
		<div class="col-md-12">
			<?php include "$includes/header.php"; ?>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
<?php
				// Connexion à la base de données
				include_once "$includes/connect2DB.php";
				if (!empty($_POST['mail_validation']) and !empty($_POST['mail']))
				{
					include "$includes/mail_validation.php";
				} else if (!empty($_POST['mail']) and !empty($_POST['password']))
				{
					include "$pages/sign.php";
				} else if (isConnected($bdd))
				{
					include "$includes/changer_mdp.php";
?>
					<!--<div class="row-fluid">
						<div class="col-md-12 text-center">
							<div class="alert alert-success">
								<p>
									Vous êtes déjà connecté sous l'adresse <?php //echo $_SESSION['mail']; ?>.
								</p>
							</div>
						</div>
					</div>-->
					<div class="row-fluid">
						<div class="col-md-4 col-md-offset-4">
							<div class="well">
								<form action="sign.php" method="post" enctype="multipart/form-data" role="form">
									<div class="form-group">
										<label for="old_password">Ancien mot de passe</label>
										<input type="password" name="old_password" class="form-control" id="old_password" placeholder="Votre ancien mot de passe"/>
									</div>
									<div class="form-group">
										<label for="new_password">Nouveau mot de passe</label>
										<input type="password" name="new_password" class="form-control" id="new_password" placeholder="Votre nouveau mot de passe"/>
										<p class="help-block">Votre mot de passe doit faire entre 6 et 30 caractères.</p>
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

				} else if (!empty($_POST['forgotten_password_mail']))
				{
					$forgotten_password_mail = htmlspecialchars($_POST['forgotten_password_mail']);
					// Génération aléatoire d'une clé
					$clef = md5(microtime(TRUE)*100000);
					
					// Insertion de la clé dans la base de données
					$req = $bdd->prepare("UPDATE users SET clef = :clef WHERE mail = :mail");
					$req->execute(array(
						'clef' => $clef,
						'mail' => $forgotten_password_mail
						));

					mail_mot_de_passe_oublie($forgotten_password_mail, $bdd);
?>
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						Un mail vous indiquant la procédure à suivre pour changer votre mot de passe vous a été envoyé.
					</div>
<?php
				} else if (!empty($_POST['forgotten_password']))
				{
?>					
					<div class="row-fluid">
						<div class="col-md-4 col-md-offset-4">
							<div class="well">
								<form action="sign.php" method="post" enctype="multipart/form-data" role="form">
									<div class="form-group">
										<label for="forgotten_password_mail">Email</label>
										<input type="email" name="forgotten_password_mail" class="form-control" id="forgotten_password_mail" placeholder="Votre email de Télécom Bretagne"/>
										<p class="help-block">Votre email de Télécom Bretagne.</p>
									</div>
									<div class="row">
										<div class="col-md-4 col-md-offset-4">
											<button type="submit" class="btn btn-info">Envoyer</button>
										</div>
									</div>
								</form>
							</div>
						</div>	
					</div>
<?php
				}  else
				{
					include "$pages/connexion.php";
				}
?>
			</div>
		</div>
	</div>
	<?php include "$includes/background.php"; ?>

</body>
<?php include "$includes/scripts.php"; ?>
</html>