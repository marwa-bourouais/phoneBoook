<?php
  session_start();
if(isset($_SESSION['user']))   
{
  require_once("connexiondb.php");
 $ide=isset($_GET['ide'])? $_GET['ide']:0;
 
$requete="select * from employe where idEmploye='$ide'";
$resultat=$pdo->query($requete);
$employe=$resultat->fetch();

$nome=$employe['nomEmploye'];
$prenome=$employe['prenomEmploye'];
$numTel=$employe['numTel'];
$email=$employe['email'];
$numPer=$employe['numPer'];
$poste=$employe['fonction'];
$sexe=strtoupper($employe['sexe']);
$photo=$employe['photo'];
$idBureau=$employe['idBureau'];
    
$requeteS="select * from service as s , direction as d where s.idDirection=d.idDirection";
$resultatS=$pdo->query($requeteS);

$requeteV="select * from bureau where idBureau='$idBureau'";
$resultatV=$pdo->query($requeteV);
$bureauV=$resultatV->fetch();
$idService=$bureauV['idService'];

$requeteB="select * from bureau";
$resultatB=$pdo->query($requeteB);
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
    <title>Edition d'un employé </title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Edition de l'employé:</div>
            <div class="panel-body">
                <form method="post"  action="updateemploye.php" class="form" enctype="multipart/form-data">   
                    <div class="group-control">
                     <div class ="form-group ">
                    <label for="ide"> ID de l'employé :<?php echo $ide ?></label>
                    <input type="hidden" name="ide" class="form-control" value="<?php echo $ide ?>"/>  
                    </div>
                        <div class ="form-group ">
                    <label for="photo"> Photo de l'employé:</label>
                    <input type="file" name="photo" />  
                    </div>
            
                      <div class ="form-group">
                    <label for="nome"> Nom:</label>
                    <input type="text" name="nome" placeholder="Nom" class="form-control"  value="<?php echo $nome ?>" />  
                    </div>
                        
                        <div class ="form-group">
                    <label for="prenome">Prénom:</label>
                    <input type="text" name="prenome" placeholder="Prénom" class="form-control"  value="<?php echo $prenome ?>" />  
                    </div>
                        
                          <div class ="form-group">
                    <label for="numTel">Numéro de téléphone:</label>
                    <input type="text" name="numTel" placeholder="Numéro de téléphone" class="form-control"  value="<?php echo $numTel ?>" />  
                    </div>
                        
                         <div class ="form-group">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" placeholder="E-mail" class="form-control"  value="<?php echo $email ?>" />  
                    </div>
                          
                         <div class ="form-group">
                    <label for="email">Numéro personnel:</label>
                    <input type="text" name="numPer" placeholder="Numéro personnel" class="form-control"  value="<?php echo $numPer ?>" />  
                    </div>
                       
                         <div class ="form-group">
                    <label for="email">Poste:</label>
                    <input type="text" name="poste" placeholder="Poste" class="form-control"  value="<?php echo $poste ?>" />  
                    </div>
                        
                    <div class ="form-group">
                        <label for="sexe">Sexe:</label>
                         <div class="radio">
                            <label><input type="radio" name="sexe" value="M"
                             <?php if($sexe==="M") echo "checked"?>/> Homme </label> <br>
                            <label><input type="radio" name="sexe" value="F"
                            <?php if($sexe==="F") echo "checked" ?>/> Femme </label>   
                           
                         </div>
                    </div>
                        
                     <div class ="form-group">
                    <label for="idService">Service:</label>
                         
                    <select name="idService" class="form-control" id="idService">  
                          <?php while($service=$resultatS->fetch()){ ?>
                         <option value="<?php echo $service['idService'] ?>" 
                        <?php if($idService==$service['idService'])  echo "selected" ?> >
                               <?php echo $service['nom']." - ".$service['designation'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                    </select>            
                    </div>
                        
                          <div class ="form-group">
                    <label for="idBureau">Bureau:</label>
                         
                    <select name="idBureau" class="form-control" id="idBureau">  
                          <?php while($bureau=$resultatB->fetch()){ ?>
                         <option value="<?php echo $bureau['idBureau'] ?>" 
                        <?php if($idBureau==$bureau['idBureau'])  echo "selected" ?> >
                               <?php echo $bureau['numBureau'] ?>                                 
                          </option>                                                                            
                        <?php } ?>  
                    </select>
                               
                    </div>
                        
                        
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