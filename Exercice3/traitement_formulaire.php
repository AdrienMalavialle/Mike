<?php

// if(isset($_POST["marque"]) && isset($_POST["modele"]) && isset($_POST["annee"]) && isset($_POST["couleur"])) {
if(isset($_POST)) {
	if(!empty($_POST)) {

		// Vérification de la connexion à la BDD avec gestion des erreurs pour éviter de les afficher (sécurité)
		try {
			$PDO = new PDO('mysql:host=localhost;dbname=mike', 'root', '');
			$PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$PDO -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}
		// Affiche un message d'erreur (normalement, on prévoit également de ne pas afficher les erreurs SQL)
		catch(PDOException $e) {
			echo "La BDD 'Mike' n'existe pas !";
		}

		$insertRequest = $PDO -> prepare("INSERT INTO `vehicules`(`marque`, `modele`, `annee`, `couleur`) 
			VALUES (:marque, :modele, :annee, :couleur)");
		$insertRequest -> bindParam(":marque", $_POST["marque"]);
		$insertRequest -> bindParam(":modele", $_POST["modele"]);
		$insertRequest -> bindParam(":annee", $_POST["annee"]);
		$insertRequest -> bindParam(":couleur", $_POST["couleur"]);
		$insertRequest -> execute();

		echo"<p style='color: green'>Ok !</p>";
	}
	else {
		echo"<p style='color: red'>Fail !</p>";
	}
}
else {
	echo"<p style='color: red'>Fail !</p>";
}

?>