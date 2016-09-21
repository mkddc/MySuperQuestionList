<?php
session_start();
require_once("db/db_connexion.php");
$dateduJour =  date('d-m-Y') ;

// $idUser ="";
if(isset($_POST['annuler'])) 
{
    header('Location:index.php');
}
    
    // *********************************************
    // recherche de l'id utilisateur
    // *********************************************

    include "rechercheLogin.php";


    // *********************************************
    // Validation des changement dans le formulaire    
     // *********************************************
    if(isset($_POST['valider']))
    {

        $keyCategorie= 0;
        $categorieTrouve= false;
        $stmt = $dbh->query("SELECT * FROM categories");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC );
        
        if(($categories) && (!empty($_POST['categorie'])))
        {
             foreach ($categories as $key => $categorie)
            {
                if($_POST['categorie'] == $categorie["nom_categorie"])
                {
                    $keyCategorie= $categorie["id"];
                    $categorieTrouve= true;
                }
            
            }
        }
        

        if($categorieTrouve)
        {

            // Creation de la nouvelle question
         
            $titre              = $_POST['titre'] ;
            $corps              = $_POST['corps'] ;
            $date_publication   = date('Y-m-d') ;
            $utilisateur_id     = $idUser; 
            $vote = 0;
            $nb_vues= 0;
            
            $stmt = $dbh->prepare("INSERT INTO questions (titre , corps , date_publication, categorie_id, utilisateur_id, vote, nb_vues) VALUES (:titre, :corps,  :date_publication, :categorie_id, :utilisateur_id, $vote,  $nb_vues )") or die(print_r ($dbh -> errorInfo ()));

            $stmt ->bindValue(':titre',            $titre,    PDO::PARAM_STR); 
            $stmt ->bindValue(':corps',            $corps,    PDO::PARAM_STR); 
            $stmt ->bindValue(':date_publication', $date_publication , PDO::PARAM_STR); 
            $stmt ->bindValue(':categorie_id',     $keyCategorie, PDO::PARAM_INT); 
            $stmt ->bindValue(':utilisateur_id',   $utilisateur_id, PDO::PARAM_INT); 
            $stmt->execute();
            header('Location:index.php');
        }

    }

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
                    <!-- Lien vers la page d'inscription -->
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
              
                         
                <form id="fquestionId" name="form" class="form-horizontal" method="POST" action="" >
                    <fieldset>

                    <!-- Form Name -->
                    <legend>Poser ma question</legend>

                    <!-- Text input-->
                    <div class="form-group">
                      
                      <div class="col-md-7">
                        <input id="titreID" name="titre" type="text" placeholder="Titre de votre question" class="form-control input-md" required="" >
                      </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                    
                      <div class="col-md-7">                     
                        <textarea class="form-control" id="textareaId" name="corps" rows=20 >Votre question</textarea>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      
                        <div class="col-md-4">
                         <input id="date_publicationId" name="date_publication" type="text" disabled class="form-control input-md" value="<?= $dateduJour ?>">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                       
                        <div class="col-md-4">
                            <select id="categorie_id" name="categorie" class="form-control" required="">
                            <option disabled selected>Choisissez votre catégorie</option>
                            <?php
                            $stmt = $dbh->query("SELECT * FROM categories");
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC );
                               

                                foreach ($categories as $key => $categorie)
                                {
                                  echo '<option>'.$categorie["nom_categorie"]. '</option><br>';    
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <p id="warning"></p>
                   
                    <!-- Button (Double) -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="validerId"></label>
                      <div class="col-md-8">
                        <button id="validerId"  type="submit" name="valider" class="btn btn-success">Valider</button>
                        <button id="AnnulerId"  type="reset"  name="annuler" class="btn btn-danger" onclick="history.go(-1)">Annuler</button>
                      </div>
                    </div>

                    </fieldset>
                </form>

            
            </div> <!-- Blog Post Content Column -->

         </div>  <!-- /.row -->


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


    <script type="text/javascript">
        
        var error=document.getElementById("warning");
        var btn=document.getElementById("validerId");
        
        // fonction de controle de l'email avec un message d'erreur affiché en orrange
        function myCheck()
        {
             
      
            var Index = document.getElementById("categorie_id").selectedIndex;
         
            if(Index > 0)
            {
                error.style.display="none";
                document.form.submit();
            }
            else
            {    
                error.innerHTML="Saisir une catégorie !";
                error.style.display="block";
                error.style.color="#f39c12";
            } 
        }
     
      
       btn.addEventListener("click",myCheck,false);


    </script>

</body>

</html>
