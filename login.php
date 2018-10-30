<?php
session_start();
if(isset($_SESSION['erreurlogin'])) 
{
    $erreurlogin= $_SESSION['erreurlogin'];
}
else
{
    $erreurlogin="";
}
session_destroy();
?>
<! DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>APS annuaire</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
       <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
           <img src="../images/aps-logo.png" height=250px width=430px/>
        <div class="panel panel-primary margetop">
         
            <div class="panel-heading">Se connecter</div>
            <div class="panel-body">
                <form method="post"  action="seconnecter.php" class="form" >
                     <?php if(!empty($erreurlogin)){ ?>
                     <div class="alert alert-danger">
                    <?php echo $erreurlogin; ?>
                    </div>
                   <?php } ?>
                      <div class ="form-group">
                    <label for="login"> Nom d'utilisateur:</label>
                    <input type="text" name="login" placeholder="Nom d'utilisateur" class="form-control"  />  
                    </div>
                        
                        <div class ="form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" name="pwd" placeholder="Mot de passe" class="form-control"  />  
                    </div>
                      
                       <div class ="form-group form-inline">
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-log-in"> </span>
                          Se connecter</button>
                            </div>
                      
                     
                    
                </form>
                 <div class ="form-group group-inline">
                      <a href="nouveaucompte.php">Créer un nouveau compte</a>  
                     </div>     
                   
            </div>

        </div>
        </div>
    </body>
</html>