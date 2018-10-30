<?php
require_once("identifier.php"); 
require_once("connexiondb.php");

$requeteS="select * from service as s , direction as d where s.idDirection=d.idDirection";
$resultatS=$pdo->query($requeteS);

$requeteB="select * from bureau";
$resultatB=$pdo->query($requeteB);
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
    <title>Nouvel employé:</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Entrer les coordonnées du nouvel employé:</div>
            <div class="panel-body">
              <form method="post"  action="insertemploye.php" class="form" enctype="multipart/form-data">   
                        <div class ="form-group ">
                    <label for="photo"> Photo de l'employé:</label>
                    <input type="file" name="photo" />  
                    </div>
            
                      <div class ="form-group">
                    <label for="nome"> Nom:</label>
                    <input type="text" name="nome" placeholder="Nom" class="form-control"  />  
                    </div>
                        
                        <div class ="form-group">
                    <label for="prenome">Prénom:</label>
                    <input type="text" name="prenome" placeholder="Prénom" class="form-control"  />  
                    </div>
                        
                          <div class ="form-group">
                    <label for="numTel">Numéro de téléphone:</label>
                    <input type="text" name="numTel" placeholder="Numéro de téléphone" class="form-control"/>  
                    </div>
                        
                         <div class ="form-group">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" placeholder="E-mail" class="form-control"  />  
                    </div>
                          
                         <div class ="form-group">
                    <label for="email">Numéro personnel:</label>
                    <input type="text" name="numPer" placeholder="Numéro personnel" class="form-control"/>  
                    </div>
                       
                         <div class ="form-group">
                    <label for="email">Poste:</label>
                    <input type="text" name="poste" placeholder="Poste" class="form-control"  />  
                    </div>
                        
                    <div class ="form-group">
                        <label for="sexe">Sexe:</label>
                         <div class="radio">
                            <label><input type="radio" name="sexe" value="F" /> F </label><br>   
                            <label><input type="radio" name="sexe" value="M" checked/> M </label>  
                         </div>
                    </div>
                        
                     <div class ="form-group">
                    <label for="idService">Service:</label>
                        <select name="idService" class="form-control" id="idService">  
                          <?php while($service=$resultatS->fetch()){ ?>
                         <option value="<?php echo $service['idService'] ?>" >
                               <?php echo "Direction ".$service['nom']." - ".$service['designation'] ?>                                 
                          </option>                                                                          
                        <?php } ?>  
                    </select>         
                    </div> 
                    <div class ="form-group">
                    <label for="idBureau">Bureau:</label>
                        <select name="idBureau" class="form-control" id="idBureau">  
                          <?php while($bureau=$resultatB->fetch()){ 
                            ?>
                         <option value="<?php echo $bureau['idBureau'] ?>"  >
                               <?php echo $bureau['numBureau'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                    </select>         
                    </div> 
                        
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Enregister...</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>