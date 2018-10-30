<?php
  session_start();
if(isset($_SESSION['user']))   
{
  require_once("connexiondb.php");

 $idu=isset($_GET['idu'])? $_GET['idu']:0;
            
$requete="select * from utilisateur where idUser='$idu'";
$resultat=$pdo->query($requete);
$user=$resultat->fetch();

$login=$user['login'];
$email=$user['email'];

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
    <title>Edition d'un utilisateur:</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Edition de l'utiliasteur:</div>
            <div class="panel-body">
                <form method="post"  action="updateuser.php" class="form"> 
                    
                    <div class="group-control">
                     <div class ="form-group ">
                    <label for="idu"> ID de l'utilisateur :<?php echo $idu ?></label>
                    <input type="hidden" name="idu" class="form-control" value="<?php echo $idu ?>"/>  
                    </div>
            
                      <div class ="form-group">
                    <label for="login"> Nom de l'utilisateur:</label>
                    <input type="text" name="login" placeholder="Nom d'utilisateur" class="form-control"  value="<?php echo $login ?>" />  
                    </div>
                        
                         <div class ="form-group">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" placeholder="E-mail" class="form-control"  value="<?php echo $email ?>" />  
                    </div>                     
                                   
                    </div>
                        
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Enregister...</button>
                    &nbsp; &nbsp;
                    <a href="modifierpwd.php?idu=<?php echo $idu ?>">Changer le mot de passe</a>
                </form>
            </div>
        </div>
        </div>
    </body>
</html>