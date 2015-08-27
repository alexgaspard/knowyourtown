<div class="row-fluid">
	<div class="col-md-10">
		<?php include "$includes/search.php"; ?>
	</div>	
	<div class="col-md-2 text-right">
		<?php include "$includes/bouton_contribuer.php"; ?>
	</div>	
</div>

<span style="margin:10px"></span>

<?php
	include_once "$includes/connect2DB.php";

	if (!empty($_POST['recherche'])) 
	{
		function stripAccents($string){
			return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
		}

		function strtohigherAccents($string){
			return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿ', 'ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ');
		}

		$recherche = strtolower(strtohigherAccents(htmlspecialchars($_POST['recherche'])));
		$req = $bdd->prepare("SELECT * FROM pays WHERE LOWER(nom) LIKE :recherche ORDER BY nom ASC");
		$req->execute(array(
			'recherche' => $recherche.'%'
			));
?>
		<div class="row-fluid">
			<div class="col-md-12">
				<div class="well">
					<h3>Résultats de la recherche :</h3>
<?php							
					while ($donnees = $req->fetch())
					{
						$id_pays = strip_tags($donnees['id']);
						$nom_pays = strip_tags($donnees['nom']);
?>
						<a href="pays.php?id_pays=<?php echo $id_pays; ?>"><?php echo $nom_pays; ?></a><br>
<?php
					}
					$req->closeCursor();
?>
				</div>		
			</div>
		</div>
<?php
	}
?>

<div class="row">
	<div class="col-md-12">	
<?php
		include_once "$includes/carte_monde.php";
?>	
	</div>
</div>