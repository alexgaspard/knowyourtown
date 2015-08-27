<div class="row-fluid">
	<div class="col-md-4 col-md-offset-4">
		<div class="well">
			<form action="sign.php" method="post" enctype="multipart/form-data" role="form">
				<div class="form-group">
					<label for="mail">Email</label>
					<input type="email" name="mail" class="form-control" id="mail" placeholder="Votre email de Télécom Bretagne"/>
					<p class="help-block">Votre email de Télécom Bretagne.</p>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" id="password" placeholder="Votre mot de passe"/>
					<p class="help-block">Votre mot de passe doit faire entre 6 et 30 caractères.</p>
				</div>
				<div class="row">
					<div class="col-md-6 text-right">
						<button type="submit" class="btn btn-info">Connexion</button>
					</div>
					<div class="col-md-6 text-left">
						<button type="submit" class="btn btn-primary">Inscription</button>
					</div>
				</div>
			</form>
			<form action="sign.php" method="post" enctype="multipart/form-data" role="form">
				<div class="row">
					<div class="col-md-12 text-right">
						<input type="hidden" name="forgotten_password" value="true"/>
						<button type="submit" class="btn btn-link">J'ai oublié mon mot de passe</button>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>