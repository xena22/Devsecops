<?php

// Nécessaire à la récupération des informations de session
session_start();

// Import des fonctions liées à la manipulation d'un user
//require_once('handler/user.php');
require_once('handler/header.php');

// Import des fonctions liées à la manipulation de données
//require_once('handler/data.php');

// Si l'utilisateur n'est pas connecté, on le renvoie vers l'index
if (!isset($_SESSION['userid']))
{
	header('location:index.php');
} else {

	// Récupération de l'id de l'utilisateur connecté
	$userid   = intval($_SESSION['userid']);

	// Récupération des infos de l'utilisateur connecté
	$user = get_user_by_id($userid);

	if (!$user)
	{	// L'utilisateur n'existe pas, on renvoie vers une 404
		header('location: 404.php');
	} else {
		$pseudo_out 		= $user['pseudo'];
		$age_out 		= $user['age'];
		$email_out 		= $user['email'];
		$statut_out		= $user['statut'];
		$description_out	= $user['description'];
	}
	// Si l'utilisateur a validé son formulaire de modification d'informations
	if (isset($_POST['modify']))
	{
		// Vérification que toutes les données du form sont bien présentes dans la requête POST
		if (isset($_POST['description']) && isset($_POST['statut']) &&  isset($_POST['email']))
		{
			// Si aucune d'entre elles n'est vide
			if (empty($_POST['description']) || empty($_POST['statut']) ||  empty($_POST['email']))
			{
				die('Account modification failed. Merci de remplir tous les champs !');
			} else {
				$email    	= $_POST['email'];
				$age      	= $_POST['age'];
				$statut   	= $_POST['statut'];
				$description 	= $_POST['description'];				

				// Action de modification
				$res_mod_acc = modify_user($userid, $email, $age, $description, $statut);

				// Vérification du résultat obtenu
				if ($res_mod_acc)
				{
					header('location:profile.php');						
				} else {
					die('Account modification failed.');
				}
			}
		}
	}
}
?>

		<div class="container">
			<h1><?= $pseudo_out ?></h1>
			<form method="POST" action="settings.php">
				<div class="form-group">
					<label for="pseudo">Email</label>
					<input type="email" class="form-control" id="email" aria-describedby="email" value="<?= $email_out ?>" name="email">
				</div>
				<div class="form-group">
					<label for="age">Age</label>
					<select class="form-control" id="age" name="age">
						<?php for ($i = 18; $i <= 100; $i++) : ?>
							<?php if (intval($age_out) == $i) : ?>
								<option value="<?= $i ?>" selected="selected"><?= $i ?></option>
							<?php else : ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endif ?>
						<?php endfor ?>
				    	</select>
				</div>
				<div class="form-group">
					<label for="statut">statut</label>
					<input type="text" class="form-control" id="statut" value="<?= $statut_out ?>" name="statut">
				</div>
				<div class="form-group">
					<label for="statut">description</label>
					<textarea class="form-control" id="statut" name="description"><?= $description_out ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary" name="modify">Modifier</button>
			</form>
			<form method="POST" action="delete.php" class="delete_acc">
				<button type="submit" class="btn btn-primary" name="delete">Supprimer mon compte</button>
			</form>
		</div>

