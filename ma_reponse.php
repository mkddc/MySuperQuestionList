<?php

   require_once "db/db_connexion.php";
   session_start();

   //Récupération de l'id utilisateur à partir du login :

	$login = $_SESSION['login'];
	$mdp = $_SESSION['mdp'];
	$corps = htmlentities(strip_tags($_POST['ma_reponse']));
	$date_du_jour = date('Y-m-d');

   	$sql = "SELECT id FROM utilisateurs WHERE utilisateurs.login LIKE '".$login."'";
   	$stmt= $dbh->query($sql);
   	$user_id = $stmt->fetch(PDO::FETCH_ASSOC);

   	// Insertion de l'enregistrement réponse dans la table "reponses" :
	 
	$sql = "INSERT INTO reponses(question_id, utilisateur_id, corps, date_publication) VALUES (:question_id, :utilisateur_id, :corps, :date_publication)";

	$stmt = $dbh->prepare($sql);

	$stmt->bindValue(':question_id', $_GET['id'], PDO::PARAM_INT);
	$stmt->bindValue(':utilisateur_id', $user_id['id'], PDO::PARAM_INT);
	$stmt->bindValue(':corps',$corps,PDO::PARAM_STR);
	$stmt->bindValue(':date_publication', $date_du_jour);
	$stmt->execute();

	header("Location: question.php?id=".$_GET['id']);

?>