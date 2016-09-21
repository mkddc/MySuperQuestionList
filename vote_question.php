<?php
    require_once "db/db_connexion.php";

    // Mise à jour de l'incrémentation du nombre de vues 
    // (chaque fois qu'on clique sur un article)

  	$sql = "SELECT vote FROM questions WHERE questions.id ='".$_GET['id']."'";
   	$stmt= $dbh->query($sql);
   	$valeur_vote = $stmt->fetch(PDO::FETCH_ASSOC);


    $sql = "UPDATE questions SET vote = :vote WHERE questions.id ='".$_GET['id']."'";
    $stmt = $dbh->prepare($sql);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['plus_un']))
    {
    	$valeur_vote['vote']++;
    }
    if(isset($_POST['moins_un']))
    {
    	$valeur_vote['vote']--;
    }

    $stmt->bindValue(':vote',$valeur_vote['vote'],PDO::PARAM_INT);
    $stmt->execute();

    header("Location: question.php?id=".$_GET['id']);

?>