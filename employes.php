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

 if(isset($_GET['numb'])) $numb=$_GET['numb'];
  else $numb="";

 if(isset($_GET['nomPrenom'])) $nomPrenom=$_GET['nomPrenom'];
  else $nomPrenom="";
      if ($numb!="")
      {
      $requeteE="select idEmploye,nomEmploye,prenomEmploye,numTel,photo,NumBureau,designation,fonction
      from employe as e,bureau as b, service as s, direction as d 
      where ((e.idBureau=b.idBureau and b.idService=s.idService )and (s.idDirection=d.idDirection))
      and (nomEmploye like '%$nomPrenom%' or prenomEmploye like '%$nomPrenom%')
      and numBureau='$numb'
      and (designation like '%$noms%' or nom like '%$noms%')
      order by idEmploye
      limit $size
      offset $offset"; 
     $requeteCountE="select count(idEmploye) countE
      from employe as e,bureau as b, service as s, direction as d 
      where e.idBureau=b.idBureau and b.idService=s.idService and  s.idDirection=d.idDirection
      and ((nomEmploye like '%$nomPrenom%' or prenomEmploye like '%$nomPrenom%')
      and numBureau ='$numb%'
      and (designation like '%$noms%' or nom like '%$noms%'))";
      }
    else
    {
      $requeteE="select idEmploye,nomEmploye,prenomEmploye,numTel,photo,NumBureau,designation,fonction
      from employe as e,bureau as b, service as s, direction as d 
      where e.idBureau=b.idBureau and b.idService=s.idService and s.idDirection=d.idDirection
      and (nomEmploye like '%$nomPrenom%' or prenomEmploye like '%$nomPrenom%')
      and (designation like '%$noms%' or nom like '%$noms%')
      order by idEmploye
      limit $size
      offset $offset"; 
     $requeteCountE="select count(idEmploye) countE
      from employe as e,bureau as b, service as s,direction as d 
      where e.idBureau=b.idBureau and b.idService=s.idService and s.idDirection=d.idDirection
      and (nomEmploye like '%$nomPrenom%' or prenomEmploye like '%$nomPrenom%')
      and (designation like '%$noms%' or nom like '%$noms%')"; 
    }
  $resultatE=$pdo->query($requeteE);
  $resultatCountE=$pdo->query($requeteCountE);
  $tabCountE=$resultatCountE->fetch();     
  $nbreEmploye=$tabCountE['countE'];
  $reste=$nbreEmploye % $size;
  if( $reste===0) $nbrePage= $nbreEmploye/ $size;
  else $nbrePage= floor($nbreEmploye/ $size)+1;
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
        <title>Liste des employés</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
        <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des employés</div>
            <div class="panel-body">
                <form method="get" action="employes.php" class="form-inline">
                   
                  <div class ="form-group ">
                      <label for="Service">Direction / Service :</label>
                    <input type="text" name="Service" placeholder="nom du service /Direction " 
                           value="<?php echo $noms ?>" class="form-control"/>
                      
                      &nbsp; 
                        <label for="numb">Numéro de bureau:</label>
                    <input type="text" name="numb" placeholder="Numéro de bureau" 
                           value="<?php echo $numb ?>" class="form-control"/>
                    </div>
                 
                     &nbsp;
                      <label for="nomPrenom">Nom/prénom:</label>
                    <input type="text" name="nomPrenom" placeholder="Nom et prénom" 
                           value="<?php echo $nomPrenom ?>" class="form-control"/>
                     &nbsp;
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                  <br>
                      <br>
                    <div class ="form-group ">
                    <a href="nouvelEmploye.php">
                        <span class="glyphicon glyphicon-plus"></span>
                        Nouvel employé</a>
                     </div>
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des employés(<?php echo $nbreEmploye ?> employés)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id Employé</th>
                            <th> Nom</th>
                            <th>Prénom</th>
                            <th>Poste</th> 
                            <th>Numéro</th> 
                            <th>photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($employe=$resultatE->fetch()){ ?>
                         <tr>
                            <td> <?php echo $employe['idEmploye'] ?>  </td>
                            <td> <?php echo $employe['nomEmploye']  ?>  </td>
                             <td> <?php echo $employe['prenomEmploye']  ?>  </td>
                              <td> <?php echo $employe['fonction']  ?>  </td>
                             <td> <?php echo $employe['numTel']  ?>  </td>
                             <td><img src="../images/<?php echo $employe['photo']?>" width=70px height=70px  
                                      class="img-circle" ></td>
                             <td> 
                                 <a href="detailsemploye.php?ide=<?php echo $employe['idEmploye'] ?>">
                                     <span class="glyphicon glyphicon-inbox"></span> Consulter détails
                                 </a>
                                 <br>
                                 <a href="editeremploye.php?ide=<?php echo $employe['idEmploye'] ?>">
                                     <span class="glyphicon glyphicon-edit"></span> Modifier
                                 </a>
                                 <br>
                                 <a onclick="return confirm('Etes vous sur de vouloir supprimer cet employé?')"
                                    href="supprimeremploye.php?ide=<?php echo $employe['idEmploye'] ?>">
                                    <span class="glyphicon glyphicon-trash"></span> Supprimer
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
                            <a href="employes.php?page=<?php echo $i; ?>&nomPrenom=<?php echo $nomPrenom; ?>">
                                <?php echo $i; ?>
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