<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$ids=isset($_GET['ids'])? $_GET['ids']:0;
$noms=isset($_GET['Service'])? $_GET['Service']:"";
             
$requeteB="select count(*) countB from bureau where idService='$ids'";
$resultatB=$pdo->query($requeteB);
$tabCountB=$resultatB->fetch();
$nbreB=$tabCountB['countB'];
if($nbreB==0)
{
$requete="delete from service where idService=?";
$params=array($ids);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:services.php');
}
else
{
    $msg="Suppression impossible: Vous devez supprimer tous les bureaux de ce service";
    header("location:alerte.php?message='$msg'");
}
 }
else
{
     header("location:../index.php");
}


?>