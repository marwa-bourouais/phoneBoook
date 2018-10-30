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
   
  if(isset($_GET['login'])) $login=$_GET['login'];
  else $login="";
    
      $requeteU="select * from utilisateur where login like '%$login%'
      limit $size
      offset $offset";
   
     $requeteCountU="select count(idUser) countU from utilisateur where login like '%$login%'";
  
  $resultatU=$pdo->query($requeteU);    
  $resultatCountU=$pdo->query($requeteCountU);
  $tabCountU= $resultatCountU->fetch();     
  $nbreUser=$tabCountU['countU'];
  $reste=$nbreUser% $size;
  if( $reste===0) $nbrePage= $nbreUser/ $size;
  else $nbrePage= floor($nbreUser/ $size)+1;
 
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
        <title>Gestion des utilisateurs</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
        <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Recherche des utiliateurs</div>
            <div class="panel-body">
                <form method="get" action="utilisateurs.php" class="form-inline">
                   
                  <div class ="form-group ">
                    <label for="login">Nom d'utilisateur:</label>
                    <input type="text" name="login" placeholder="Nom d'utilisateur" 
                           value="<?php echo $login ?>" class="form-control"/>
                      </div>  

                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"> </span>
                        Chercher...</button>
                    
                </form>
            </div>
        </div>
        
        <div class="panel panel-primary ">
            <div class="panel-heading">Liste des utilisateurs(<?php echo $nbreUser ?> utilisateurs)</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> Nom d'utilisateur</th>
                            <th>E-mail</th>
                            <th>Mot de passe</th> 
                            <th>ID de l'employé</th>                                                       
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($user=$resultatU->fetch()){ ?>
                         <tr class="<?php echo $user['etat']==1? 'success' :'danger' ?>">
                            <td> <?php echo $user['login'] ?>  </td>
                            <td> <?php echo $user['email']  ?>  </td>
                              <td> <?php echo $user['pwd']  ?>  </td>
                             <td> <?php echo $user['idEmploye']  ?>  </td>
                             <td>  
                                 <?php if($_SESSION['user']['idUser']==$user['idUser']){?>
                                 <a href="editeruser.php?idu=<?php echo $user['idUser'] ?>">
                                     <span class="glyphicon glyphicon-edit"></span>
                                 </a>
                                &nbsp &nbsp
                                 <?php } 
                                 if ($nbreUser>1){?>
                                 <a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur?')"
                                    href="supprimeruser.php?idu=<?php echo $user['idUser'] ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                 </a>
                                 &nbsp &nbsp
                                  
                                  <a href="activeruser.php?idu=<?php echo $user['idUser'] ?>&etat=<?php echo $user['etat'] ?>">
                                 <?php if($user['etat']==1) 
                                echo  '<span class="glyphicon glyphicon-remove"></span>';
                                 else if ($user['etat']==0) 
                                 echo '<span class="glyphicon glyphicon-ok"></span>';
                                   ?>
                                 </a>
                                 <?php } ?>
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
                            <a href="utilisateurs.php?page=<?php echo $i; ?>&login=<?php echo $login;
                                     ?>">
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