<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idb=isset($_GET['idb'])? $_GET['idb']:0;
$numtel=isset($_POST['numtel'])? $_POST['numtel']:""; 
$etattel=isset($_POST['etattel'])? $_POST['etattel']:""; 
     
 $requeteT="select count(*) countT from  telephone  where numTel='$numtel'";
  $resultatCountT=$pdo->query($requeteT);
  $tabCountT=$resultatCountT->fetch();     
  $nb=$tabCountT['countT'];
     
if($numtel=="" || $idb==0 || $etattel=="")
{
    $msg="Veuillez remplir tous les champs";
    header("location:alerte.php?message='$msg'");
}
else
{ if ($nb==0)
{
    if (is_numeric($numtel))
    {
$requete="insert into telephone (idBureau,numTel,etat) values(?,?,?)";

$params=array($idb,$numtel,$etattel);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
        
      header('location:bureaux.php');

    }
    else
    {
     $msg="Veuillez entrer une valeur numérique.";
    header("location:alerte.php?message='$msg'");
    }}
 else 
 {
      $msg="existe.";
    header("location:alerte.php?message='$msg'");
 }
 }
 }
else
{
header('location:../index.php');
}
?>