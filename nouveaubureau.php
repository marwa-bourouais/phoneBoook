<?php 
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");
$requeteS="select * from service as s , direction as d where s.idDirection=d.idDirection ";
$resultatS=$pdo->query($requeteS);
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
        <title>Nouveau bureau</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez saisir les données du nouveau bureau:</div>
            <div class="panel-body">
                <form method="post"  action="insertbureau.php" class="form">   
                    
                    <div class ="form-group">
                    <label for="idService">Service:</label>
                         
                    <select name="idService" class="form-control" id="idService">  
                          <?php while($service=$resultatS->fetch()){ ?>
                         <option value="<?php echo $service['idService'] ?>" >
                               <?php echo $service['nom']."-".$service['designation'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                    </select> 
                    </div>
                    
                    
                    <div class ="form-group">
                      
                    <label for="numb"> Numéro du bureau:</label>
                    <input type="text" name="numb" placeholder="numero de bureau" 
                          class="form-control"/>  
                      
                    </div>
                     <div class ="form-group">
                    <label for="numT"> Numéro de Telephone :</label>
                    <input type="text" name="numT" placeholder="numero de telephone" 
                          class="form-control"/>  
                      </div>
                    
                    &nbsp; &nbsp;
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Enregistrer...</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>