<?php 

// Nécessaire à la récupération des informations de session
session_start();

// Si l'utilisateur est déjà connecté, on l'envoie vers sa page de profil
if (isset($_SESSION['userid']))
{
	header('location:profile.php');
}

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<title>WebApp 1.0</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light">
			<a class="navbar-brand" href="index.php"><b>ESD</b> WebApp</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</nav>
		<div class="container">
			<div class="row">
		    		<div class="col">
					<div class="jumbotron">
						<h1 class="display-4">Déjà inscrit ?</h2>
						<p class="lead">Connectez-vous !</p>
						<hr class="my-4">
						<p>Accédez à votre profil et partagez vos informations personnelles avec les autres utilisateurs et partenaires</p>
						<a class="btn btn-primary btn-lg" href="login.php" role="button">Connexion</a>
					</div>
		    		</div>
		    		<div class="col">
					<div class="jumbotron">
						<h1 class="display-4">Nouvel arrivant ?</h2>
						<p class="lead">Inscrivez-vous !</p>
						<hr class="my-4">
						<p>Remplissez le formulaire d'inscription pour profiter des nos services exceptionnels et personnalisés</p>
						<a class="btn btn-primary btn-lg" href="inscription.php" role="button">Inscription</a>
					</div>
		    		</div>
		  	</div>
		</div>

<?php
require_once('handler/footer.php');
?>	
