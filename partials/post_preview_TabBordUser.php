<?php
// print_r($_SESSION);

if($_SESSION['categorie'] == '')
// Si Aucune catégorie n'est sélectionné, tous les posts questions sont affichés.
    {
?>

    <h2><?= "Toutes les catégories :" ?></h2>

<?php
    // Création de la requête de sélection des posts questions, qqsoit la catégorie
    // $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as U WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id  ORDER BY date_publication DESC";

     $stmt= $dbh->prepare('SELECT Q.id as question_id, Q.titre, Q.corps , Q.date_publication , Q.vote, Q.nb_vues, U.login, C.nom_categorie FROM questions Q LEFT JOIN reponses R on (Q.id = R.question_id) INNER JOIN categories C on (Q.categorie_id = C.id) INNER JOIN utilisateurs U on (Q.utilisateur_id = U.id) where R.id IS NULL AND U.login like :login') or die(print_r ($dbh -> errorInfo ()));
    $stmt->bindValue(':login', $_SESSION['login'], PDO::PARAM_STR);
    $stmt->execute(); 

    //Recupérations des réponses sous forme de tableau associatif
    $tablo_questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tablo_questions as $question ) {

?>
        <!-- Titre et redirection vers la page question concernée -->
        <h3>
            <a href="admin_modif.php?id=<?= $question['question_id']?>"><?= $question['titre'] ?>
            </a>
            <a id = "majQuestion" href="admin_modif.php?id=<?= $question['question_id'] ?>">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <span class="glyphicon-class"></span></a>
           
           <!-- <a href="suppQuestion.php?id=<?= $question['question_id']  ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a> -->
           <a href="suppQuestion.php?id=<?= $question['question_id']  ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
        </h3>
        <!-- Auteur et nom catégorie -->
        <p class="lead">
            par <?=$question['login'] ?>, 
            Catégorie : <strong><?=$question['nom_categorie'] ?></strong>
        </p>
        <!-- Date de publication, vote et nb vues -->
        <p>
            <span class="glyphicon glyphicon-time"></span> 
            posté le <?=$question['date_publication'] ?>
            || vote : <?=$question['vote'] ?>
            || nb vues : <?=$question['nb_vues'] ?>
        </p>
        <!-- Corps de la question -->
        <p>
            <?=$question['corps'] ?>
        </p>
        <hr>

    <?php
    }
}
else
// Si une catégorie est sélectionnée, on n'affiche que les posts relatifs à cette catégorie
    // Le principe est quasiment le même
{
?>
    <h2><?= $_SESSION['categorie']?></h2>
    
    <?php
    // Préparation de la requête 
    // $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login FROM questions AS q, categories AS c, utilisateurs as U WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND q.id= r.id AND r.id IS NULL AND  U.login like $login  AND c.nom_categorie ='".$_SESSION['categorie']."'  ORDER BY date_publication DESC";
   
    $stmt= $dbh->prepare('SELECT Q.id as question_id, Q.titre, Q.corps , Q.date_publication , Q.vote, Q.nb_vues, U.login FROM questions Q LEFT JOIN reponses R on (Q.id = R.question_id) INNER JOIN categories C on (Q.categorie_id = C.id) INNER JOIN utilisateurs U on (Q.utilisateur_id = U.id) where R.id IS NULL AND  c.nom_categorie = :nomcategorie AND U.login like :login') or die(print_r ($dbh -> errorInfo ()));

    $stmt->bindValue(':login'       , $_SESSION['login'], PDO::PARAM_STR);
    $stmt->bindValue(':nomcategorie', $_SESSION['categorie'], PDO::PARAM_STR);
    $stmt->execute(); 

    //Recupérations des réponses sous forme de tableau associatif
    $tablo_questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tablo_questions as $question ) {
        
    ?>
        <!-- Titre et redirection vers la page question concernée -->
        <h3>


           <a href="admin_modif.php?id=<?= $question['question_id']?>"><?= $question['titre'] ?>
            </a>
            <a id = "majQuestion" href="admin_modif.php?id=<?= $question['question_id'] ?>">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <span class="glyphicon-class"></span></a>
           
           <a href="suppQuestion.php?id=<?= $question['question_id']  ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" value='Confirmer' onClick='ConfirmerSuppression()'></span></a>
        
          </h3>

      
        <!-- Auteur et nom catégorie -->
        <p class="lead">
            par <?=$question['login'] ?>, 
        </p>
        <!-- Date de publication, vote et nb vues -->
        <p>
            <span class="glyphicon glyphicon-time"></span> 
            posté le <?=$question['date_publication'] ?>
            || vote : <?=$question['vote'] ?>
            || nb vues : <?=$question['nb_vues'] ?>
        </p>
        <!-- Corps de la question -->
        <p>
            <?=$question['corps'] ?>
        </p>
        <hr>

    <?php
    }
}

?>
