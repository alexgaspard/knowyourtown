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
	<div class="container-fluid">		
		<?php include "$pages/universite.php"; ?>

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