<?php

// Récuperer les fonctions, variables et en-tête du site
require_once('handler/header.php');

?>
	<div class="container">
	<div class="jumbotron">
		<h3>Mon espace :</h3></b>
		<?php
		$user = get_user_by_id($userid);
		$personalfolder = $user['pseudo'];
		$dir = "data/" . $personalfolder . '/';
		foreach(scandir($dir) as $file){
					if ($file != "." && $file != "..") {
				echo "<a href=" . $dir . $file . " download>" . $file . "</a><br />";
			}
		}
		?>
		<br /><br /><form action="upload.php" method="post" enctype="multipart/form-data">
		<h3>Uploader un fichier</h3>
		<label for="fileUpload">Fichier:</label>
			<input type="file" name="fileperso" id="fileUpload">
			<input type="submit" name="submit" value="Upload">
		</form>
<?php
require_once('handler/footer.php');
?>
