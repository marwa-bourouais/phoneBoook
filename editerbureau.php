<?php

 session_start();
if(isset($_SESSION['user']))   
{
  require_once("connexiondb.php");

 $idb=isset($_GET['idb'])? $_GET['idb']:0;
      
$requete="select * from bureau where idBureau='$idb'";
$resultat=$pdo->query($requete);
$bureau=$resultat->fetch();
$numb=$bureau['numBureau'];
$idService=$bureau['idService'];

$requeteS="select * from service as s , direction as d where s.idDirection=d.idDirection ";
$resultatS=$pdo->query($requeteS);

$requeteT="select * from telephone where idBureau='$idb'";
$resultatT=$pdo->query($requeteT);
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
       <title>Edition d'un bureau </title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Edition du bureau:</div>
            <div class="panel-body">
                <form method="post"  action="updatebureau.php" class="form" enctype="multipart/form-data">   
                    <div class="group-control">
                        
                     <div class ="form-group ">   
                    <label for="idb"> ID du bureau: <?php echo $idb ?></label>
                    <input type="hidden" name="idb" class="form-control" value="<?php echo $idb ?>"/>  
                    </div>
                      
                           
                     <div class ="form-group ">   
                    <label for="numb"> Numéro de bureau:</label>
                    <input type="text" name="numb" class="form-control" value="<?php echo $numb ?>"/>  
                    </div>
                              
                     <div class ="form-group ">   
                    <label for="numTel"> Numéro de téléphone:</label>
                 
                         
        
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des numéros</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> Numéro de téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($tel=$resultatT->fetch()){ ?>
                         <tr class="<?php echo $tel['etat']==1? 'success' :'danger' ?>">
                            <td> <?php echo $tel['numTel'] ?>  </td>
                             <td> 
                                  <a href="activertel.php?idt=<?php echo $tel['idTel'] ?>&etat=<?php echo $tel['etat']?>">
                                 <?php if($tel['etat']==1) 
                                echo  '<span class="glyphicon glyphicon-remove"></span>';
                                 else if ($tel['etat']==0) 
                                 echo '<span class="glyphicon glyphicon-ok"></span>';
                                   ?>
                                 </a>
                                 &nbsp; &nbsp;
                                 <a onclick="return confirm('Etes vous sur de vouloir supprimer ce numéro?')"
                                    href="supprimertel.php?idt=<?php echo $tel['idTel'] ?>">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                 </a>
                                 
                             </td>
                        </tr>
                            <?php } ?>
                            
                        
                    </tbody>
                </table>

                <a href="ajoutertel.php?idb=<?php echo $idb ?> "> <span class="glyphicon glyphicon-plus"></span> Ajouter un numéro </a>
            </div>
        </div>
                         
                    </div>
                        
                     <div class ="form-group">
                    <label for="idService">Service:</label>
                         
                    <select name="idService" class="form-control" id="idService">  
                          <?php while($service=$resultatS->fetch()){ ?>
                         <option value="<?php echo $service['idService'] ?>" 
                        <?php if($idService===$service['idService'])  echo "selected" ?> >
                               <?php echo $service['nom']." - ".$service['designation'] ?>                                 
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