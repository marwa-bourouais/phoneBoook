<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$ide=isset($_GET['ide'])? $_GET['ide']:0;
$noms=isset($_GET['Service'])? $_GET['Service']:"";
             

$requete="delete from employe where idEmploye=?";
$params=array($ide);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:employes.php');}
else
{
 header('location:../index.php');   
}


?>