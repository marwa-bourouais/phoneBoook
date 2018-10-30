<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
  require_once("connexiondb.php");
  if(isset($_GET['size'])) $size=$_GET['size'];
  else $size=6;

  if(isset($_GET['page'])) $page=$_GET['page'];
  else $page=1;
  $offset=($page-1)*$size;
   
 
  if(isset($_GET['Service'])) $noms=$_GET['Service'];
  else $noms="";
     if(isset($_GET['direction'])) $dir=$_GET['direction'];
  else $dir="";

      $requeteS=" select * from service as s , direction as d where s.idDirection=d.idDirection
        and(  designation like '%$noms%' and  nom like '%$dir%')
      limit $size
      offset $offset";
   
     $requeteCountS=" select COUNT(*) countS from service as s , direction as d where s.idDirection=d.idDirection
        and(  designation like '%$noms%' and  nom like '%$dir%')";
  
  $resultatS=$pdo->query($requeteS);
  $resultatCountS=$pdo->query($requeteCountS);
  $tabCountS=$resultatCountS->fetch();     
  $nbreService=$tabCountS['countS'];
  $reste=$nbreService % $size;
  if( $reste==0) $nbrePage= $nbreService/ $size;
  else $nbrePage= floor($nbreService/ $size)+1;
 }
else
{
    header('location:../index.php');
}
 
?>
<style>
    .red
    { color:red;

}
</style>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste des services</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
        <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des services</div>
            <div class="panel-body">
                <form method="get" action="services.php" class="form-inline">
                   
                  <div class ="form-group ">
                      
                    <label for="Service">Service:</label>
                    <input type="text" name="Service" placeholder="le nom du service" 
                           value="<?php echo $noms ?>" class="form-control"/>  
                      
                    </div>
                    
                    <div class ="form-group ">
                      
                    <label for="direction"> Direction:</label>
                    <input type="text" name="direction" placeholder="le nom de la direction" 
                           value="<?php echo $dir ?>" class="form-control"/>  
                      
                    </div>
                     &nbsp  &nbsp
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                    &nbsp
                    <a href="nouveauservice.php">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouveau service</a>
                    
                    &nbsp
                    <a href="nouvelledirection.php">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouvelle direction</a>
                      
                    &nbsp
                    <a class="red" href="supprimerdirection.php">
                        <span class="glyphicon glyphicon-trash"></span>
                        Supprimer direction</a>
                    
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des services(<?php echo $nbreService ?> services)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Service</th>
                            <th>Direction</th>
                            <th> Nom du service</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($service=$resultatS->fetch()){ ?>
                         <tr>
                            <td> <?php echo $service['idService'] ?>  </td>
                             <td> <?php echo $service['nom'] ?>  </td>
                             <td> <?php echo $service['designation'] ?>  </td>
                                <td>
                                 <a href="editerservice.php?ids=<?php echo $service['idService'] ?>">
                                     <span class="glyphicon glyphicon-edit"></span> 
                                 </a>
                                 &nbsp  &nbsp
                                 <a onclick="return confirm('Etes vous sur de vouloir supprimer ce service?')"
                                    href="supprimerservice.php?ids=<?php echo $service['idService'] ?>">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                 </a>
                             </td>
                        </tr>
                            <?php } ?>
                            
                        
                    </tbody>
                </table>
                <div>
                    <ul class="pagination pagination-md">
                     <?php for($i=1; $i<=$nbrePage;$i++)
                      { ?>
                        <li class="<?php if($i==$page) echo 'active' ?>" >
                            <a href="services.php?page=<?php echo $i; ?>&Service=
                           <?php echo $noms;?>">
                           <?php echo $i;?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                    
                </div>
            </div>
        </div>
        </div>
        
    </body>
</html>