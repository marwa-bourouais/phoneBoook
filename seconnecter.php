<?php
  session_start();
  require_once("connexiondb.php");

 $login=isset($_POST['login'])? $_POST['login']:"";
 $pwd=isset($_POST['pwd'])? $_POST['pwd']:"";
            
$requete="select * from utilisateur where login='$login' and pwd=md5('$pwd')";
$resultat=$pdo->query($requete);
 
 if($user=$resultat->fetch())
{
    if($user['etat']==1)
    {
        $_SESSION['user']=$user;
        header('location:services.php');
    }
     else
     {
         $_SESSION['erreurlogin']="<strong>Erreur!</strong>Votre compte est désactivé!.<br>
               Veuillez contacter l'administrateur.";
          header('location:login.php');
     }
}
else
{
     $_SESSION['erreurlogin']="<strong>Erreur!</strong>Nom d'utilisateur ou mot de passe incorrecte<br>";
          header('location:login.php');
}

?>