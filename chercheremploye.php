<?php
    require_once("connexiondb.php");
if(isset($_GET['size'])) $size=$_GET['size'];
  else $size=2;

  if(isset($_GET['page'])) $page=$_GET['page'];
  else $page=1;
  $offset=($page-1)*$size;
 if(isset($_GET['ids'])) $ids=$_GET['ids'];
  else $ids=0;

  
 if(isset($_GET['numb'])) $numb=$_GET['numb'];
  else $numb="";

if($numb!=0)
{
$tab=str_split($numb);
$length=sizeof($tab);
$i=0;
$k=0;
if($tab[0]=='0')
{
    while($tab[$i]=='0')
        {
        $i++;
        }
    for($j=$i;$j<($length);$j++)
        {
    $res[$k]=$tab[$j];
    $k++;
        }
$numb=implode('',$res);
}}
else if(is_numeric($numb))
{ 
    if($numb==0)$numb='0';
}


 if(isset($_GET['nomprenom'])) $nomprenom=$_GET['nomprenom'];
  else $nomprenom="";

$requete="select * from service ";
if ($ids!=0){
   $requeteE="select *
      from employe as e,bureau as b, service as s , direction as d 
      where e.idBureau=b.idBureau and b.idService=s.idService and s.idDirection=d.idDirection
      and ((nomEmploye like '%$nomprenom%' or prenomEmploye like '%$nomprenom%')
      and numBureau like '$numb%' 
      and s.idService='$ids')
      order by s.idService 
      limit $size
       offset $offset";

    $requeteCountE="select count(*) countE
      from employe as e,bureau as b, service as s 
      where e.idBureau=b.idBureau and b.idService=s.idService 
      and((nomEmploye like '%$nomprenom%' or prenomEmploye like '%$nomprenom%')
      and numBureau like'$numb%'
      and s.idService='$ids')
      ";
}
else
{
     $requeteE="select *
      from employe as e,bureau as b, service as s , direction as  d
      where e.idBureau=b.idBureau and b.idService=s.idService and s.idDirection=d.idDirection
      and ((nomEmploye like '%$nomprenom%' or prenomEmploye like '%$nomprenom%')
      and numBureau like '$numb%')
      order by s.idService 
      limit $size
       offset $offset";

    $requeteCountE="select count(*) countE
      from employe as e,bureau as b, service as s
      where e.idBureau=b.idBureau and b.idService=s.idService
      and((nomEmploye like '%$nomprenom%' or prenomEmploye like '%$nomprenom%')
      and numBureau like'$numb%')";
}
$resultat=$pdo->query($requete);
$resultatE=$pdo->query($requeteE);
$resultatCountE=$pdo->query($requeteCountE);
$tab_count=$resultatCountE->fetch();
$nb=$tab_count['countE'];
if ($nb==0){$erreurlogin="<strong>Aucun employé!</strong> ";}
if ($nb==0){$erreurlogin="<strong>Aucun service!</strong> ";}
  $reste=$nb % $size;
  if( $reste==0) $nbrePage= $nb/ $size;
  else $nbrePage= floor($nb/ $size)+1;

 
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
          <?php include ("cherchermenu.php"); ?>
        <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Recherche des numéros des employés:</div>
            <div class="panel-body">
                <form method="get" action="chercheremploye.php" >
                   
                   <div class ="form-group">
                      <?php if(!empty($erreurlogin)){ ?>
                     <div class="alert alert-danger ">
                    <?php echo $erreurlogin; ?>
                    </div>
                   <?php } ?>
                    </div> 
                   
                    <div class ="form-group  form-inline">
                         <label for="ids">Service:</label>       
               <select name="ids" class="form-control" id="ids"> 
                        
<option value="<?php echo 0;?>" <?php if($ids==0)echo "selected" ?> >Tous les services</option>
<?php while($service=$resultat->fetch()){ ?>
 <option value="<?php echo $service['idService']  ?>" 
         <?php if($ids==$service['idService'])echo "selected" ?> >
     <?php echo $service['designation'] ?> 
</option>                                                                        
<?php } ?>  
                        </select>
                      
                       &nbsp; &nbsp;  
                         <label for="numb">Numéro du bureau:</label>
                    <input type="text" name="numb" placeholder="Numéro du bureau:" 
                           value="<?php echo $numb ?>" class="form-control"/>
                     &nbsp; &nbsp;    
                         <label for="nomprenom">Nom/Prénom:</label>
                    <input type="text" name="nomprenom" placeholder="Nom/Prénom" 
                           value="<?php echo $nomprenom ?>" class="form-control"/>
                   &nbsp; &nbsp;
                
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                      </div>

                </form>
            </div>
        </div>
<?php if( $nb!=0){ ?>
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des employés</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                             <th>direction</th>
                            <th>Service</th>
                            <th>Bureau</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Numéro de téléphone</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($employe=$resultatE->fetch()){ ?>
                         <tr>
                             <td> <?php echo $employe['nom']  ?>
                            <td> <?php echo $employe['designation']  ?>  </td>
                            <td> <?php echo $employe['numBureau']  ?>  </td>
                            <td> <?php echo $employe['nomEmploye']  ?>  </td>
                             <td> <?php echo $employe['prenomEmploye']  ?>  </td>
                             <td> <?php echo $employe['numTel']  ?>  </td>
                             <td>
                                 <a href="detailsemploye.php?ide=<?php echo $employe['idEmploye']?>">
                                     <span class="glyphicon glyphicon-inbox"></span> Consulter détails
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
                            <a href="chercheremploye.php?page=<?php echo $i; ?>&ids=
                           <?php echo $ids;?>&numb=<?php echo $numb;?>">
                           <?php echo $i;?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                    
                </div>
            </div>
        </div>
            <?php } ?>
        </div>
        
    </body>
</html>