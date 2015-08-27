<?php
// Connexion à la base de données
include_once "$includes/connect2DB.php";
if (isAdmin($bdd))
{
	if (!empty($_POST['old_pays']))
	{
		$old_pays = htmlspecialchars($_POST['old_pays']);

		$req = $bdd->prepare("DELETE FROM pays WHERE id = :old_pays");
		$req->execute(array(
			'old_pays' => $old_pays
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			Le pays n°<?php echo $old_pays; ?> a été supprimé.
		</div>
<?php
	}
	if (!empty($_POST['old_universite']))
	{
		$old_universite = htmlspecialchars($_POST['old_universite']);

		$req = $bdd->prepare("DELETE FROM universites WHERE id = :old_universite");
		$req->execute(array(
			'old_universite' => $old_universite
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			L'université n°<?php echo $old_universite; ?> a été supprimée.
		</div>
<?php
	}
	if (!empty($_POST['old_categorie']))
	{
		$old_categorie = htmlspecialchars($_POST['old_categorie']);

		$req = $bdd->prepare("DELETE FROM categories WHERE id = :old_categorie");
		$req->execute(array(
			'old_categorie' => $old_categorie
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			La catégorie n°<?php echo $old_categorie; ?> a été supprimée.
		</div>
<?php
	}
	if (!empty($_POST['old_admin']))
	{
		$old_admin = htmlspecialchars($_POST['old_admin']);

		$req = $bdd->prepare("UPDATE users SET admin = 0 WHERE id = :old_admin");
		$req->execute(array(
			'old_admin' => $old_admin
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			L'utilisateur n°<?php echo $old_admin; ?> n'est plus admin.
		</div>
<?php
	}
	if (!empty($_POST['old_user']))
	{
		$old_user = htmlspecialchars($_POST['old_user']);

		$req = $bdd->prepare("DELETE FROM users WHERE id = :old_user");
		$req->execute(array(
			'old_user' => $old_user
			));
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			L'utilisateur n°<?php echo $old_user; ?> a été supprimé.
		</div>
<?php
	}
?>
	<h3>Supprimer un pays</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<div class="form-group">
			<select multiple name="old_pays" class="form-control">
<?php
				$req = $bdd->prepare("SELECT * FROM pays ORDER BY nom ASC");
				$req->execute();								
				while ($donnees = $req->fetch())
				{
					$id_old_pays = htmlspecialchars($donnees['id']);
					$nom_old_pays = htmlspecialchars($donnees['nom']);
?>
					<option value="<?php echo $id_old_pays; ?>" ><?php echo $nom_old_pays; ?></option>
<?php
				}
				$req->closeCursor();
?>
			</select>
		</div>
		<button type="submit" class="btn btn-danger">Supprimer</button>
	</form>

	<h3>Supprimer une université</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<div class="form-group">
			<select multiple name="old_universite" class="form-control">
<?php
				$req = $bdd->prepare("SELECT * FROM universites ORDER BY nom ASC");	
				$req->execute();							
				while ($donnees = $req->fetch())
				{
					$id_old_universite = htmlspecialchars($donnees['id']);
					$nom_old_universite = htmlspecialchars($donnees['nom']);
?>
					<option value="<?php echo $id_old_universite; ?>" ><?php echo $nom_old_universite; ?></option>
<?php
				}
				$req->closeCursor();
?>
			</select>
		</div>
		<button type="submit" class="btn btn-danger">Supprimer</button>
	</form>

	<h3>Supprimer une catégorie</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<div class="form-group">
			<select multiple name="old_categorie" class="form-control">
<?php
				$req = $bdd->prepare("SELECT * FROM categories ORDER BY nom ASC");	
				$req->execute();							
				while ($donnees = $req->fetch())
				{
					$id_old_categorie = htmlspecialchars($donnees['id']);
					$nom_old_categorie = htmlspecialchars($donnees['nom']);
?>
					<option value="<?php echo $id_old_categorie; ?>" ><?php echo $nom_old_categorie; ?></option>
<?php
				}
				$req->closeCursor();
?>
			</select>
		</div>
		<button type="submit" class="btn btn-danger">Supprimer</button>
	</form>

	<h3>Rétrograder un admin</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<select multiple name="old_admin" class="form-control">
<?php
			$req = $bdd->prepare("SELECT * FROM users WHERE actif = 1 AND admin = 1 ORDER BY mail ASC");
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
		<button type="submit" class="btn btn-warning">Rétrograder</button>
	</form>

	<h3>Supprimer un utilisateur</h3>
	<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
		<select multiple name="old_user" class="form-control">
<?php
			$req = $bdd->prepare("SELECT * FROM users WHERE actif = 1 ORDER BY mail ASC");	
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
		<button type="submit" class="btn btn-danger">Supprimer</button>
	</form>
<?php
}
?>