<?php
// Nécessaire à la récupération des informations de session
session_start();

// Import des fonctions liées à la manipulation d'un user
require_once('handler/user.php');

if (isset($_POST['delete']))
{
	delete_user($_SESSION['userid']);
	header('location: logout.php');
}
