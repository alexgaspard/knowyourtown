<?php include "includes/paths.php" ?>
<?php include "$includes/variables.php" ?>
<?php date_default_timezone_set('Europe/Paris'); ?>
<?php include "$includes/fonctions.php" ?>

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
	<div class="container-fluid text-center">		
		<div class="row">
			<div class="col-md-5 col-md-offset-3">
				<img class="image img-responsive" src="img/404dead-link.png" alt="dead_link">
			</div>
		</div>		

		<div class="row-fluid">
			<div class="col-md-12">
				<h3>Erreur 404</h3>
			</div>
		</div>

		<div class="row-fluid">
			<div class="col-md-12">
				<div class="hero-unit">
					<h2 class="lead">
						La page que vous avez demandée n'existe pas.
					</h2>
				</div>
				<p style="text-align:center; color:white;">Vous avez peut être entré une adresse qui n'existait pas, ou alors nous avons fait une légère erreur dans nos redirections...</p> 
				<h4><a href="index.php">En attendant, vous pouvez retourner à l'accueil en cliquant ici</a>.</h4>	
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php include "$includes/footer.php"; ?>
			</div>
		</div>	
	</div>
	<?php include "$includes/background.php"; ?>

</body>
<?php include "$includes/scripts.php"; ?>
</html>