<?php

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
$idb=$employe['idBureau'];

$requeteB="select * from bureau where idBureau='$idb'";
$resultatB=$pdo->query($requeteB);
$bureau=$resultatB->fetch();
$ids=$bureau['idService'];
$numb=$bureau['numBureau'];

$requeteS="select * from service where idService='$ids'";
$resultatS=$pdo->query($requeteS);
$service=$resultatS->fetch();
$noms=$service['designation'];
$idDir=$service['idDirection'];

$requeteD="select * from direction where idDirection='$idDir'";
$resultatD=$pdo->query($requeteD);
$direction=$resultatD->fetch();
$dir=$direction['nom'];

?>


<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
    <title>Cordonnées de l'employé</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
       
       <div class="container margetop">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez consulter les coordonnées de l'employé:</div>
            <div class="panel-body">   
                    <div class="group-control">
                     <div class ="form-group  ">
                    <label > ID de l'employé :<?php echo $ide ?></label> 
                    </div>
                        <div class ="form-group ">
                    <label for="photo"> Photo de l'employé:</label><br>
                    <img name="photo" src="../images/<?php echo $photo ?>" height=100px width=200px>
                    </div>
            
                      <div class ="form-group">
                          <label> Nom et prénom: <t></t> <?php echo $nome ?><t></t>
                              <?php echo $prenome ?> </label>
                    </div>
                        
                        
                          <div class ="form-group">
                    <label for="numTel">Numéro de téléphone: <t></t><?php echo  $numTel ?></label> 
                    </div>
                        
                         <div class ="form-group">
                    <label for="email">E-mail: <t></t><?php echo $email ?></label>  
                    </div>
                          
                         <div class ="form-group">
                    <label for="email">Numéro personnel: <t></t><?php echo $numPer ?></label>
                    </div>
                       
                         <div class ="form-group">
                    <label for="email">Poste: <t></t><?php echo $poste ?></label>
                    </div>
                        
                    <div class ="form-group">
                        <label for="sexe">Sexe:</label>
                            <label>
                            <?php if($sexe==="F") echo "Féminin";
                                else if($sexe==="M") echo "Masculin";?>
                            </label>  
                    </div>
                        
                     <div class ="form-group">
                     <label for="email">Bureau: <t></t><?php echo $numb ?></label>      
                    </div>
                        
                    <div class ="form-group">
                     <label for="email">Service: <t></t><?php echo $noms ?></label>      
                    </div>
                              
                    <div class ="form-group">
                     <label for="email">Direction: <t></t><?php echo $dir ?></label>      
                    </div>
                        
                        
                        
                 <h4 > <a href="<?php echo $_SERVER['HTTP_REFERER']?>" class="form-control"
                         >Retour >>></a></h4>
                   </div>    
              
            </div>
        </div>
        </div>
    </body>
</html>