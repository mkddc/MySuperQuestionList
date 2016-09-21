<?php
    require_once "../db/db_connexion.php";
    session_start();

    if(isset($_POST['btn_inscription'])){

    	print_r($_POST);
    	
    	$login = htmlspecialchars($_POST['login']);
    	$mdp = htmlspecialchars($_POST['motDePasse']);
    	$email = htmlspecialchars($_POST['email']);

    	//je prépare ma requête pour UPDATER ma Base de Données
    	$stmt = $dbh->prepare(" INSERT INTO utilisateurs(login, email, mdp) VALUES (:login, :mdp, :email)");
    	$stmt->bindValue(':login', $login, PDO::PARAM_STR);
    	$stmt->bindValue(':mdp', $mdp,PDO::PARAM_STR);
    	$stmt->bindValue(':email', $email, PDO::PARAM_STR);
    	$stmt->execute();

        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;

              
    }

        header('Location:../index.php');

    
?>