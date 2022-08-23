<?php

// Nécessaire à la récupération des informations de session
session_start();

// Récuperer les fonctions, variables et en-tête du site
require_once('handler/user.php');

// AUTHENTIFICATION --> Récupère les creds saisis par l'utilisateur pour établir leur conformité avec ce qui est présent en base de données
function auth($pseudo, $password_typed)
{
	// Récupération des information utilisateur en fonction du pseudo saisi
	$res = get_user_by_pseudo($pseudo);
	
	// Si pas de résultat, l'utilisateur n'existe pas donc l'authentification échoue
	if (!$res)
	{
		die('Utilisateur n\'existe pas');
	} else {
		// Récupération du mot de passe en base de donnée pour comparaison avec ce qui a été saisi par l'utilisateur
		$password_db = $res['password'];
		
		// Comparaison, si vraie retourne l'ID de l'utilisateur à authentifier, si faux l'authentification échoue
		if ($password_typed == $password_db) {
			return $res['id'];
		} else {
			die('Mauvais mot de passe');
			return false;
		}
	}
}

// Si l'utilisateur est connecté, pas besoin de passer par le portail de login
if (isset($_SESSION['userid']))
{
	header('location:profile.php');
} else {
	// L'utilisateur a validé le formulaire de connexion
	if (isset($_POST['connect']))
	{
		// Les données du formulaires doivent être présentes dans la requête POST
		if (isset($_POST['pseudo']) && isset($_POST['password']))
		{
			// Elles ne doivent pas être envoyées à vide
			if (empty($_POST['pseudo']) || empty($_POST['password']))
			{
				die('Login failed. Merci de remplir tous les champs !');
			} else {
				// Action d'authentification, ces données sont nettoyées dans les fonctions imbriquées
				$res_auth = auth($_POST['pseudo'], $_POST['password']);
				
				// Vérification du résultat, si positif, on ouvre une session à l'utilisateur et on le redirige vers son profil
				if ($res_auth)
				{
					$_SESSION['userid'] = $res_auth;
					header('location:profile.php');						
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
		<title>WebApp 1.0 - Login</title>
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
			<h1>Login</h1>
			<form method="POST" action="login.php">
				<div class="form-group">
					<label for="pseudo">Pseudo</label>
					<input type="text" class="form-control" id="pseudo" aria-describedby="pseudo" name="pseudo">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary" name="connect">Connexion</button>
			</form>
		</div>

<?php
require_once('handler/footer.php');
?>
