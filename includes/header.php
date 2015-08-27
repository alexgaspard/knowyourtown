<!--<header data-spy="affix" data-offset-top="60" data-offset-bottom="50">
	<ul class="nav nav-tabs">
		<li><a href="#actualites" data-toggle="tab">Accueil</a></li>
		<li><a href="#liste" data-toggle="tab">La liste</a></li>
		<li><a href="#allos" data-toggle="tab">Nos allooos</a></li>		
		<li><a href="#soirees" data-toggle="tab">La soirée</a></li>
		<li><a href="#handycup" data-toggle="tab">L'HandyCup</a></li>
		<li><a href="#videos" data-toggle="tab">Vidéos</a></li>
		<li><a href="#partenaires" data-toggle="tab">Nos partenaires</a></li>
	</ul>-->
<header>
	<div class="row">
		<a href="index.php">
			<div class="col-md-1">
				<img class="img-responsive" src="img/logo.png" alt="logo">
			</div>
			<div class="col-md-3 banner-title">
				<h2><strong>Know</strong> Your <strong>Town</strong></h2>
			</div>
		</a>

		<div class="col-md-5 col-md-offset-3 text-right">
<?php
			include_once "$includes/connect2DB.php";
			if (isConnected($bdd))
			{
				$mail_user = $_SESSION['mail'];
				if (isAdmin($bdd)) 
				{
					$mail_user = '<strong>'.$mail_user.'</strong>';
				}	
?>
					<a href="sign.php"><?php echo $mail_user; ?></a> 
					<a href="<?php echo $includes.'/deconnexion.php'; ?>" data-toggle="tooltip" data-placement="bottom" id="deconnexion" title="Déconnexion"><span class="glyphicon glyphicon-off"></span></a>
			
<?php
				if (isAdmin($bdd)) 
				{
?>
					<br><a href="admin.php" class="btn btn-info">Admin</a>
<?php
				}
?>
<?php
			} else
			{
?>
				<a href="sign.php">Se connecter</a>
<?php	
			}
?>
		</div>
	</div>

	<?php include "$includes/get_url.php"; ?>
	<?php include "$includes/breadcrumb.php"; ?>
	<?php include "$includes/cleanDB.php"; ?>
</header>