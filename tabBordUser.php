<?php
    require_once ("db/db_connexion.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Super Question List</title>

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

<body>

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
                       <?php
                            }
                            else
                            {
                        ?>
                                <li class="connecte">
                                <?php
                                echo "<h4>Bonjour ".$_SESSION['login']."</h4>"; 
                                ?>
                                </li>
                    <li>
                        <form action="deconnexion.php" name="form_deconnexion" method="POST" class="form-inline">
                          <button type="submit" class="btn btn-warning" id="btnDeconnexion"name="deconnexion">Se déconnecter</button>
                        </form>
                    </li>   
                        <?php
                            }
                        ?>

                    <!-- Lien vers la page d'inscription -->
                  <!--   <li>
                        <a href="inscription.php">S'inscrire</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <h1 id="titreTabBord">GESTION DE MES POSTS</h1>
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
 
            <!-- Insertion du listing des questions en accueil-->
            <hr>
            <!-- Insertion du listing des questions si une catégorie est choisie -->
            <?php
                // Initialisation de la session pour conserver le choix de la catégorie du menu déroulant dans l'appel de post_preview.php
                $_SESSION['categorie'] ='';

// ** modifier

                if(isset($_POST['btn_categorie']) && (!empty($_POST['choix'])))
                {
                    $_SESSION['categorie'] = $_POST['choix'];
                }
                else
                {
                    $_SESSION['categorie'] = '';
                }
                // Apparition du message d'erreur en cas de pb de connexion
                if(isset($_SESSION['erreur']))
                {
                    echo "<h4>".$_SESSION['erreur']."</h4>";
                    echo "<br>";
                }
            ?>

                <!-- Choix de la catégorie d'affichage -->
                <form action="#" method="POST" id="choixCategorie">
                    <select class="form-control" name="choix">
                        <option selected disabled>Choisissez votre catégorie</option> 

                            <?php 
                            // Création de la requête de sélection des catégories
                            $sql = "SELECT * FROM categories ORDER BY id";
                            $stmt = $dbh->query($sql);
                            //Recupérations des réponses sous forme de tableau associatif
                            $tablo_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($tablo_categories as $categorie) 
                            { ?>
                                <option name="<?=$categorie['nom_categorie']?>">
                                    <?=$categorie['nom_categorie']?>
                                </option>
                            <?php 
                            }
                            ?>
                    </select>
                    <!-- <input type="submit" id="goCategorie" value="Aller à la catégorie" name="btn_categorie"> -->
                    <button type="submit" id="goCategorie" class="btn btn-success" name="btn_categorie">Aller à la catégorie</button>

                <hr>

                </form>

               <!-- insertion du bouton pour poser une question : -->
                <a href="nouvellequestion.php">
                    <button type="button" class="btn btn-primary btn-lg active">Poser une question</button>
                </a>

            <?php
                // Appel du script d'affichage des posts question
                include ("partials/post_preview_TabBordUser.php");
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

    <script language='javascript'>
        function ConfirmerSuppression()
        {
        if (confirm("Confirmez vous la suppression de cette question  ?"))
        {
        formulaire.submit();
        }
        }
</script>

</body>

</html>
