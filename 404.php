<?php 

// Nécessaire à la récupération des informations de session
session_start();

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
						<h1 class="display-4">Oops !</h2>
						<p class="lead">Erreur 404</p>
						<hr class="my-4">
						<p>Page Not Found.</p>
						<a class="btn btn-primary btn-lg" href="profile.php" role="button">Mon profil</a>
					</div>
		    		</div>
		  	</div>
		</div>

<?php
require_once('handler/footer.php');
?>