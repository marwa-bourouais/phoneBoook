<?php
 session_start();
if(isset($_SESSION['user']))   
{
  require_once("connexiondb.php");
 $ids=isset($_GET['ids'])? $_GET['ids']:0;
 $noms=isset($_GET['Service'])? $_GET['Service']:"";
            
$requete="select * from service where idService='$ids'";
$resultat=$pdo->query($requete);
$service=$resultat->fetch();
$noms=$service['designation'];
}
else
{
    header('location:../index.php');
}
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
    <title>Edition d'un service</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Edition du service </div>
            <div class="panel-body">
                <form method="post"  action="updateservice.php" class="form">   
                    <div class="group-control">
                     <div class ="form-group ">
                      
                    <label for="ids"> ID du service: <?php echo $ids ?></label>
                    <input type="hidden" name="ids" class="form-control" value="<?php echo $ids ?>"
                           />  
                      
                    </div>
                  
                      <div class ="form-group">
                      
                    <label for="Service"> Nom du service:</label>
                    <input type="text" name="Service" placeholder="le nom du service" 
                          class="form-control"  value="<?php echo $noms ?>" />  
                      
                   </div>
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Editer...</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>