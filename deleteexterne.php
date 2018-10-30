<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idE=isset($_POST['idE'])?$_POST['idE']:0;

$requeteS="select count(*) countS from contact where idExterne='$idE'";
$resultatS=$pdo->query($requeteS);
$tabCountS=$resultatS->fetch();
$nbreS=$tabCountS['countS'];
if($nbreS==0)
{
$requete="delete from externe  where idexterne=?";
$params=array($idE);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:externe.php');
}
else
{
    $msg="Suppression impossible: Vous devez d'abord supprimer tous les contacts appartenants à  cette entreprise ";
    header("location:alerte.php?message='$msg'");
}
 }
else
{
     header("location:../index.php");
}


?>