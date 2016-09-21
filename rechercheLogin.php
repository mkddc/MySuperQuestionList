<?php

require_once("db/db_connexion.php");


if(isset($_SESSION['login'])) 
{
    
	$login= $_SESSION['login'];
    
    // *********************************************
    // recherche de l'id utilisateur
    // *********************************************

	$stmt = $dbh->prepare("SELECT * FROM utilisateurs WHERE login = :login");
    $stmt->bindValue(':login',$login, PDO::PARAM_INT);
	$stmt->execute();
	
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$idUser = intval($user['id']);
}

?>