<?php
// Nécessaire à la récupération des informations de session
session_start();

// Récuperer les fonctions, variables et en-tête du site
require_once('handler/user.php');

// Import des fonctions liées à la manipulation de données
//require_once('handler/data.php');

// Vérification sur l'authentification d'un utilisateur
if (isset($_SESSION['userid']))
{
	header('location:profile.php');
} else {
	// L'utilisateur a validé le formulaire d'inscription
	if (isset($_POST['new_insert']))
	{
		// Toutes les variables présentes dans le formulaire doivent également l'être dans la requête POST
		if (isset($_POST['pseudo']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['description']) && isset($_POST['statut']) && isset($_POST['age']) &&  isset($_POST['email']))
		{
			// Ces dernière ne doivent pas être envoyées à vide
			if (empty($_POST['pseudo']) || empty($_POST['password1']) || empty($_POST['password2']) || empty($_POST['description']) || empty($_POST['statut']) || empty($_POST['age']) ||  empty($_POST['email']))
			{
				die('Account creation failed. Merci de remplir tous les champs !');
			} else {
				// Récupération des informations utilisateur en fonction du pseudo fourni
				$user = get_user_by_pseudo($_POST['pseudo']);
				if ($user)
				{
					// Le pseudo est déjà pris
					die('Account creation failed. Le pseudo existe déjà !');
				}
				// Vérification sur les deux champs password
				if ($_POST['password1'] == $_POST['password2']) {

					$pseudo   	= $_POST['pseudo'];
					$statut   	= $_POST['statut'];
					$email    	= $_POST['email'];
					$age      	= $_POST['age'];
					$description 	= $_POST['description'];

					// envoi du mot de passe en base
					$password 	= $_POST['password1'];

					// Action de création de compte
					$res_new_acc = create_user($email, $age, $pseudo, $password, $description, $statut);

					// Vérification du résultat avec création de session si succès et redirection vers le nouveau profil créé
					if ($res_new_acc)
					{
						$_SESSION['userid'] = $res_new_acc;
						header('location:profile.php');
					} else {
						die('Account creation failed.');
					}
				} else {
					die('Account creation failed. Les deux champs de mot de passe sont différents');
				}
			}
		}
	}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<title>WebApp 1.0 - Inscription</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light">
			<a class="navbar-brand" href="index.php"><b>ESD</b> WebApp</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="profile.php">Profil</a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<h1>Inscription</h1>
			<form method="POST" action="inscription.php">
				<div class="form-group">
					<label for="pseudo">Pseudo</label>
					<input type="text" class="form-control" id="pseudo" aria-describedby="pseudo" name="pseudo">
				</div>
				<div class="form-group">
					<label for="pseudo">Email</label>
					<input type="email" class="form-control" id="email" aria-describedby="email" name="email">
				</div>
				<div class="form-group">
					<label for="age">Age</label>
					<select class="form-control" id="age" name="age">
						<?php for ($i = 18; $i <= 100; $i++) : ?>
						<option value="<?= $i ?>"><?= $i ?></option>
						<?php endfor ?>
				    	</select>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password1" name="password1">
				</div>
				<div class="form-group">
					<label for="password">Password verification</label>
					<input type="password" class="form-control" id="password2" name="password2">
				</div>
				<div class="form-group">
					<label for="statut">Statut</label>
					<input type="text" class="form-control" id="statut" name="statut">
				</div>
				<div class="form-group">
					<label for="statut">Description</label>
					<textarea class="form-control" id="statut" name="description"></textarea>
				</div>
				<button type="submit" class="btn btn-primary" name="new_insert">Inscription</button>
			</form>
		</div>

<?php
require_once('handler/footer.php');
?>