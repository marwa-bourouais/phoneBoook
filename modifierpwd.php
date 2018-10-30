<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
  require_once("connexiondb.php");

 $idu=isset($_GET['idu'])? $_GET['idu']:0;
            
$requete="select * from utilisateur where idUser='$idu'";
$resultat=$pdo->query($requete);
$user=$resultat->fetch();

$pwd=$user['pwd'];
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
    <title>Changement du mot de passe:</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container col-lg-6 col-lg-offset-3">
        <div class="panel panel-primary margetop">
            <div class="panel-heading ">Changez votre mot de passe:</div>
            <div class="panel-body">
                
                <form method="post"  action="updatepwd.php?idu=<?php echo $idu ?>" class="form"> 
  
                      <div class ="form-group">
                    <label for="apwd">Mot de passe actuel:</label>
                    <input type="password" name="apwd" placeholder="Mot de passe actuel" class="form-control"/>  
                     
                    </div>
                    
                    <div class ="form-group">
                    <label for="npwd">Nouveu mot de passe:</label>
                    <input type="password" name="npwd" placeholder="Nouveau mot de passe" class="form-control"   />  
                    </div>
                    
                    <div class ="form-group">
                    <label for="cpwd">Confirmer le nouveau mot de passe:</label>
                    <input type="password" name="cpwd" placeholder="Confirmation du nouveau mot de passe" class="form-control"   />  
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