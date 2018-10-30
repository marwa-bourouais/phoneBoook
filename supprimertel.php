<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idt=isset($_GET['idt'])? $_GET['idt']:0;
             

$requete="delete from telephone where idTel=?";
$params=array($idt);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:bureaux.php');
 }
else
{
 header('location:../index.php');   
}


?>