<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idd=isset($_POST['idDirection'])?$_POST['idDirection']:0;

$requeteS="select count(*) countS from service where idDirection='$idd'";
$resultatS=$pdo->query($requeteS);
$tabCountS=$resultatS->fetch();
$nbreS=$tabCountS['countS'];
if($nbreS==0)
{
$requete="delete from direction where idDirection=?";
$params=array($idd);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:services.php');
}
else
{
    $msg="Suppression impossible: Vous devez d'abord supprimer tous les services de cette direction ";
    header("location:alerte.php?message='$msg'");
}
 }
else
{
     header("location:../index.php");
}


?>