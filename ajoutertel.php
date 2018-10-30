<?php  
 session_start();
if(isset($_SESSION['user']))   
{
 require_once("connexiondb.php");
 $idb=isset($_GET['idb'])? $_GET['idb']:0;
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
        <title>Nouveau numéro:</title>
        <link rel="shortcut icon" href="../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include ("menu.php"); ?>
       <div class="container">
        <div class="panel panel-primary margetop">
            <div class="panel-heading">Veuillez saisir le nouveau numéro de téléphone:</div>
            <div class="panel-body">
                <form method="post"  action="inserttel.php?idb=<?php echo $idb ?>" class="form">   
                    
                    <div class ="form-group">
                      
                    <label for="numtel"> Numéro de téléphone:</label>
                    <input type="text" name="numtel" placeholder="numero de téléphone" 
                          class="form-control"/>  
                      
                    </div>
                    
                     <div class ="form-group">
                      
                    <label for="etattel"> Etat du téléphone:</label>
                    <input type="text" name="etattel" 
                        placeholder="Entrez 1 pour fonctionnel 0 pour en panne " 
                          class="form-control"/>  
                      
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"> </span>
                        Enregistrer...</button>
                    
                </form>
            </div>
        </div>
        </div>
    </body>
</html>