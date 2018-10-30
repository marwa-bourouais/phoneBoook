<?php
  session_start();
if(isset($_SESSION['user']))   
{
  require_once("connexiondb.php");
    if(isset($_GET['size'])) $size=$_GET['size'];
  else $size=2;

  if(isset($_GET['page'])) $page=$_GET['page'];
  else $page=1;
  $offset=($page-1)*$size;
 
  if(isset($_GET['numb'])) $numb=$_GET['numb'];
  else $numb="";

if($numb!="")
{
      $requeteB="select * from service as s,bureau as b
      where  s.idService= b.idService 
      and numBureau like '%$numb'
      limit $size
       offset $offset";
    
    $requeteCountB="select count(idBureau) countS
      from bureau as b,service as s
      where b.idService=s.idService
      and b.numBureau like'$numb%'";

}
    else 
    {
     $requeteB="select * from service as s,bureau as b
      where s.idService= b.idService
      limit $size
       offset $offset";
        
        $requeteCountB="select count(idBureau) countS
      from bureau as b,service as s
      where  s.idService= b.idService";

    }
    

  $resultatB=$pdo->query($requeteB);
    $resultatCountB=$pdo->query($requeteCountB);
$tab_count=$resultatCountB->fetch();
$nb=$tab_count['countS'];
if ($nb==0){$erreurlogin="Erreur :  Bureau introuvable ! ";}
 $reste=$nb % $size;
  if($reste==0) $nbrePage= $nb/$size;
  else $nbrePage= floor($nb/ $size)+1;
}
else
{
    header('location:../index.php');
}


 
?>

<style>
    .rred
    { color:red; }
    .grreen
    {color:darkgreen;}
</style>

<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste des bureaux</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
        <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des bureaux</div>
            <div class="panel-body">
                <form method="get" action="bureaux.php" class="form-inline">
                   
                  <div class ="form-group ">
                      
                    <label for="numb">Numéro de bureau:</label>
                    <input type="text" name="numb" placeholder="Numéro de bureau" 
                           value="<?php echo $numb ?>" class="form-control"/>  
                      
                    </div>
                     &nbsp  &nbsp
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                    &nbsp
                    <a href="nouveaubureau.php">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouveau bureau</a>
                    
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des bureaux:</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Numéro de bureau</th>
                            <th>Nom du service</th>
                            <th>Numéros de téléphones</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($bureau=$resultatB->fetch()){
                        $idbu=$bureau['idBureau'];?>
                         <tr>
                             <td> <?php echo $bureau['numBureau'] ?>  </td>
                             <td>  <?php echo $bureau['designation']?>  </td>
                             <td> 
                                 <?php 
                                  $requeteT="select * from telephone";
                                  $resultatT=$pdo->query($requeteT);
                                   while($telephone=$resultatT->fetch())
                                   {
                                    if($telephone['idBureau']==$idbu)
                                    {
                                    if ($telephone['etat']==1)
                                        {?>
                                         <h4 class="grreen"> 
                                         <?php echo $telephone['numTel']."<br>"; ?> 
                                         </h4>
                                      <?php }
                                        else 
                                        { ?>
                                          <h4 class="rred"> 
                                         <?php echo $telephone['numTel']."<br>"; ?> 
                                         </h4>
                                      <?php  }
                                    }
                                   }
                               ?>    
                             </td>
                                <td>
                                 <a href="editerbureau.php?idb=<?php echo $idbu?>">
                                     <span class="glyphicon glyphicon-edit"></span> 
                                 </a>
                                 &nbsp  &nbsp
                                 <a onclick="return confirm('Etes vous sur de vouloir supprimer ce bureau?')"
                                    href="supprimerbureau.php?idb=<?php echo $idbu ?>">
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
                            <a href="bureaux.php?page=<?php echo $i; ?>&numb=<?php echo $numb;?>">
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