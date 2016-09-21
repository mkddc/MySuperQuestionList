<?php
    require_once "db/db_connexion.php";
    session_start();

	$login = htmlentities(strip_tags($_POST['login']));
	$mdp = htmlentities(strip_tags($_POST['mdp']));

	$stmt = $dbh->prepare("SELECT login, mdp FROM utilisateurs WHERE login = :login AND mdp = :mdp");
	$stmt->bindValue(':login', $login, PDO::PARAM_STR);
	$stmt->bindValue(':mdp', $mdp, PDO::PARAM_STR);
	$stmt->execute();

	$resultat = $stmt->fetch(PDO::FETCH_ASSOC);

	if(empty($resultat))
	{
		$_SESSION['erreur'] = "Identifiant et/ou mot de passe incorrect(s) !";
	}
	else
	{
		$_SESSION['login'] = $login;
		$_SESSION['mdp'] = $mdp;
		$_SESSION['erreur'] = '';
	}

	header('Location: index.php');

?>