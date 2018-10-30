<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");
$idu=isset($_GET['idu'])? $_GET['idu']:0;
     
$apwd=isset($_POST['apwd'])? $_POST['apwd']:"";
$npwd=isset($_POST['npwd'])? $_POST['npwd']:"";
$cpwd=isset($_POST['cpwd'])? $_POST['cpwd']:"";

$requete="select * from utilisateur where idUser='$idu' ";

$resultat=$pdo->query($requete);
$user=$resultat->fetch();
$pwd=$user['pwd'];
     
     if($pwd==$apwd)
     {
         if($npwd==$cpwd)
         {
             $requeteN="update utilisateur set pwd=? ";
             $params=array($npwd);
             $resultat=$pdo->prepare($requeteN);
             $resultat->execute($params);
             header('location:editeruser.php');
         }
         else
         {
              $msg="Changement impossible:Le mot de passe confirmé est différent du nouveau mot de passe";
              header("location:alerte.php?message='$msg'");
         }
     }
     else
     {
         $msg="Changement impossible: Le mot de passe que vous avez entré est différent de votre mot de passe actuel";
              header("location:alerte.php?message='$msg'");
     }

     
}
else
{
    header('location:../index.php');
}

?>