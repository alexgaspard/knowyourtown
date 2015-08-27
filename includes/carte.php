<?php
	include_once "$includes/connect2DB.php";
	$req = $bdd->prepare("SELECT U.*, P.nom'nom_pays' FROM universites U INNER JOIN pays P ON U.id_pays = P.id WHERE U.id=:id_universite");		
	$req->execute(array(
		'id_universite' => $id_universite
		));			
	while ($donnees = $req->fetch())
	{
		$id_universite = htmlspecialchars($donnees['id']);
		$nom_universite = htmlspecialchars($donnees['nom']);
		$ville_universite = htmlspecialchars($donnees['ville']);
		$nom_pays = htmlspecialchars($donnees['nom_pays']);
	}
	$req->closeCursor();

	if (!empty($nom_universite) and !empty($ville_universite) and !empty($ville_universite)) {

		$location = "";
		$location .= str_replace(" ", "%20", $nom_universite);
		$location .= '%2C%20'.str_replace(" ", "%20", $ville_universite);
		$location .= '%2C%20'.str_replace(" ", "%20", $nom_pays);
?>
		<!--<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Odéon,+Paris,+France&key=<?php echo $googleAPIkey; ?>"></iframe>-->
		<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $location; ?>&key=<?php echo $googleAPIkey; ?>"></iframe>
		
		<!--<script type="text/javascript" src="http://www.supportduweb.com/google_map_gen.js?lati=37.934106&long=-232.434813&zoom=5&width=675&height=400&mapType=normal&map_btn_normal=yes&map_btn_satelite=yes&map_btn_mixte=yes&map_small=yes&marqueur=yes&info_bulle=">
		</script>-->

<?php
	} else 
	{
?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			Les données de localisation sont manquantes.
		</div>
<?php
	}
?>