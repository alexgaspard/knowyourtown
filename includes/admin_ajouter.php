<?php
// Connexion à la base de données
include_once "$includes/connect2DB.php";
if (isAdmin($bdd))
{
	if (!empty($_POST['nom_pays']) and !empty($_POST['code_pays']))
	{
		$nom_pays = htmlspecialchars($_POST['nom_pays']);
		$code_pays = htmlspecialchars($_POST['code_pays']);

		$req = $bdd->prepare("INSERT INTO pays(nom, code) VALUES(:nom, :code)");
		$req->execute(array(
			'nom' => $nom_pays,
			'code' => $code_pays
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			Le pays <?php echo $nom_pays.' ('.$code_pays.')'; ?> a été ajouté.
		</div>
<?php
	}
	if (!empty($_POST['nom_universite']) and !empty($_POST['ville_universite']) and !empty($_POST['pays_universite']))
	{
		$nom_universite = htmlspecialchars($_POST['nom_universite']);
		$ville_universite = htmlspecialchars($_POST['ville_universite']);
		$pays_universite = htmlspecialchars($_POST['pays_universite']);

		$req = $bdd->prepare("INSERT INTO universites(nom, ville, id_pays) VALUES(:nom, :ville, :id_pays)");
		$req->execute(array(
			'nom' => $nom_universite,
			'ville' => $ville_universite,
			'id_pays' => $pays_universite
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			L'université <?php echo $nom_universite.' ('.$ville_universite.')'; ?> a été ajoutée.
		</div>
<?php
	}
	if (!empty($_POST['nom_categorie']))
	{
		$nom_categorie = htmlspecialchars($_POST['nom_categorie']);

		$req = $bdd->prepare("INSERT INTO categories(nom) VALUES(:nom)");
		$req->execute(array(
			'nom' => $nom_categorie
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			La catégorie <?php echo $nom_categorie; ?> a été ajoutée.
		</div>
<?php
	}
	if (!empty($_POST['new_admin']))
	{
		$new_admin = htmlspecialchars($_POST['new_admin']);

		$req = $bdd->prepare("UPDATE users SET admin = 1 WHERE id = :new_admin");
		$req->execute(array(
			'new_admin' => $new_admin
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			L'utilisateur n°<?php echo $new_admin; ?> est maintenant admin.
		</div>
<?php
	}
?>
	<h3>
		Ajouter un pays
		<a href="http://fr.wikipedia.org/wiki/ISO_3166-1#Table_de_codage"><span class="glyphicon glyphicon-list-alt"></span></a>
	</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<div class="form-group">
			<input type="text" name="nom_pays" class="form-control" placeholder="Nom" />
		</div>
		<div class="form-group">
			<input type="text" name="code_pays" class="form-control" placeholder="Code" />
		</div>
		<button type="submit" class="btn btn-primary">Ajouter</button>
	</form>

	<h3>Ajouter une université</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
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
		<button type="submit" class="btn btn-primary">Ajouter</button>
	</form>

	<h3>Ajouter une catégorie</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<div class="form-group">
			<input type="text" name="nom_categorie" class="form-control" placeholder="Nom" />
		</div>
		<button type="submit" class="btn btn-primary">Ajouter</button>
	</form>

	<h3>Ajouter un admin</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<select multiple name="new_admin" class="form-control">
<?php
			$req = $bdd->prepare("SELECT * FROM users WHERE actif = 1 AND admin = 0 ORDER BY mail ASC");	
			$req->execute();							
			while ($donnees = $req->fetch())
			{
				$id_user = htmlspecialchars($donnees['id']);
				$mail = htmlspecialchars($donnees['mail']);
?>
				<option value="<?php echo $id_user; ?>" ><?php echo $mail; ?></option>
<?php
			}
			$req->closeCursor();
?>
		</select>
		<button type="submit" class="btn btn-primary">Ajouter</button>
	</form>
<?php
}
?>