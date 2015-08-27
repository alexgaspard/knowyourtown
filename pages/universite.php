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
	<div class="col-md-6">
		<div class="well">
<?php
			include_once "$includes/connect2DB.php";

			if (!empty($_POST['recherche'])) 
			{
				$recherche = strtolower(strip_tags($_POST['recherche']));
				if (isAdmin($bdd))
				{
					$req = $bdd->prepare("SELECT DISTINCT C.* FROM categories C INNER JOIN articles A ON A.id_categorie = C.id INNER JOIN universites U ON A.id_universite = U.id WHERE U.id=:id_universite AND LOWER(C.nom) LIKE :recherche");
				} else
				{
					$req = $bdd->prepare("SELECT DISTINCT C.* FROM categories C INNER JOIN articles A ON A.id_categorie = C.id INNER JOIN universites U ON A.id_universite = U.id WHERE U.id=:id_universite AND LOWER(C.nom) LIKE :recherche AND A.approuve=1");
				}
				$req->execute(array(
					'id_universite' => $id_universite,
					'recherche' => $recherche.'%'
					));
?>
				<h3>Résultats de la recherche :</h3>
<?php
			} else if (isAdmin($bdd))
			{
				//$req = $bdd->query("SELECT * FROM categories");	
				$req = $bdd->prepare("SELECT DISTINCT C.* FROM categories C INNER JOIN articles A ON A.id_categorie = C.id INNER JOIN universites U ON A.id_universite = U.id WHERE U.id=:id_universite");
				$req->execute(array(
					'id_universite' => $id_universite
					));
			} else
			{
				//$req = $bdd->query("SELECT * FROM categories");	
				$req = $bdd->prepare("SELECT DISTINCT C.* FROM categories C INNER JOIN articles A ON A.id_categorie = C.id INNER JOIN universites U ON A.id_universite = U.id WHERE U.id=:id_universite AND A.approuve=1");
				$req->execute(array(
					'id_universite' => $id_universite
					));
			}
				
			while ($donnees = $req->fetch())
			{
				$id_categorie = strip_tags($donnees['id']);
				$nom_categorie = strip_tags($donnees['nom']);
?>
				<a href="categorie.php?id_universite=<?php echo $id_universite; ?>&id_categorie=<?php echo $id_categorie; ?>"><?php echo $nom_categorie; ?></a><br>
<?php
			}
			$req->closeCursor();
?>
		</div>	
	</div>
	<div class="col-md-6">
		<?php include "$includes/carte.php"; ?>
	</div>	
</div>