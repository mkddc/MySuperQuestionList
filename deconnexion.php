<?php
    require_once "db/db_connexion.php";
    session_start();

	unset($_SESSION['login']);
	unset($_SESSION['mdp']);
	unset($_SESSION['erreur']);

	header('Location: index.php');

?>

