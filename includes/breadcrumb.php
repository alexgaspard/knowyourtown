<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<?php
				include_once "$includes/connect2DB.php";

				if (!empty($id_pays))  // Page Pays
				{
					if (!is_numeric($id_pays)) 
					{
						$req = $bdd->prepare("SELECT * FROM pays WHERE code = :id_pays");
						//$id_pays=0; // Pour au moins ne pas avoir de message d'erreur
					} else
					{
						$req = $bdd->prepare("SELECT * FROM pays WHERE id = :id_pays");
					}
					
					$req->execute(array(
						'id_pays' => $id_pays
						));
					while ($donnees = $req->fetch())
					{
						$id_pays = htmlspecialchars($donnees['id']);
						$nom_pays = htmlspecialchars($donnees['nom']);
					}
					$req->closeCursor();
			?>
					<li class='active'><?php echo "$nom_pays"; ?></li>
		  	<?php
				} else if (!empty($id_universite) and empty($id_categorie)) // Page Universite
				{
					$req = $bdd->prepare("SELECT U.*, P.id'id_pays', P.nom'nom_pays' FROM universites U INNER JOIN pays P ON U.id_pays = P.id WHERE U.id=:id_universite");			
					$req->execute(array(
						'id_universite' => $id_universite
						));
					while ($donnees = $req->fetch())
					{
						$nom_universite = htmlspecialchars($donnees['nom']);
						$id_pays = htmlspecialchars($donnees['id_pays']);
						$nom_pays = htmlspecialchars($donnees['nom_pays']);
					}
					$req->closeCursor();
			?>
					<li><a <?php echo "href='pays.php?id_pays=$id_pays'"; ?>><?php echo "$nom_pays"; ?></a></li>
					<li class='active'><?php echo "$nom_universite"; ?></li>
		  	<?php					
				} else if (!empty($id_categorie)) // Page Categorie
				{
					$req = $bdd->prepare("SELECT U.*, P.id'id_pays', P.nom'nom_pays' FROM universites U INNER JOIN pays P ON U.id_pays = P.id WHERE U.id=:id_universite");			
					$req->execute(array(
						'id_universite' => $id_universite
						));			
					while ($donnees = $req->fetch())
					{
						$nom_universite = htmlspecialchars($donnees['nom']);
						$id_pays = htmlspecialchars($donnees['id_pays']);
						$nom_pays = htmlspecialchars($donnees['nom_pays']);
					}
					$req->closeCursor();
					
					$req = $bdd->prepare("SELECT * FROM categories WHERE id=:id_categorie");				
					$req->execute(array(
						'id_categorie' => $id_categorie
						));
					while ($donnees = $req->fetch())
					{
						$nom_categorie = htmlspecialchars($donnees['nom']);
					}
					$req->closeCursor();
			?>
					<li><a <?php echo "href='pays.php?id_pays=$id_pays'"; ?>><?php echo "$nom_pays"; ?></a></li>
					<li><a <?php echo "href='universite.php?id_universite=$id_universite'"; ?>><?php echo "$nom_universite"; ?></a></li>
					<li class='active'><?php echo "$nom_categorie"; ?></li>
		  	<?php					
				} else if (!empty($id_article)) // Page Article
				{
					$req = $bdd->prepare("SELECT A.*, P.id'id_pays', P.nom'nom_pays', U.id'id_universite', U.nom'nom_universite', C.id'id_categorie', C.nom'nom_categorie' FROM articles A INNER JOIN categories C ON A.id_categorie = C.id INNER JOIN universites U ON A.id_universite = U.id INNER JOIN pays P ON U.id_pays = P.id WHERE A.id=:id_article");
					$req->execute(array(
						'id_article' => $id_article
						));	
					while ($donnees = $req->fetch())
					{
						$titre_article = htmlspecialchars($donnees['titre']);
						$id_categorie = htmlspecialchars($donnees['id_categorie']);
						$nom_categorie = htmlspecialchars($donnees['nom_categorie']);
						$id_universite = htmlspecialchars($donnees['id_universite']);
						$nom_universite = htmlspecialchars($donnees['nom_universite']);
						$id_pays = htmlspecialchars($donnees['id_pays']);
						$nom_pays = htmlspecialchars($donnees['nom_pays']);
					}
					$req->closeCursor();
			?>
					<li><a <?php echo "href='pays.php?id_pays=$id_pays'"; ?>><?php echo "$nom_pays"; ?></a></li>
					<li><a <?php echo "href='universite.php?id_universite=$id_universite'"; ?>><?php echo "$nom_universite"; ?></a></li>
					<li><a <?php echo "href='categorie.php?id_universite=$id_universite&id_categorie=$id_categorie'"; ?>><?php echo "$nom_categorie"; ?></a></li>
					<li class='active'><?php echo "$titre_article"; ?></li>
		  	<?php					
				}
			?>
		</ol>
	</div>
</div>