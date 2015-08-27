<div class="row-fluid">
	<div class="col-md-12">
<?php
		include_once "$includes/connect2DB.php";

		if (isConnected($bdd))
		{

			// On récupère les variables d'édition
			$titre_edite = '';
			$contenu_edite = '';
			$id_universite_edite = '';
			$id_categorie_edite = '';
			if (!empty($_POST['id_article_edite'])) 
			{

				$id_article_edite = htmlspecialchars($_POST['id_article_edite']);
				$req = $bdd->prepare("SELECT * FROM articles WHERE id=:id_article_edite");
				$req->execute(array(
					'id_article_edite' => $id_article_edite
					));
								
				while ($donnees = $req->fetch())
				{
					$titre_edite = 'value="'.htmlspecialchars($donnees['titre']).'"';
					$contenu_edite = htmlspecialchars($donnees['contenu']);
					$id_universite_edite = htmlspecialchars($donnees['id_universite']);
					$id_categorie_edite = htmlspecialchars($donnees['id_categorie']);
					$dernier_redacteur_edite = htmlspecialchars($donnees['dernier_redacteur']);

					// On convertit les caractères spéciaux
					$search_special_characters = array('&amp;');
					$replace_special_characters = array('&');
					$contenu_edite = str_replace($search_special_characters, $replace_special_characters, $contenu_edite);
				}
				$req->closeCursor();
			}
?>
			<form action="ajouter_article.php" method="post" enctype="multipart/form-data" role="form">
				<div class="form-group">
					<label for="titre">Titre</label>
					<input type="text" name="titre" class="form-control" id="titre" placeholder="Titre" <?php echo $titre_edite; ?>/>
				</div>

				<div class="form-group">
					<label for="text_editor">Article</label>
					<?php include "$includes/text_editor.php"; ?>
					<p class="help-block">Vous pouvez utiliser des balises <a href="http://forums.phpbb-fr.com/faq.php?mode=bbcode">BBCode</a> pour mettre en forme votre article.</p>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div id="images_upload"></div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
						<div class="row-fluid">
							<div class="col-md-6">
								<label for="select_universite"><span class="glyphicon glyphicon-globe"></span> Université</label>
								<select name="universite" class="form-control" id="select_universite">
		<?php
								if (!empty($_GET['id_universite']))
								{
									$req = $bdd->prepare("SELECT * FROM universites WHERE id=:id_universite");
									$req->execute(array(
										'id_universite' => $id_universite
										));
								} else if (!empty($_GET['id_pays']))
								{
									$req = $bdd->prepare("SELECT * FROM universites WHERE id_pays=:id_pays ORDER BY nom ASC");
									$req->execute(array(
										'id_pays' => $id_pays
										));
								} else
								{
									$req = $bdd->prepare("SELECT * FROM universites ORDER BY nom ASC");
									$req->execute();
								}						
												
								while ($donnees = $req->fetch())
								{
									$id_universite = htmlspecialchars($donnees['id']);
									$nom_universite = htmlspecialchars($donnees['nom']);
									$selected_universite = '';
									if ($id_universite == $id_universite_edite)
									{
										$selected_universite='selected';
									} else if (!empty($_GET['id_universite']))
									{
										$selected_universite='selected';
									}
		?>
									<option value="<?php echo $id_universite; ?>" <?php echo $selected_universite; ?>><?php echo $nom_universite; ?></option>
		<?php
								}
								$req->closeCursor();
		?>
								</select>
							</div>
							<div class="col-md-6">
								<label for="select_categorie"><span class="glyphicon glyphicon-th-list"></span> Catégorie</label>
								<select name="categorie" class="form-control" id="select_categorie">
		<?php
								if (!empty($_GET['id_categorie']))
								{
									$req = $bdd->prepare("SELECT * FROM categories WHERE id=:id_categorie");
									$req->execute(array(
										'id_categorie' => $id_categorie
										));
								} else
								{
									$req = $bdd->prepare("SELECT * FROM categories ORDER BY nom ASC");
									$req->execute();
								}
								
											
								while ($donnees = $req->fetch())
								{
									$id_categorie = htmlspecialchars($donnees['id']);
									$nom_categorie = htmlspecialchars($donnees['nom']);
									$selected_categorie = '';
									if ($id_categorie == $id_categorie_edite)
									{
										$selected_categorie='selected';
									} else if (!empty($_GET['id_categorie']))
									{
										$selected_categorie='selected';
									}
		?>
									<option value="<?php echo $id_categorie; ?>" <?php echo $selected_categorie; ?>><?php echo $nom_categorie; ?></option>
		<?php
								}
								$req->closeCursor();
		?>
								</select>
							</div>
		<?php
							if (isset($id_article_edite))
							{
		?>
								<input type="hidden" name="id_article_edite" value="<?php echo $id_article_edite; ?>"/>
		<?php
							}
		?>
						</div>



						<div class="row-fluid">
							<div class="col-md-6">
								<div class="panel-group" id="accordion_universite">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion_universite" href="#collapse_universite">
													Ajouter une université
												</a>
											</h4>
										</div>
										<div id="collapse_universite" class="panel-collapse collapse">
											<div class="panel-body">

												<div class="form-group">
													<input type="text" name="nom_universite" class="form-control" placeholder="Nom" />
												</div>
												<div class="form-group">
													<input type="text" name="ville_universite" class="form-control" placeholder="Ville" />
												</div>
												<div class="form-group">
													<select multiple name="pays_universite" class="form-control">
										<?php
														$req = $bdd->prepare("SELECT * FROM pays ORDER BY nom ASC");
														$req->execute();								
														while ($donnees = $req->fetch())
														{
															$id_new_pays = htmlspecialchars($donnees['id']);
															$nom_new_pays = htmlspecialchars($donnees['nom']);
										?>
															<option value="<?php echo $id_new_pays; ?>" ><?php echo $nom_new_pays; ?></option>
										<?php
														}
														$req->closeCursor();
										?>
													</select>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel-group" id="accordion_categorie">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion_categorie" href="#collapse_categorie">
													Ajouter une catégorie
												</a>
											</h4>
										</div>
										<div id="collapse_categorie" class="panel-collapse collapse">
											<div class="panel-body">
												
												<div class="form-group">
													<input type="text" name="nom_categorie" class="form-control" placeholder="Nom" />
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row-fluid">
							<div class="col-md-12">
								<div class="form-group">
									<label for="tags">Tags</label>
									<textarea onkeyup="previewTags(this, 'previewTags');" onselect="previewTags(this, 'previewTags');" id="tags" name="tags" rows="1" class="form-control" placeholder="Tags"><?php
										if (!empty($_POST['id_article_edite'])) 
										{

											$id_article_edite = htmlspecialchars($_POST['id_article_edite']);
											$req = $bdd->prepare("SELECT * FROM tags WHERE id_article=:id_article_edite");
											$req->execute(array(
												'id_article_edite' => $id_article_edite
												));
																
											while ($donnees = $req->fetch())
											{
												$tag = htmlspecialchars($donnees['tag']);
												echo $tag.',';
											}
											$req->closeCursor();
										}
									?></textarea>
								</div>
								<div id="previewTags"></div>
							</div>
						</div>

						<script type="text/javascript">
						    function previewTags(textareaId, previewDiv) {
						        var field = textareaId.value;
						        if (field) {

						            field = field.replace(/&/g, '&amp;');
						            field = field.replace(/</g, '&lt;').replace(/>/g, '&gt;');
						            field = field.replace(/\n/g, '<br />').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
						            
						            field = field.replace(/[ ]?([\s\S]*?)[,;]/g, '<span class="tags label label-default">$1</span>');
						            
						            document.getElementById(previewDiv).innerHTML = field;
						        }
						    }
						</script>

						<div class="row-fluid" style="padding-top: 10px;">
							<div class="col-md-3 col-md-offset-7">
<?php					
								if (!empty($_POST['id_article_edite']) and isAdmin($bdd)) 
								{
?>
									<div class="checkbox">
	    								<label>
											<input type="checkbox" name="keep_author" value="<?php echo $dernier_redacteur_edite; ?>" checked> Laisser l'auteur d'origine
										</label>
									</div>
<?php					
								}
?>
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary">Envoyer</button>
							</div>
						</div>
					</form>
				</div>
			
				<div class="col-md-4">
					<div class="row-fluid">
						<div class="col-md-12">
							<form action="<?php echo $includes.'/ajouter_image.php'; ?>" method="post" enctype="multipart/form-data" role="form" id="form_image_article">				
								<div class="form-group">
									<label for="image_article">Ajouter une image</label>
									<input type="file" name="image_article" id="image_article"/>
									<p class="help-block">Le poids de l'image ne doit pas dépasser 10 Mo.</p>
									<button type="submit" class="btn btn-default" id="envoyer_image">Envoyer l'image</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
					
			<script type="text/javascript">
				var fileInput = document.getElementById('image_article'),
			    progress = document.getElementById('progress');

			    var form = document.getElementById('form_image_article');
				form.onsubmit = function() {
					var formData = new FormData(form);

					document.getElementById('envoyer_image').innerHTML = "<img src=\"img/loading_icon.gif\" width=\"100px\" />";

					// On ajoute un input pour être sûr qu'on utilise la fonction javascript lorsque on sauvegarde l'image
					formData.append('script', 1);

					var xhr = new XMLHttpRequest();

					xhr.onreadystatechange = function() {
				        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			                var answer = xhr.responseText; // Données textuelles récupérées
			                if (answer == "unset") {
			                	alert("L'image n'est pas valide, peut-être que le chemin de l'image contient des espaces.");
			                } else if (answer == "size") {
			                	alert("L'image est trop lourde.");
			                } else if (answer == "extension") {
			                	alert("Seules les images au format jpg/jpeg et png sont acceptées.");
			                } else {
			                	var img_id = answer.match(/([^id=].*),/)[1];
			                	if (!isNaN(parseInt(img_id))) {

				                	var img_id = parseInt(img_id);			                	
				                	var img_path = "img/img_articles/img_"+img_id+"."+answer.match(/ext=(.*)/)[1];
				        			document.getElementById('images_upload').innerHTML = "<img class=\"img-thumbnail\" width=\"100px\" src=\""+img_path+"\"  onclick=\"insertTag('[image]"+img_path+"','[/image]','textarea');\"/>";
				        			insertTag('[image]'+img_path,'[/image]','textarea');
				        		}
				        	}
				        	document.getElementById('envoyer_image').innerHTML = "Envoyer l'image";
				        }
					};

					xhr.open('POST', form.getAttribute('action'), true);
					xhr.send(formData);
					return false; // To avoid actual submission of the form
				}
			</script>
<?php
		} else
		{
?>
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Vous devez être connecté pour pouvoir ajouter des articles.<br>
			</div>
<?php
			include_once "$pages/connexion.php";
		} 
?>
	</div>	
</div>