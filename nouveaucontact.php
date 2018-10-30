<?php  
require_once("identifier.php"); 
require_once("connexiondb.php");
$requeteS="select * from externe";
$resultatS=$pdo->query($requeteS);

?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nouveau contact </title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez saisir les coordonnées  du nouveau contact :</div>
            <div class="panel-body">
                <form method="post"  action="insertcontact.php" class="form">   
                    
                  
                    
                    <div class ="form-group">
                    <label for="idE">Entreprise :</label>
                         
                    <select name="idE" class="form-control" id="idE">  
                          <?php while($direction=$resultatS->fetch()){ ?>
                         <option value="<?php echo $direction['idExterne'] ?>" >
                               <?php echo $direction['rss'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                    </select> 
                    </div>
                       <div class ="form-group">
                      
                    <label for="nom"> Nom du contact :</label>
                    <input type="text" name="nom" placeholder="nom" 
                          class="form-control"/>  
                      
                    </div>
                    <div class ="form-group">
                      
                    <label for="prenom"> Prénom du contact :</label>
                    <input type="text" name="prenom" placeholder="prenom" 
                          class="form-control"/>  
                      
                    </div>
                    <div class ="form-group">
                      
                    <label for="tel"> Téléphone :</label>
                    <input type="text" name="tel" placeholder="telephone" 
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