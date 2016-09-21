<?php
    require_once "db/db_connexion.php";
    
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
                <a class="navbar-brand" id="titreLogo" href="index.php">
                    My SuperQuestionList
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
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
            <div class="col-lg-8">.
			<!-- formulaire d'inscription -->
            <h3>Inscrivez-vous sur mySQL</h3>
                <form class="form-horizontal" action="partials/traitement_inscription.php" method="POST">
                  <div class="form-group">
                    <label for="pseudoId" class="col-sm-2 control-label">Pseudo</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pseudoId" name="login" placeholder="votre pseudo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Mot de passe</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" name="mdp" placeholder="votre mot de passe">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Votre email">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default" name="btn_inscription">Valider votre inscription</button>
                    </div>
                  </div>
                </form>

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
