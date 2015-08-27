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
				if (isAdmin($bdd))
				{
					$req = $bdd->prepare("SELECT DISTINCT A.* FROM articles A LEFT JOIN tags T ON A.id = T.id_article WHERE A.id_universite=:id_universite AND A.id_categorie=:id_categorie AND ((LOWER(A.titre) LIKE :recherche) OR (LOWER(T.tag) LIKE :recherche)) ORDER BY A.date_modification DESC");
				} else
				{
					$req = $bdd->prepare("SELECT DISTINCT A.* FROM articles A LEFT JOIN tags T ON A.id = T.id_article WHERE A.id_universite=:id_universite AND A.id_categorie=:id_categorie AND ((LOWER(A.titre) LIKE :recherche) OR (LOWER(T.tag) LIKE :recherche)) AND approuve=1 ORDER BY A.date_modification DESC");
				}
				$req->execute(array(
					'id_universite' => $id_universite,
					'id_categorie' => $id_categorie,
					'recherche' => $recherche.'%'
					));
?>
				<h3>Résultats de la recherche :</h3>
<?php
			} else if (isAdmin($bdd))
			{
				$req = $bdd->prepare("SELECT DISTINCT * FROM articles WHERE id_universite=:id_universite AND id_categorie=:id_categorie ORDER BY date_modification DESC");	
				$req->execute(array(
					'id_universite' => $id_universite,
					'id_categorie' => $id_categorie
					));
			} else
			{
				$req = $bdd->prepare("SELECT DISTINCT * FROM articles WHERE id_universite=:id_universite AND id_categorie=:id_categorie AND approuve=1 ORDER BY date_modification DESC");
				$req->execute(array(
					'id_universite' => $id_universite,
					'id_categorie' => $id_categorie
					));	
			}
							
			while ($donnees = $req->fetch())
			{
				$id_article = htmlspecialchars($donnees['id']);
				$titre = htmlspecialchars($donnees['titre']);
				$date_modification = htmlspecialchars($donnees['date_modification']);
				$color='';
				if (htmlspecialchars($donnees['approuve'])==0) {
					$color='class="text-danger"';
				}
?>
				<a href="article.php?id_article=<?php echo $id_article; ?>" <?php echo $color; ?>><?php echo '<strong>'.$titre.'</strong> - le '.date('d-m-Y', strtotime($date_modification)); ?></a><br>
<?php
			}
			$req->closeCursor();
?>
		</div>		
	</div>
</div>