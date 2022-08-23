<?php

// Nécessaire à la récupération des informations de session
session_start();
// Import des fonctions liées à la manipulation d'un user
require_once('handler/user.php');

if (!isset($_SESSION['userid']))
{
	header('location:index.php');
}
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="styles/main.css">
		<title>WebApp 1.0 - <?= $pseudo ?></title>
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
					<li class="nav-item">
						<a class="nav-link" href="my_files.php?id=<?= $userid ?>" >Mes fichiers</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="resolver.php">Resolver</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="settings.php">Paramètres</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">Déconnexion</a>
					</li>
				</ul>
			</div>
		</nav>