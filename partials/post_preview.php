<?php

if($_SESSION['categorie'] == '')
// Si Aucune catégorie n'est sélectionné, tous les posts questions sont affichés.
{
?>

    <h2><?= "Toutes les catégories :" ?></h2>

    <?php
        // Création de la requête de sélection des posts questions, qqsoit la catégorie (FAIRE AVEC UN PREPARE ?)
    if (isset($_POST['btnTri'])){

        $tri = $_POST['choixTri'];

        switch ($tri) {

            case 'Date': 
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id ORDER BY date_publication DESC";

                break;

            case 'Votes': 
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id ORDER BY vote DESC";
                break;

            case 'Vues':
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id ORDER BY nb_vues DESC";
                break;

            default:
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id ORDER BY date_publication DESC";
                break;
        }

    }
    else
    {
        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id ORDER BY date_publication DESC";
    }


    // $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as U WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id ORDER BY date_publication DESC";

    $stmt = $dbh->query($sql);

    //Recupérations des réponses sous forme de tableau associatif
    $tablo_questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php
    foreach ($tablo_questions as $question ) 
    {

    ?>
        <!-- Titre et redirection vers la page question concernée -->
        <h3 id="IndexQ">
            <a href="question.php?id=<?= $question['question_id']?>"><?=$question['titre'] ?>
            </a>
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
            
            <!-- Ajout d'un "+" si positif -->
            <?php 
            if($question['vote'] > 0)
            {
            ?>
                || vote : +<?=$question['vote'] ?>
            <?php 
            }
            else
            {
            ?>
                || vote : <?=$question['vote'] ?>
            <?php
            }
            ?>
            || nb vues : <?=$question['nb_vues'] ?>
        </p>
        <!-- Corps de la question -->
        <p id="corpsqq">
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

    if (isset($_POST['btnTri'])){

        $tri = $_POST['choixTri'];

        switch ($tri) {

            case 'Date': 
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND c.nom_categorie = '".$_SESSION['categorie']."' ORDER BY date_publication DESC";

                break;

            case 'Votes': 
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND c.nom_categorie = '".$_SESSION['categorie']."' ORDER BY vote DESC";
                break;

            case 'Vues':
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND c.nom_categorie = '".$_SESSION['categorie']."' ORDER BY nb_vues DESC";
                break;

            default:
                        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND c.nom_categorie = '".$_SESSION['categorie']."' ORDER BY date_publication DESC";
                break;
        }
    }
    else
    {
        $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND c.nom_categorie = '".$_SESSION['categorie']."' ORDER BY date_publication DESC";
    }


    // $sql = "SELECT q.id as question_id, q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login FROM questions AS q, categories AS c, utilisateurs as U WHERE q.utilisateur_id = u.id AND q.categorie_id = c.id AND c.nom_categorie ='".$_SESSION['categorie']."' ORDER BY date_publication DESC";

    $stmt = $dbh->query($sql);

    //Recupérations des réponses sous forme de tableau associatif
    $tablo_questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tablo_questions as $question ) 
    {

    ?>
        <!-- Titre et redirection vers la page question concernée -->
        <h3 >
            <a id="TitreQ" href="question.php?id=<?= $question['question_id']?>"><?=$question['titre'] ?>
            </a>
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



?>
