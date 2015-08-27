<div class="row-fluid">
	<div class="col-md-2 col-md-offset-10 text-right">
		<?php include "$includes/bouton_contribuer.php"; ?>
	</div>	
</div>

<span style="margin:10px"></span>


<?php

include_once "$includes/ajouter_article.php";

if (isset($echec))
{
?>
	<div class="alert alert-danger">
		<p>
			Les champs sont incomplets.<br><br>
			<a href="javascript:history.back()"><button type="button" class="btn btn-primary">Revenir en arrière</button></a>
		</p>
	</div>
<?php
} else
{
?>
	<div class="alert alert-success">
		<p>
			Votre article a été ajouté, il est maintenant en attente de modération.
		</p>
	</div>
<?php
	if (!empty($id_article)) {
?>
		<p class="text-center">
			<a href="article.php?id_article=<?php echo $id_article; ?>"><button type="button" class="btn btn-primary">Voir l'article</button></a>
		</p>
<?php
	}
}
?>