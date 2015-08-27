<div class="row-fluid">
	<div class="col-md-12">
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							Lecture rapide
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
					<div class="panel-body">
						<div class='row-fluid'>
							<div class='col-md-2'>		
								<button class='btn btn-default' onclick=p()>Démarrer</button>
							</div>
							<div class='col-md-4 col-md-offset-2'>					
								<canvas id="c"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
			include_once "$includes/connect2DB.php";

			if (!empty($_POST['recherche'])) 
			{
				$recherche = strtolower(htmlspecialchars($_POST['recherche']));
				$req = $bdd->prepare("SELECT A.*, U.mail FROM articles A LEFT JOIN users U ON A.dernier_redacteur = U.id WHERE A.id_universite=:id_universite AND A.id_categorie=:id_categorie AND LOWER(A.titre) LIKE :recherche");
				$req->execute(array(
					'id_universite' => $id_universite,
					'id_categorie' => $id_categorie,
					'recherche' => $recherche.'%'
					));
?>
				<h3>Résultats de la recherche :</h3>
<?php
			} else
			{
				$req = $bdd->prepare("SELECT A.*, U.mail FROM articles A LEFT JOIN users U ON A.dernier_redacteur = U.id WHERE A.id=:id_article");
				$req->execute(array(
					'id_article' => $id_article
					));
			}
							
			while ($donnees = $req->fetch())
			{
				$id_article = htmlspecialchars($donnees['id']);
				$titre = htmlspecialchars($donnees['titre']);
				$contenu = htmlspecialchars($donnees['contenu']);
				$date_modification = htmlspecialchars($donnees['date_modification']);
				$dernier_redacteur = htmlspecialchars($donnees['dernier_redacteur']);
				$mail_dernier_redacteur = htmlspecialchars($donnees['mail']);
				$approuve = htmlspecialchars($donnees['approuve']);
				$id_article_edite = htmlspecialchars($donnees['id_article_edite']);

				//$contenu = str_replace("\n", "<br />", $contenu); // Pour garder les sauts à la ligne
				$contenu = nl2br($contenu); // Pour garder les sauts à la ligne				 
			}
			$req->closeCursor();
?>
			<div class="row-fluid">
				<div class="col-md-12">
					<div class="jumbotron">
						<div id="i">
							<div class="page-header">
								<h1><?php echo $titre; ?></h1>
							</div>
							
							<p id="article_contenu">
								<?php echo $contenu; ?>
							</p>
						</div>
						<script type="text/javascript">
							window.onload = function(){previewArticle('article_contenu', 'article_contenu')};
						</script>

						<div class="row" style="padding-top:10px;"> 
							<div class="col-md-12 text-right">
								- <a href="mailto:<?php echo $mail_dernier_redacteur; ?>"><?php echo $mail_dernier_redacteur; ?></a> le <?php echo date('d-m-Y', strtotime($date_modification)).' à '.date('H:i:s', strtotime($date_modification)); ?>.
							</div>
						</div>

						<div class="row-fluid"> 
							<div class="col-md-1">
					  			<form action="contribuer.php" method="post" enctype="multipart/form-data" role="form">
									<input type="hidden" name="id_article_edite" value="<?php echo $id_article; ?>"/>
									<button type="submit" class="btn btn-primary btn-lg" role="button">Editer</button>
								</form>
							</div>
<?php
							if (isAdmin($bdd)) 
							{
								if ($approuve==0)
								{
?>									
									<div class="col-md-1">
										<form action="<?php echo $includes.'/validation_article.php' ?>" method="post" enctype="multipart/form-data" role="form">
											<input type="hidden" name="id_article" value="<?php echo $id_article; ?>"/>
											<button type="submit" class="btn btn-success btn-lg">Valider</button>
										</form>
									</div>
<?php										
								}	
?>									
								<div class="col-md-2">
									<form action="<?php echo $includes.'/supprimer_article.php' ?>" method="post" enctype="multipart/form-data" role="form">
										<input type="hidden" name="id_article" value="<?php echo $id_article; ?>"/>
										<button type="submit" class="btn btn-danger btn-lg">Supprimer</button>
									</form>
								</div>
<?php	
								if (!empty($id_article_edite)) 
								{
?>									
									<div class="col-md-2">
										<a href="article.php?id_article=<?php echo $id_article_edite; ?>" class="btn btn-info btn-lg">Source</a>
									</div>
<?php								
								}
							}
?>
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="col-md-12">
<?php
					$req = $bdd->prepare("SELECT * FROM tags WHERE id_article=:id_article");
					$req->execute(array(
						'id_article' => $id_article
						));
									
					while ($donnees = $req->fetch())
					{
						$tag = htmlspecialchars($donnees['tag']);
?>
						<span class="tags label label-default"><?php echo $tag; ?></span>
<?php
					}
					$req->closeCursor();
?>
				</div>
			</div>
