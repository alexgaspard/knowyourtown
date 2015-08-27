<?php
	$url_params = '';
	if (!empty($_GET['id_pays']))
	{
		$url_params = '?id_pays='.$id_pays;
	} else if (!empty($_GET['id_universite'])) 
	{
		$url_params = '?id_universite='.$id_universite;
		if (!empty($_GET['id_categorie']))
		{
			$url_params .= '&id_categorie='.$id_categorie;
		}
	}
?>
<a href="contribuer.php<?php echo $url_params; ?>"><button type="button" class="btn btn-primary">Ajouter un article <span class="glyphicon glyphicon-pencil"></span></button></a>