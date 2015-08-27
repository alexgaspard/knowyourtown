
<!--
<div class="row-fluid test1">
	<div class="col-md-12">
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo" onclick="p()">
		 	simple collapsible
		</button>

		<div id="demo" class="collapse">
			<canvas id="c"></canvas>
		</div>
	</div>
</div>-->
<div class="row-fluid">
	<div class="col-md-10">
		<?php include "$includes/search.php"; ?>
	</div>	
	<div class="col-md-2 text-right">
		<?php include "$includes/bouton_contribuer.php"; ?>
	</div>	
</div>

<span style="margin:10px"></span>


<div class="row-fluid">
	<div class="col-md-12">
		<div class="well">
<?php
			include_once "$includes/connect2DB.php";

			if (!empty($_POST['recherche'])) 
			{
				$recherche = strtolower(htmlspecialchars($_POST['recherche']));
				$req = $bdd->prepare("SELECT DISTINCT U.*, P.nom'nom_pays' FROM universites U INNER JOIN pays P ON U.id_pays = P.id WHERE P.id=:id_pays AND LOWER(U.nom) LIKE :recherche");
				$req->execute(array(
					'id_pays' => $id_pays,
					'recherche' => $recherche.'%'					
					));	
?>
				<h3>Résultats de la recherche :</h3>
<?php
			} else
			{
				$req = $bdd->prepare("SELECT DISTINCT U.*, P.nom'nom_pays' FROM universites U INNER JOIN pays P ON U.id_pays = P.id WHERE P.id=:id_pays");	
				$req->execute(array(
					'id_pays' => $id_pays
					));
			}
							
			while ($donnees = $req->fetch())
			{
				$id_universite = htmlspecialchars($donnees['id']);
				$nom_universite = htmlspecialchars($donnees['nom']);
				$ville_universite = htmlspecialchars($donnees['ville']);
				$nom_pays = htmlspecialchars($donnees['nom_pays']);
?>
				<a href="universite.php?id_universite=<?php echo $id_universite; ?>"><?php echo $nom_universite; ?></a><br>
<?php
			}
			$req->closeCursor();
?>
		</div>		
	</div>
</div>