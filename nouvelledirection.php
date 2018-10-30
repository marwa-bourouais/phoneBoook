<?php  
require_once("identifier.php"); 
require_once("connexiondb.php");
$requeteS="select * from direction ";
$resultatS=$pdo->query($requeteS);

?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouveau service</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez saisir le nom de la nouvelle direction:</div>
            <div class="panel-body">
                <form method="post"  action="insertdirection.php" class="form">   
                    
                  
                    
                       <div class ="form-group">
                      
                    <label for="direction"> Nom de la direction :</label>
                    <input type="text" name="direction" placeholder="le nom de la direction" 
                          class="form-control"/>  
                      
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Enregistrer...</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>