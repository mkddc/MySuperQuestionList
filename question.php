<?php
    require_once("db/db_connexion.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Super Question List</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- Notre CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <!-- Insertion du logo -->
                    <img src="img/Logo_projet.png" height="35" alt="logo">
                </a>
                <a class="navbar-brand" id="titreLogo" href="index.php">My SuperQuestionList</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <?php
                            if(!isset($_SESSION['login']))
                            {
                        ?>    
                            <!-- Insertion des champs de connexion -->
                            <form action="connexion.php" name="form_connexion" method="POST" class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="loginId">Login</label>
                                    <input type="text" class="form-control" id="loginId" name="login" placeholder="Login">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="mdpId">Mot de passe</label>
                                    <input type="password" class="form-control" id="mdpId" name="mdp" placeholder="Mot de passe">
                                </div>
                                <button type="submit" class="btn btn-default" name="connexion">Se connecter</button>
                            </form>
                    </li>
                    
                    <!-- Lien vers la page d'inscription, seulement si le user n'est pas connecté -->
                    <li>
                        <a href="inscription.php">S'inscrire</a>
                    </li>
                       <?php
                            }
                            else
                            {
                        ?>
                            <li class="connecte">
                                <?="<h4>Bonjour ".$_SESSION['login']."</h4>"; ?>
                            </li>
                            <li>
                                <form action="deconnexion.php" name="form_deconnexion" method="POST" class="form-inline">
                                    <button type="submit" class="btn btn-warning" id="btnDeconnexion"name="deconnexion">Se déconnecter</button>
                                    <a href="tabBordUser.php">
                                        <button type="button" id="btnBleu" class="btn btn-info">Tableau de bord</button>
                                    </a>
                                </form>
                            </li>   
                                <?php
                            }
                        ?>
                 </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


<?php
    // Création de la requête de sélection du post question
    $sql = "SELECT q.titre, q.corps, q.date_publication, q.vote, q.nb_vues, u.login, c.nom_categorie FROM questions AS q, categories AS c, utilisateurs as u WHERE q.id ='".$_GET['id']."' AND q.categorie_id = c.id AND u.id = q.utilisateur_id";

    $stmt = $dbh->query($sql);

    //Recupérations de la question (1 seul résultat) sous forme de tableau associatif
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    // Mise à jour de l'incrémentation du nombre de vues 
    // (chaque fois qu'on clique sur un article)
    $sql = "UPDATE questions SET nb_vues = :nb_vues WHERE questions.id ='".$_GET['id']."'";
    $stmt = $dbh->prepare($sql);

    $question['nb_vues']++;

    $stmt->bindValue(':nb_vues',$question['nb_vues'],PDO::PARAM_INT);
    $stmt->execute();

    ?>


   <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
 
            <hr>

            <h2 id="QQ">
                <strong>Question : </strong> <?= $question['titre']?>
            </h2>

            <hr>

            <h3>
                <!-- Implémentation de la possibilté de vote par question posée, 
                seulement si on est membre et connecté-->
                <?php
                if(isset($_SESSION['login']))
                {
                ?>
                <form action="vote_question.php?id=<?= $_GET['id']?>" method="POST">
                        <button name="plus_un" id="plusUn">
                            <span id="plusUn" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
                        </button>
                        <button name="moins_un" id="moinsUn">
                            <span id="moinsUn" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                        </button>
                        <span>
                          <?php 
                            if($question['vote'] > 0)
                            {
                            ?>
                                vote : +<?=$question['vote'] ?>
                            <?php 
                            }
                            else
                            {
                            ?>
                                vote : <?=$question['vote'] ?>
                            <?php
                            }
                            ?>
                        </span>
                </form>
                <?php
                }
                ?>
            </h3>
            <p class="lead">
                par <?=$question['login'] ?>, 
                Catégorie : <strong><?=$question['nom_categorie'] ?></strong>
            </p>
            <p id="">
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
            <p id="qq">
                <?=$question['corps'] ?>
            </p>
            
            <hr>

            <?php
                // Création de la requête de sélection des posts réponses
                $sql = "SELECT r.id, r.utilisateur_id, r.corps, r.date_publication, r.vote, r.best, u.login FROM reponses AS r, utilisateurs as U WHERE r.utilisateur_id = u.id AND r.question_id = '".$_GET['id']."' ORDER BY r.best DESC";

                $stmt = $dbh->query($sql);

                $tablo_reponses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if(!empty($tablo_reponses))
                {
            ?>
                    <h2 id="RR" ><strong>Réponses :</strong></h2>
                    <hr>
            <?php
            }
            ?>

            <?php
            foreach ($tablo_reponses as $reponse ) {
            ?>
                <!-- Auteur -->
                <p class="lead">
                    par <?=$reponse['login'] ?>, 
                </p>
                <!-- Implémentation du vote réponse au cas -->
                <!-- où connecté -->
                <?php
                if(isset($_SESSION['login']))
                {
                ?>

                <form action="vote_reponse.php?id=<?= $_GET['id']?>&reponse_id=<?= $reponse['id']?>" method="POST">
                        <button name="plus_un" id="plusUn">
                            <span id="plusUn" class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
                        </button>
                        <button name="moins_un" id="moinsUn">
                            <span id="moinsUn" class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                        </button>
                        <span>
                          <?php 
                            if($reponse['vote'] > 0)
                            {
                            ?>
                                vote : +<?=$reponse['vote'] ?>
                            <?php 
                            }
                            else
                            {
                            ?>
                                vote : <?=$reponse['vote'] ?>
                            <?php
                            }
                            ?>
                        </span>
                </form>
                <?php
                }
                else
                {
                    if($reponse['vote'] > 0)
                    {
                    ?>
                        <strong>vote</strong> : +<?=$reponse['vote'] ?>
                    <?php 
                    }
                    else
                    {
                    ?>
                        <strong>vote</strong> : <?=$reponse['vote'] ?>
                    <?php
                    }                    
                }
                ?>
                <br>
                <!-- Date de publication, vote et nb vues -->
                <p>
                    <span class="glyphicon glyphicon-time"></span> 
                    posté le <?=$reponse['date_publication'] ?>
                    <?php
                    //Apparition d'une étoile à côté de la réponse best
                    if($reponse['best'] == '1')
                    {
                    ?>
                        <span class="glyphicon glyphicon-star" aria-hidden="true">BEST</span>
                    <?php
                    }
                    ?>
                </p>

                <!-- Gestion du choix de la meilleure réponse par le posteur de question : -->
                <?php 
                    if($_SESSION['login']==$question['login'])
                    {
                ?>
                        <form action="best_reponse.php?id=<?= $_GET['id']?>&reponse_id=<?= $reponse['id']?>" method="POST">
                            <button type="submit" id="btnBest" name="btnBest" class="btn btn-info">BEST REPONSE ?</button>
                        </form>
                <?        
                    }
                ?>
                <!-- Fin de gestion de la meilleure réponse par le posteur de question : -->

                <!-- Corps de la réponse -->
                <p id="rr">
                    <?=$reponse['corps'] ?>
                </p>
                <hr>

            <?php
}
?>
            <!-- Champ réponse pour répondre à la question
            Seulement si on est connecté -->
        <?php
        if(isset($_SESSION['login']))
        {
        ?>
            <form action="ma_reponse.php?id=<?= $_GET['id']?>" method="POST">
                <textarea class="form-control" rows="3" name="ma_reponse"></textarea>
                <input id="BtnPostRR" class="btn btn-default" type="submit" value="Poster ma réponse" name="btn_reponse">
            </form>
        <?php
        }
        ?>
            </div>
        </div>

         <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Webforce3</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
