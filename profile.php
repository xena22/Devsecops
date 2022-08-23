<?php

// Récuperer les fonctions, variables et en-tête du site
require_once('handler/header.php');

?>

		<div class="container">
				<div class="jumbotron">
					<h2 class="display-4"><?= $pseudo ?></h2>
					<p class="lead">Statut : <?= $statut ?></p>
					<hr class="my-4">
					<p><b>Age :</b> <?= $age ?></p>
					<p><b>Email :</b> <?= $email ?></p>
					<p><b>Description :</b><br><?= nl2br($description) ?></p>
				</div>
		</div>
<?php
require_once('handler/footer.php');
?>