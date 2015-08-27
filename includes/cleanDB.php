<?php
 
// Connexion à la base de données
include_once "$includes/connect2DB.php";

if (isAdmin($bdd))
{
	$users_supprimes = array();

	$date_hier=date("Y-m-d H:i:s", time() - 3600*24);
	$req = $bdd->prepare("SELECT * FROM users WHERE actif = 0 AND derniere_connexion <= :date_hier");
	$req->execute(array(
		'date_hier' => $date_hier
		));									
	while ($donnees = $req->fetch())
	{
	    $actif = $donnees['actif']; // $actif contiendra alors 0 ou 1
		$users_supprimes[] = $donnees['mail'].' supprimé (dernière connexion : '.$donnees['derniere_connexion'].')<br>';
	}
	$req->closeCursor();

	// On supprime les inactifs de plus d'un jour
	$req = $bdd->prepare("DELETE FROM users WHERE actif = 0 AND derniere_connexion <= :date_hier");
	$req->execute(array(
		'date_hier' => $date_hier
		));

	if (!empty($users_supprimes))
	{
?>
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Utilisateurs supprimés</strong><br>
<?php
			foreach ($users_supprimes as $key => $value) 
			{
				echo $value;
			}
?>	
		</div>
<?php
	}
}
?>