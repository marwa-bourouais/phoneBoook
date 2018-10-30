<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idb=isset($_GET['idb'])? $_GET['idb']:0;

             
$requeteEmp="select count(*) countEmp from employe where idBureau='$idb'";
$resultatEmp=$pdo->query($requeteEmp);
$tabCountEmp=$resultatEmp->fetch();
$nbreEmp=$tabCountEmp['countEmp'];
if($nbreEmp==0)
{
$requete="delete from bureau where idBureau=?";
$params=array($idb);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:bureaux.php');
}
else
{
    $msg="Suppression impossible: Vous devez supprimer tous les employés travaillant dans ce bureau";
    header("location:alerte.php?message='$msg'");
}
 }
else
{
     header("location:../index.php");
}


?>