<?php
 

    require_once("connexiondb.php");

if(isset($_GET['size'])) $size=$_GET['size'];
  else $size=7;

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

/********************/

      $requete="select * from service";
 if ($ids!=0){
      $requeteB="select numBureau,designation,idBureau, nom 
      from bureau as b, service as s, direction as d 
      where b.idService=s.idService and s.idDirection=d.idDirection 
      and (b.numBureau like'$numb%'
      and b.idService ='$ids')
      limit $size
       offset $offset";

      $requeteCountB="select count(idBureau) countS
      from bureau as b,service as s
      where b.idService=s.idService
      and (b.numBureau like'$numb%'
      and b.idService='$ids')";
         }
   else
   {
       $requeteB="select numBureau,designation,idBureau,nom
      from bureau as b, service as s , direction as d 
      where b.idService=s.idService  and s.idDirection=d.idDirection 
      and b.numBureau like'$numb%'
      limit $size
       offset $offset";

      $requeteCountB="select count(idBureau) countS
      from bureau as b,service as s
      where b.idService=s.idService
      and b.numBureau like'$numb%'";
   }
$resultat=$pdo->query($requete);
$resultatB=$pdo->query($requeteB);
$resultatCountB=$pdo->query($requeteCountB);
$tab_count=$resultatCountB->fetch();
$nb=$tab_count['countS'];

 $reste=$nb % $size;
  if( $reste==0) $nbrePage= $nb/ $size;
  else $nbrePage= floor($nb/ $size)+1;

 
?>
<style>
    .rred
    { color:red; }
    .grreen
    { color:darkgreen; }
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
          <?php include ("cherchermenu.php"); ?>
        <div class="container">
            
        <div class="panel panel-primary margetop ">
            <div class="panel-heading">Recherche des numéros de bureaux :</div>
            <div class="panel-body">
                <form method="get" action="chercherbureau.php" >
                   
                  <div class ="form-group form-inline">
                      <?php if(!empty($erreurlogin)){ ?>
                     <div class="alert alert-danger ">
                    <?php echo $erreurlogin; ?>
                    </div>
                   <?php } ?>
                      
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
                      
                    &nbsp;&nbsp;
                        <label for="numb">Numéro du bureau:</label>
                    <input type="text" name="numb" placeholder="Numéro du bureau" 
                           value="<?php echo $numb ?>" class="form-control"/> 
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                     

                      </div>
                </form>
            </div>
        </div>
           
<?php if($nb!=0) 
{?>
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des bureaux:</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Direction</th>
                            <th>Service</th>
                            <th>Numéro du bureau</th>
                            <th>Numéros de téléphones</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($bureau=$resultatB->fetch()){ ?>
                         <tr>
                             <td> <?php echo $bureau['nom']  ?>  </td>
                            <td> <?php echo $bureau['designation']  ?>  </td>
                            <td> <?php echo $bureau['numBureau']  ?>  </td>
                            <td><?php 
                            $requeteT="select * from telephone";
                            $resultatT=$pdo->query($requeteT);
                            while( $telephone=$resultatT->fetch() ){
                               if ($telephone['idBureau']==$bureau['idBureau'])
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
                             } ?>
                           
                             </td>
                        </tr>
                            <?php  } ?>
                            
                    </tbody>
                </table>
                 <ul class="pagination pagination-md">
                     <?php for($i=1; $i<=$nbrePage;$i++)
                      { ?>
                        <li class="<?php if($i==$page) echo 'active' ?>" >
                            <a href="chercherbureau.php?page=<?php echo $i; ?>&ids=
                           <?php echo $ids;?>&numb=<?php echo $numb;?>">
                           <?php echo $i;?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
            </div>
        </div>
       
     <?php   }
                           else {
                
                 echo ""; }?>
                    
                      
                   
                     
                          
            
            
            
             </div>
    </body>
</html>