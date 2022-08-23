<?php
/*

Chaque fonction ci-dessous a une interraction avec la base de données.
Le but de cette page de process php est de déclarer différentes fonctions liées à la manipulation d'un user dans l'appli (CRUD) et de les centraliser.

*/

// CREATION --> Liée à l'inscription d'un user
function create_user($email, $age, $pseudo, $password, $description, $statut)
{
	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$name = $pseudo;
	$email = "'".$email."'";
	$age = "'".$age."'";
	$pseudo = "'".$pseudo."'";
	$password = "'".$password."'";
	$description = "'".$description."'";
	$statut = "'".$statut."'";

	$sql = "INSERT INTO users (email, age, pseudo, password, description, statut) VALUES (".$email.", ".$age.", ".$pseudo.", ".$password.", ".$description.", ".$statut.");";
	echo $sql;

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	//création du dossier personnel de l'utilisateur
	mkdir("data/" . $name, 0770, true);

	$sql = "select max(id) as ID from `users`";

	$result = $conn->query($sql);
		
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["ID"];
		}
	} else {
		return false;
	}

	$conn->close();

		// Récupération du dernier ID inséré en base
		return $pdo->lastInsertId();
}

// MODIFICATION --> Liée à la mise à jour des information utilisateur
function modify_user($id, $email, $age, $description, $statut)
{
	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$email = "'".$email."'";
	$age = "'".$age."'";
	$description = "'".$description."'";
	$statut = "'".$statut."'";

	$sql = "UPDATE users SET email= ".$email.", age= ".$age.", description= ".$description.", statut= ".$statut." WHERE id= ".$id;

	echo $sql;

	if ($conn->query($sql) === TRUE) {
	  echo "update OK";
	  return true;
	} else {
	  return false;
	}

	$conn->close();
}

function delete_user($id)
{
	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	
	$sql = "DELETE FROM users WHERE id= ".$id;
	
	
	if ($conn->query($sql) === TRUE) {
	  $conn->close();
	  return true;
	} else {
	  $conn->close();
	  return false;
	}
}

// SELECT --> Liée à l'affichage des informations de tous les utilisateurs en base
function get_all_users()
{
	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT id, pseudo FROM users";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	$conn->close();
	return $rows;
	}
}


// SELECT --> Liée à l'affichage des informations utilisateur (Séléction par ID)
function get_user_by_id($id)
{
	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$id = "'".$id."'";
	
	$sql = "SELECT * FROM users WHERE id= ".$id;
	
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$conn->close();
	return $result;
}


// SELECT --> Liée à l'affichage des informations utilisateur (Séléction par pseudo)
function get_user_by_pseudo($pseudo)
{
	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$pseudo = "'".$pseudo."'";
	
	$sql = "SELECT * FROM users WHERE pseudo= ".$pseudo;
	
	$result = $conn->query($sql);
	
	//var_dump($result);
	
	if ($result->num_rows > 0) {
		$result = $result->fetch_assoc();
		$conn->close();
		return $result;
	} else {
		$conn->close();
		return false;
	}
}

function connect_user($pseudo, $password)
{

	$servername = "localhost";
	$username = "webappadmin";
	$passdb = "webapppa$$";
	$dbname = "webapp";

	$conn = new mysqli($servername, $username, $passdb, $dbname);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$pseudo = "'".$pseudo."'";
	$password = "'".$password."'";

	$sql = "select id FROM users WHERE pseudo= ".$pseudo." and password= ".$password;
    var_dump($sql);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["id"];
		}
	} else {
		return false;
	}

	$conn->close();
}

if (isset($_SESSION['userid']))
{
        // Récupération de l'ID utilisateur du profil consulté (Si aucun, par défaut on affiche le profil de l'utilisateur courant, sinon celui dont l'ID est passé en paramètre d'URL)
        $userid   = isset($_GET['id']) ? intval($_GET['id']) : intval($_SESSION['userid']);

        // Récupération des informations utilisateur en fonction de l'ID fourni
        $user = get_user_by_id($userid);
        if (!$user)
        {
                // L'utilisateur n'existe pas, on renvoie vers une 404
                header('location: 404.php');
        } else {
                $pseudo         = $user['pseudo'];
				$age 		= $user['age'];
				$email 		= $user['email'];
				$statut 	= $user['statut'];
				$description 	= $user['description'];
                $personalfolder = $pseudo . '/';
        }

}

?>