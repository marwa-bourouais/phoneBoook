<?php  
require_once("identifier.php"); 
require_once("connexiondb.php");
$requeteS="select * from externe ";
$resultatS=$pdo->query($requeteS);

?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Supprimer une entreprise </title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez selectionner l'entreprise  que vous voulez supprimer :</div>
            <div class="panel-body">
                <form method="post"  action="deleteexterne.php" class="form">   
                    
                  
                    
                    <div class ="form-group">
                    <label for="idE">raison sociale :</label>
                         
                    <select name="idE" class="form-control" id="idE">  
                          <?php while($direction=$resultatS->fetch()){ ?>
                         <option value="<?php echo $direction['idExterne'] ?>" >
                               <?php echo $direction['rss'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                        </select> </div>
                   
                    
                    <button onclick="return confirm('Etes vous sur de vouloir supprimer cette entreprise ?')" type="delete" class="btn btn-warning">
                        <span class="glyphicon glyphicon-trash"> </span>
                        supprimer</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>