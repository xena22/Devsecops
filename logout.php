<?php

// Nécessaire à la récupération des informations de session
session_start();

// Destruction des informations de session pour l'utilisateur courant
unset($_SESSION["userid"]);
session_destroy();

// Redirection vers l'index
header("Location:index.php");

