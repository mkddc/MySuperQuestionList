<!--
objectifs : pouvoir Modifier une question publier par un membre du site.
?> -->

<?php
// On récupère nos variables de session
session_start();
require_once("db/db_connexion.php");

// if(isset($_POST['annuler'])) 
// {
//     header('Location: admin.php');
// }

if (isset($_GET['id']))
{
    $id =intval($_GET['id']);
        
    // *********************************************
    // Selection de la question que l'on veurt modifier
    // *********************************************
                       
    $stmt = $dbh->prepare('SELECT * FROM questions  where id = :id ') or die(print_r ($dbh -> errorInfo ()));
    $stmt ->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();       
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if($question)
    {
        $titre              = $question['titre'] ;
        $corps              = $question['corps'] ;
        $date_publication   = $question['date_publication'] ;
        $utilisateur_id     = $question['utilisateur_id'] ;
        $categorie_id       = $question['categorie_id'] ;
    } 
    else
    {
        print_r($_GET);
        echo "Aucune question trouvée";
    }
    // *********************************************
    // Validation des changement dans le formulaire    
    // *********************************************

    // recherche de l'ID categorie en fonction de la la catégorie sélectionnée

    if(isset($_POST['valider'])) {

        $stmt = $dbh->query("SELECT * FROM categories");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC );
      
        foreach ($categories as $key => $categorie) {
            if($_POST['categorie'] == $categorie["nom_categorie"]){
                $keyCategorie= $categorie["id"];
            }
            
        }
    
    // mie à jour de la question
     
        $titre              = $_POST['titre'] ;
        $corps              = $_POST['corps'] ;
        $date_publication   = $_POST['date_publication'] ;
        
        $stmt = $dbh->prepare(" UPDATE questions set titre = :titre, corps = :corps, date_publication = :date_publication, categorie_id = :categorie_id where id = :id ") or die(print_r ($dbh -> errorInfo ()));

        $stmt ->bindValue(':id',               $id,       PDO::PARAM_INT);       
        $stmt ->bindValue(':titre',            $titre,    PDO::PARAM_STR); 
        $stmt ->bindValue(':corps',            $corps,    PDO::PARAM_STR); 
        $stmt ->bindValue(':date_publication', $date_publication, PDO::PARAM_STR); 
        $stmt ->bindValue(':categorie_id',     $keyCategorie, PDO::PARAM_INT); 
        $stmt->execute();
        // header("Location: tabBordUser.php");
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

    <title>MySQL-Admin</title>

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
   <!--  <link href="css/clean-blog.min.css" rel="stylesheet"> -->
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
                <a class="navbar-brand" href="index.php">MySQL - My Super Question List</a>
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
                                <?php
                                echo "<h4>Bonjour ".$_SESSION['login']."</h4>"; 
                                ?>
                                </li>
                    <li>
                        <form action="deconnexion.php" name="form_deconnexion" method="POST" class="form-inline">
                          <button type="submit" class="btn btn-warning" id="btnDeconnexion"name="deconnexion">Se déconnecter</button>
                          <a href="tabBordUser.php">
                                <button type="button" class="btn btn-info">Tableau de bord</button>
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
            <div class="col-lg-8">        
            
                <form id="formQuestion" class="form-horizontal" method="post">
                <fieldset>

                <!-- Form Name -->
                <legend>Modifier ma question</legend>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="titreID">Le titre de votre question </label>  
                  <div class="col-md-7">
                  <input id="titreID" name="titre" type="text" placeholder="Votre question" class="form-control input-md" required="" value="<?= $titre ?>">
                    
                  </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="textareaId">Votre question</label>
                  <div class="col-md-7">                     
                    <textarea class="form-control" id="textareaId" name="corps" rows=20><?= $corps ?></textarea>
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="date_publicationId">Date de publication</label>  
                  <div class="col-md-4">
                  <input id="date_publicationId" name="date_publication" type="date" placeholder="La date de publication" class="form-control input-md" required="" value="<?= $date_publication ?>">
                    
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="categorie_id">Categorie ID</label>  
                  <div class="col-md-4">
                  <select id="categorie_id" name="categorie" class="form-control" required="">
                  <?php
                        $stmt = $dbh->query("SELECT * FROM categories");
                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC );
                         //  echo '<pre>';
                         // print_r($categories);
                         //    echo '</pre>'; 

                        foreach ($categories as $key => $categorie)
                        {
                        if($categorie["id"] == $categorie_id)
                            {
                               echo '<option selected>'.$categorie["nom_categorie"]. '</option><br>';
                            }
                            else
                            {
                                echo '<option>'.$categorie["nom_categorie"]. '</option><br>';    
                            }
               
                        }
                  ?>
                    </select>
                  </div>
                </div>
               
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
    function resetForm(myFormId)
    {
       var myForm = document.getElementById(myFormId);
       for (var i = 0; i < myForm.elements.length; i++)
       {
           if ( 'reset' != myForm.elements[i].type)
           {

               myForm.elements[i].value = '';
               myForm.elements[i].selectedIndex = 0;
           }       
       }
   }
   // <?php header('Location: tabBordUser.php'); ?>

  </script>

</body>
</html>

<?php
if(isset($_POST['annuler'])) 
{
    header('Location: admin.php');
}

if(isset($_POST['valider'])) 
{
    header('Location: tabBordUser.php');
}

?>
