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
        <title>Supprimer une direction</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez selectionner la direction que vous voulez supprimer :</div>
            <div class="panel-body">
                <form method="post"  action="deletedirection.php" class="form">   
                    
                  
                    
                    <div class ="form-group">
                    <label for="idDirection">Direction :</label>
                         
                    <select name="idDirection" class="form-control" id="idDirection">  
                          <?php while($direction=$resultatS->fetch()){ ?>
                         <option value="<?php echo $direction['idDirection'] ?>" >
                               <?php echo $direction['nom'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                        </select> </div>
                   
                    
                    <button onclick="return confirm('Etes vous sur de vouloir supprimer cette direction ?')" type="delete" class="btn btn-warning">
                        <span class="glyphicon glyphicon-trash"> </span>
                        supprimer</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>