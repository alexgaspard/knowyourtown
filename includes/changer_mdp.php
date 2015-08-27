<?php
if (isConnected($bdd))
{
	if (!empty($_POST['old_password']) and !empty($_POST['new_password']))
	{
		$old_password = chiffrer(htmlspecialchars($_POST['old_password']));
		$new_password = chiffrer(htmlspecialchars($_POST['new_password']));

		if ($old_password == $_SESSION['password'])
		{
			if (strlen(htmlspecialchars($_POST['new_password']))>5 and strlen(htmlspecialchars($_POST['new_password']))<31) 
		    {
				$req = $bdd->prepare("UPDATE users SET password = :password WHERE mail = :mail AND actif=1");
				$req->execute(array(
					'password' => $new_password,
					'mail' => $_SESSION['mail']
					));

				$_SESSION['password'] = $new_password;
?>
				<div class="row-fluid">
					<div class="col-md-12">
						<div class="alert alert-success">
							<p>
								Votre mot de passe a été modifié.
							</p>
						</div>
					</div>
				</div>
<?php
			} else
			{
?>
				<div class="row-fluid">
					<div class="col-md-12">
						<div class="alert alert-danger">
							<p>
								Votre nouveau mot de passe a une taille invalide (il doit être de 6 à 30 caractères).
							</p>
						</div>
					</div>
				</div>
<?php
			}
		} else
		{
?>
			<div class="row-fluid">
				<div class="col-md-12">
					<div class="alert alert-danger">
						<p>
							Vous avez entré un mot de passe erroné.
						</p>
					</div>
				</div>
			</div>
<?php
		}
	}
}
?>