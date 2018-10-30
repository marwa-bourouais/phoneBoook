<?php
 session_start();
if(isset($_SESSION['user']))   
{
 require_once("connexiondb.php");

$idTel=isset($_GET['idt'])? $_GET['idt']:0;
$etat=isset($_GET['etat'])? $_GET['etat']:0;

if ($etat==0) $newEtat=1;
else  $newEtat=0;

$requete="update telephone set etat=? where idTel=?";
$params=array($newEtat,$idTel);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);   
header("location: bureaux.php"); 
}
else
{
   header('location:../index.php'); 
}

?>
