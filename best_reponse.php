<?php
	require_once("db/db_connexion.php");

	$sql = "UPDATE reponses SET best = '0' WHERE question_id ='".$_GET['id']."'";
	$stmt = $dbh->exec($sql);

	$sql = "SELECT r.best FROM reponses as r WHERE r.question_id ='".$_GET['id']."' AND r.id ='".$_GET['reponse_id']."'";
	$stmt = $dbh->query($sql);
	$reponse = $stmt->fetch(FETCH_ASSOC,PDO::PARAM_INT);

	$sql = "UPDATE reponses SET best = '1' WHERE id ='".$_GET['reponse_id']."'";
	$stmt = $dbh->exec($sql);

	$question_id = $_GET['id'];
	header("Location: question.php?id=".$question_id."");

?>