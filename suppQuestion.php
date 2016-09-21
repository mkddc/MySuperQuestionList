<?php
    require_once ("db/db_connexion.php");
    session_start();


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


    // confirmation de la suppresion
    if(isset($_POST['valider']) && (isset($_GET['id'])))
	{
		$stmt = $dbh->prepare("DELETE FROM questions WHERE id = :id");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();



		header('Location:tabBordUser.php');
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



  	<link rel="stylesheet" href="/js/jquery.css">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/blog-post.css" rel="stylesheet">

    <!-- ========================================================= -->
    
    <!-- TODO :  modifier le lien vers la feuille CSS après "recollage des morceaux =======" -->
        <!-- Notre CSS -->
    <link rel="stylesheet" href="css/styleTM.css">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>




<form class="form-horizontal" method="POST" action="">
  <fieldset id="encartWarning">
  
  <!-- Form Name -->
  <legend id="encartLegend">Confirmation de la suppression</legend>
  
  <!-- Button (Double) -->
  <div class="form-group" >
    <label class="col-md-4 control-label" for="button1id">Merci de  confirmer</label>
    <div class="col-md-8">
      <button type="submit" id="button1id" name="valider" class="btn btn-success" >Confirmer</button>
      <button  id="button2id" name="annuler" class="btn btn-danger" onclick="history.go(-1)"> Annuler</button>
    </div>
  </div>
  
  </fieldset>
</form>




    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>



</body>

</html>
