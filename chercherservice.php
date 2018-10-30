<?php

  require_once("connexiondb.php");

if(isset($_GET['size'])) $size=$_GET['size'];
  else $size=10;

  if(isset($_GET['page'])) $page=$_GET['page'];
  else $page=1;
  $offset=($page-1)*$size;
 
  if(isset($_GET['Service'])) $noms=$_GET['Service'];
  else $noms="";
 if(isset($_GET['ids'])) $ids=$_GET['ids'];
  else $ids=0;

 if(isset($_GET['idd'])) $idd=$_GET['idd'];
  else $idd=0;

       if ($ids==0 && $idd==0)
       {
         $requeteS="select * from service  as s , direction as d where s.idDirection=d.idDirection and 
        designation like '%$noms%' 
        limit $size
       offset $offset"; 
         $requeteCountS="select count(*) countS from service where designation like '%$noms%' ";
       }
       else
       {  if ($ids==0 && $idd!=0)
       {
       
            $requeteS="select * from service as s , direction as d  where s.idDirection =d.idDirection and  (designation like '%$noms%'
            and d.idDirection='$idd'  )
            limit $size
            offset $offset";
           $requeteCountS="select count(*) countS from direction where idDirection='$idd'";
       
       }
        if ($ids!=0 && $idd==0)
       {
       
            $requeteS="select * from service as s , direction as d  where s.idDirection =d.idDirection and  (designation like '%$noms%'
            and s.idService='$ids')
            limit $size
            offset $offset";
           $requeteCountS="select count(*) countS from service where
           designation like '%$noms%' and idService='$ids'";
       
       }
        if ($ids!=0 && $idd!=0)
       {
       
            $requeteS="select * from service as s , direction as d  where s.idDirection =d.idDirection and  (designation like '%$noms%'
            and (s.idService='$ids' and s.idDirection='$idd') )
            limit $size
            offset $offset";
           $requeteCountS="select count(*) countS from service where designation like '%$noms%' and( idDirection='$idd' and idService='$ids')";
       
       }
     }
$requete="select * from service";
$requeteD="select * from direction";
$resultat=$pdo->query($requete);
$resultatS=$pdo->query($requeteS);
$resultatD=$pdo->query($requeteD);
$resultatCountS=$pdo->query($requeteCountS);
$tab_count=$resultatCountS->fetch();
$nb=$tab_count['countS'];
if ($nb==0){$erreurlogin="<strong>Aucun service!</strong> ";}
  $reste=$nb % $size;
  if( $reste==0) $nbrePage= $nb/ $size;
  else $nbrePage= floor($nb/ $size)+1;
 
?>


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
        <?php include ("cherchermenu.php"); ?>
        <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Recherche des services</div>
            <div class="panel-body">
                <form method="get" action="chercherservice.php" >
                   <?php if ($nb==0)
                   {    ?>
                    <div class ="form-group ">
                      <?php if(!empty($erreurlogin)){ ?>
                     <div class="alert alert-danger ">
                    <?php echo $erreurlogin; ?>
                    </div>
                   <?php } ?>
                    </div> 
                    <?php } ?>
                  <div class ="form-group  form-inline">
                      
                    <label for="Service">Recherche:</label>
                    <input type="text" name="Service" placeholder="le nom du service" 
                           value="<?php echo $noms ?>" class="form-control"
                           id="Service" autocomplete="off"/>  
                      
                   
                     &nbsp  &nbsp
                      <label for="ids">Service :</label>
                     
                     <select name="ids" class="form-control" id="ids"> 
                        
<option value="<?php echo 0;?>" <?php if($ids==0)echo "selected" ?> >Tous les services</option>
<?php while($service=$resultat->fetch()){ ?>
 <option value="<?php echo $service['idService']  ?>" 
         <?php if($ids==$service['idService'])echo "selected" ?> >
     <?php echo $service['designation'] ?> 
</option>                                                                        
<?php } ?>  
                    </select>
                      
                      &nbsp  &nbsp
                      <label for="idd">Direction :</label>
                     
                     
                     <select name="idd" class="form-control" id="idd"> 
                        
<option value="<?php echo 0;?>" <?php if($idd==0)echo "selected" ?> >Toutes  les directions</option>
<?php while($direction=$resultatD->fetch()){ ?>
 <option value="<?php echo $direction['idDirection']  ?>" 
         <?php if($idd==$direction['idDirection'])echo "selected" ?> >
     <?php echo $direction['nom'] ?> 
</option>                                                                        
<?php } ?>  
                    </select>
                      
                   
                     &nbsp  &nbsp
                      
                    <div class ="form-group ">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                     </div>
                        </div>
                    
                </form>
            </div>
        </div>
        <?php if ($nb!=0) {?>
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des services</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Direction</th>
                            <th> Nom du service</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($service=$resultatS->fetch()){ ?>
                         <tr>
                            <td> <?php echo $service['nom'] ?>  </td>
                             <td> <?php echo $service['designation'] ?>  </td>
                                
                        </tr>
                            <?php } ?>
                                      
                    </tbody>
                </table>
                 <div>
                    <ul class="pagination pagination-md">
                     <?php for($i=1; $i<=$nbrePage;$i++)
                      { ?>
                        <li class="<?php if($i==$page) echo 'active' ?>" >
                            <a href="chercherservice.php?page=<?php echo $i; ?>&ids=
                           <?php echo $ids;?>&idd=<?php echo $idd;?>&Service=<?php echo $noms;?>">
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

<script>
 $(document).ready(function(){
  
$('#Service').typeahead({
     source: function(query,result)
    {
        $.ajax({
            url:"chercherservice.php",
            method:"POST",
            data:{query:query},
            dataType:"json",
            success:function(data)
            {
                result($.map(data,function(item){
                    return item;
                    
                }));
            }
        })
    }
 });                               
});
    
</script>