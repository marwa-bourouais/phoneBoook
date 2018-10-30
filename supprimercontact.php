<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idC=isset($_GET['idC'])? $_GET['idC']:0;

             

$requete="delete from contact  where idContact=?";
$params=array($idC);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:externe.php');}
else
{
 header('location:../index.php');   
}


?>