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
   
 
  if(isset($_GET['contact'])) $contact=$_GET['contact'];
  else $contact="";
     if(isset($_GET['idE'])) $idE=$_GET['idE'];
  else $idE=0;
      $requeteE="select * from externe";
if ($idE==0)
{
    $requeteS=" select * from externe as e , contact as c where e.idExterne=c.idExterne
        and (c.nom like '%$contact%' or c.prenom like '%$contact%')
      limit $size
      offset $offset";
   
     $requeteCountS="select COUNT(*) countS from externe as e , contact as c where e.idExterne=c.idExterne
        and (c.nom like '%$contact%'  or c.prenom like '%$contact%')";
}
     else{
      $requeteS=" select * from externe as e , contact as c where e.idExterne=c.idExterne
        and( ( c.nom like '%$contact%' or c.prenom like '%$contact%') and c.idExterne='$idE')
      limit $size
      offset $offset";
   
     $requeteCountS="select COUNT(*) countS from externe as e , contact as c where e.idExterne=c.idExterne
        and ((c.nom like '%$contact%' or c.prenom like '%$contact%' )and c.idExterne='$idE')";
     }
  
   $resultatE=$pdo->query($requeteE);
  $resultatS=$pdo->query($requeteS);
  $resultatCountS=$pdo->query($requeteCountS);
  $tabCountS=$resultatCountS->fetch();     
  $nbreContact=$tabCountS['countS'];
  $reste=$nbreContact % $size;
  if( $reste==0) $nbrePage= $nbreContact/ $size;
  else $nbrePage= floor($nbreContact/ $size)+1;
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
        <title>Liste des contacts externes </title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
        <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des contacts externes :</div>
            <div class="panel-body">
                <form method="get" action="externe.php" class="form-inline">
                   
                  <div class ="form-group ">
                      
                    <label for="entreprise">Entreprise :</label>
                     
                     <select name="idE" class="form-control" id="idE"> 
                        
<option value="<?php echo 0;?>" <?php if($idE==0)echo "selected" ?> >Toutes les entreprises </option>
<?php while($ent=$resultatE->fetch()){ ?>
 <option value="<?php echo $ent['idExterne']  ?>" 
         <?php if($idE==$ent['idExterne'])echo "selected" ?> >
     <?php echo $ent['rss'] ?> 
</option>                                                                        
<?php } ?>  
                    </select>
                      
                      
                    </div>
                    <div class ="form-group ">
                    <label for="contact"> contact :</label>
                    <input type="text" name="contact" placeholder="Nom ou prénom du contact " 
                           value="<?php echo $contact ?>" class="form-control"/>  
                    </div>
                    
                     &nbsp  &nbsp
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                    
                    &nbsp 
                    <a href="nouveauexterne.php">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouvelle entreprise </a>
                    
                    &nbsp
                    <a href="nouveaucontact.php">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouveau contact </a>
                      
                    &nbsp
                    <a class="red" href="supprimerexterne.php">
                        <span class="glyphicon glyphicon-trash"></span>
                        Supprimer entreprise</a>
                    
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des contacts externes : (<?php echo $nbreContact ?> contacts )</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Entreprise</th>
                            <th>Raison sociale </th>
                            <th> contact </th>
                            <th> Téléphone  </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($service=$resultatS->fetch()){ ?>
                         <tr>
                            <td> <?php echo $service['idExterne'] ?>  </td>
                             <td> <?php echo $service['rss'] ?>  </td>
                             <td> <?php echo $service['nom']." ".$service ['prenom'] ?>  </td>
                              <td> <?php echo $service['tel'] ?>  </td>
                             
                                <td>
                                 <a href="editercontact.php?idC=<?php echo $service['idContact'] ?>">
                                     <span class="glyphicon glyphicon-edit"></span> 
                                 </a>
                                 &nbsp  &nbsp
                                 <a onclick="return confirm('Etes vous sur de vouloir supprimer ce contact ?')"
                                    href="supprimercontact.php?idC=<?php echo $service['idContact'] ?>">
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
                            <a href="externe.php?page=<?php echo $i; ?>&contact=
                           <?php echo $contact;?>&idE=<?php echo $idE;?>">
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