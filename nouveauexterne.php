<?php  
require_once("identifier.php"); 
require_once("connexiondb.php");


?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle entreprise </title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez saisir le raison sociale  de la nouvelle entreprise :</div>
            <div class="panel-body">
                <form method="post"  action="insertexterne.php" class="form">   
                    
                  
                    
                    
                       <div class ="form-group">
                      
                    <label for="ent"> Entreprise :</label>
                    <input type="text" name="ent" placeholder="raison sociale  de l'entreprise " 
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