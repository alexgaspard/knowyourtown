<div class="row-fluid">
	<div class="col-md-12 text-center">
<?php
		include_once "fonctions.php";

		$mail = htmlspecialchars($_POST['mail']);
		$mail_validation = htmlspecialchars($_POST['mail_validation']);

		// Connexion à la base de données
		include_once "connect2DB.php";

		mail_validation($mail, $bdd);
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			Le mail a bien été envoyé.
		</div>
<?php
		// Redirection du visiteur vers la page précédente
		//header('Location:'. $_SERVER['HTTP_REFERER']);

		if ($mail_validation == "inscription")
		{
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
?>
	</div>
</div>