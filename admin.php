<?php include "includes/paths.php" ?>
<?php include "$includes/variables.php" ?>
<?php date_default_timezone_set('Europe/Paris'); ?>
<?php include "$includes/fonctions.php" ?>

<?php
// Connexion à la base de données
include_once "$includes/connect2DB.php";

if (!isAdmin($bdd))
{
	// Redirection du visiteur vers la page précédente
	//header('Location:404.php');
}
?>

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
			<div class="col-md-12 text-center">
				<?php include "$includes/admin_moderer_articles.php"; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php include "$includes/admin_ajouter.php"; ?>
			</div>
			<div class="col-md-6">
				<?php include "$includes/admin_supprimer.php"; ?>
			</div>
		</div>
	</div>
	<?php include "$includes/background.php"; ?>

</body>
<?php include "$includes/scripts.php"; ?>
</html>