<?php
    require_once "db/db_connexion.php";
    session_start();

    // Mise à jour de l'incrémentation du nombre de vues 
    // (chaque fois qu'on clique sur un article)

  	$sql = "SELECT r.vote FROM reponses AS r, questions WHERE r.id = '".$_GET['reponse_id']."' AND r.question_id ='".$_GET['id']."'";

   	$stmt= $dbh->query($sql);
   	$votes_reponses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($votes_reponses as $reponse) 
    {
        $sql = "UPDATE reponses SET vote = :vote WHERE reponses.id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id',$_GET['reponse_id'],PDO::PARAM_INT);

        if(isset($_POST['plus_un']))
        {
            $reponse['vote']++;
        }
        elseif(isset($_POST['moins_un']))
        {
            $reponse['vote']--;
        }

        $stmt->bindValue(':vote',$reponse['vote'],PDO::PARAM_INT);
        $stmt->execute();
    }

    //Lorsque l'on retourne à la page question.php, le nombre de vue s'incrémente
    // alors qu'il n'est pas censé (à cause du header ci-dessous)
    // On met donc à jour la table question pour enlever une vue.
    // Au final : -1+1=0
    $sql = "SELECT questions.nb_vues FROM questions WHERE questions.id = '".$_GET['id']."'";
    $stmt= $dbh->query($sql);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "UPDATE questions SET nb_vues = :nb_vues WHERE questions.id = '".$_GET['id']."'";
    $stmt = $dbh->prepare($sql);
    $question['nb_vues']--;
    $stmt->bindValue(':nb_vues',$question['nb_vues'],PDO::PARAM_INT);
    $stmt->execute();


    header("Location: question.php?id=".$_GET['id']);

