<?php

try{
	$dbh = new PDO('mysql:host=localhost;dbname=projetstack;charset=utf8','projetstack','123456');
	// Meilleur mode pour la gestion des erreurs : (pas chercher à comprendre)
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
	//voir http://php.net/manual/fr/pdo.setattribute.php
}catch(PDOException $e) 
{
	// code pour gérer/afficher l'erreur
	print "Erreur !: " . $e->getMessage() . "<br>";
	die();
}