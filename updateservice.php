<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$ids=isset($_POST['ids'])? $_POST['ids']:0;
$noms=isset($_POST['Service'])? $_POST['Service']:"";
     
$requeteCount="select count(*) count from service where designation='$noms'
and idService <>'$ids'";
$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();     
$nb=$tabCount['count'];
 if ($noms!="")
{
     if($nb==0)
     {
$requete="update service set designation=?  where idService=?";
$params=array($noms,$ids);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:services.php');
     }
     else
     {
        $msg="Ce service existe déjà!!Veuillez changer le nom du service.";
        header("location:alerte.php?message='$msg'");
     }
 }
else
{
         $msg="Le nom du service ne doit pas etre vide";
        header("location:alerte.php?message='$msg'");
}
     

 }
else
{
    header('location:../index.php');
}

?>