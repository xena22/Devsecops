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

	$pdo = new pdo("mysql:host=localhost;dbname=webapp", 'webappadmin', 'webapppa$$');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$name = $pseudo;
	$email = "'".$email."'";
	$age = "'".$age."'";
	$pseudo = "'".$pseudo."'";
	$password = "'".$password."'";
	$description = "'".$description."'";
	$statut = "'".$statut."'";

	$stmt = $pdo->prepare("INSERT INTO users (id= :id email= :email, age= :age, pseudo =:pseudo, password = :password, description = :description, statut= :statut)");
	$stmt->bindParam(':id', $id,PDO::PARAM_INT);
	$stmt->bindParam(':pseudo', $pseudo,PDO::PARAM_STR);
	$stmt->bindParam(':age', $age,PDO::PARAM_INT);
	$stmt->bindParam(':email', $email,PDO::PARAM_STR);
	$stmt->bindParam(':password', $password,PDO::PARAM_STR);
	$stmt->bindParam(':description', $description,PDO::PARAM_STR);
	$stmt->bindParam(':statut', $status,PDO::PARAM_STR);
	$stmt->execute();

	$count = $stmt->rowCount();
	$result = $stmt->fetchAll();

	$result=$result[0];
	//echo $count;
	var_dump ($result);

	if ($pdo->query($stmt) === TRUE) {
	  echo "New record created successfully";
	  mkdir("data/" . $name, 0770, true);
	} else {
	  //echo "Error: " . $stmt . "<br>" . $conn->error;
	  echo ('le compte n\'a pas été créé');
	}

	$sql = "select max(id) as ID from `users`";

	$result = $pdo->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return $row["ID"];
		}
	} else {
		return false;
	}

	$conn->close();

		// Récupération du dernier ID inséré en base
	//	return $pdo->lastInsertId();
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
    try {
    // Connexion à la base de donnée et affichage des erreurs (retirer en production)
    $pdo = new pdo("mysql:host=localhost;dbname=webapp", 'webappadmin', 'webapppa$$');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête préparée pour éviter les SQLI
    $stmt = $pdo->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
    $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $stmt->execute();

    // Typage des variables avant envoi en base
    $count = $stmt->rowCount();
    $result = $stmt->fetchAll();

    // Récupération des résultats et décompte de ces derniers (L'utilisateur existe ou n'existe pas en base)  
    if ($count)
    {
        return $result;
    } else {
        return false;
    }
    }

    // Gestion et affichage des exceptions liées à la BDD
    catch(Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
       
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