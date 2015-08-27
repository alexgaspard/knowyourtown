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
			<!--<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Le site est encore en cours de développement mais la plupart des fonctionnalités sont en place, vous pouvez d'ores et déjà consulter et ajouter des articles.<br>
				Si vous repérez des bugs ou si vous avez la moindre suggestion sur l'ergonomie ou le design du site, n'hésitez pas à m'en faire part. <a href="mailto:alexandre.gaspard@telecom-bretagne.eu"><span class="glyphicon glyphicon-envelope"></span></a><br>
				Le site est aussi intuitif que possible, mais vous pouvez regarder <a href="https://www.youtube.com/watch?v=aNMeFxGOAsg">ce tuto</a> si vous êtes perdu.<br>
			</div>-->
		</div>
	</div>
	<div class="container-fluid">
		<?php include "$pages/accueil.php"; ?>

		<?php include "$includes/footer.php"; ?>
	</div>
	<?php include "$includes/background.php"; ?>

</body>
<?php //include "$includes/scripts.php"; ?>
</html>