<div id="accordion">
	<div class="panel">
		<h2>
			<a data-toggle="collapse" data-parent="#accordion" href="#articles_moderes" style="color:black;">
				Articles à modérer
			</a>
		</h2>
		<div id="articles_moderes" class="panel-collapse collapse in">

			<ul class="list-group">
<?php
				include_once "$includes/connect2DB.php";

				if (isAdmin($bdd))
				{
					$req = $bdd->prepare("SELECT A.*, P.id'id_pays', P.nom'nom_pays', U.id'id_universite', U.nom'nom_universite', C.id'id_categorie', C.nom'nom_categorie' FROM articles A INNER JOIN categories C ON A.id_categorie = C.id INNER JOIN universites U ON A.id_universite = U.id INNER JOIN pays P ON U.id_pays = P.id WHERE A.approuve=0 ORDER BY date_modification ASC");	
					$req->execute();		
					while ($donnees = $req->fetch())
					{
						$id_article_modere = htmlspecialchars($donnees['id']);
						$titre_article_modere = htmlspecialchars($donnees['titre']);
						$date_modification_modere = htmlspecialchars($donnees['date_modification']);

						$id_categorie_modere = htmlspecialchars($donnees['id_categorie']);
						$nom_categorie_modere = htmlspecialchars($donnees['nom_categorie']);

						$id_universite_modere = htmlspecialchars($donnees['id_universite']);
						$nom_universite_modere = htmlspecialchars($donnees['nom_universite']);

						$id_pays_modere = htmlspecialchars($donnees['id_pays']);
						$nom_pays_modere = htmlspecialchars($donnees['nom_pays']);
?>
							<li class="list-group-item">
								<a href="<?php echo 'article.php?id_article='.$id_article_modere; ?>" class="text-warning">
									<strong>
											<?php echo $titre_article_modere; ?>
									</strong>
									<?php echo ' - le '.date('d-m-Y', strtotime($date_modification_modere)).' à '.date('H:i:s', strtotime($date_modification_modere)); ?>
								</a>
							</li>
<?php
					}
					$req->closeCursor();
				}
?>
			</ul>

		</div>
	</div>
</div>