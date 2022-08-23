<?php
// Import des fonctions liées à la manipulation d'un user
require_once('handler/header.php');
?>

<div class="container">
				<div class="jumbotron">
                <h2 class="display-4">Testez la résolution d'un service</h2><br />
                <form method="POST" action="resolver.php">
                    <input type="text" name="domain" placeholder="esdacademy.eu">
                    <input type="submit">
                </form>
                </div>
                <?php 
                    if(isset($_POST["domain"]) && !empty($_POST["domain"])){
                    $response = system("timeout 5 bash -c 'host ".$_POST["domain"]."| head -n 1'");
                    foreach ($response as $line) {
                        echo "<br /><pre>" . $line . "</pre>";
                    }
}
?>
<pre>
				</div>
</div>


<?php
require_once('handler/footer.php');
?>