<?php


// Import des fonctions liées à la manipulation d'un user
require_once('handler/header.php');
$datafolder = 'data/' . $personalfolder;

// Si l'utilisateur n'est pas connecté, on le renvoie vers l'index
if (!isset($_SESSION['userid']))
{
        header('location:index.php');
} else {

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["fileperso"]) && $_FILES["fileperso"]["error"] == 0){
        $filename = $_FILES["fileperso"]["name"];
        $filetype = $_FILES["fileperso"]["type"];
        $filesize = $_FILES["fileperso"]["size"];

            // Vérifie si le fichier existe avant de le télécharger.
            if(file_exists($datafolder . $_FILES["fileperso"]["name"] )){
                echo $_FILES["fileperso"]["name"] . " existe déjà.";
            } else{
                move_uploaded_file($_FILES["fileperso"]["tmp_name"], $datafolder . $_FILES["fileperso"]["name"]);
                echo "Votre fichier a été téléchargé avec succès.";
		header("refresh:2;url=my_files.php");
            }
    } else{
        echo "Error: " . $_FILES["fileperso"]["error"];
    }
}
}
?>
