<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idb=isset($_POST['idb'])? $_POST['idb']:0;
$numb=isset($_POST['numb'])? $_POST['numb']:"";   
$idService=isset($_POST['idService'])? $_POST['idService']:0;
     
$requete="select count(*) count from bureau where numBureau='$numb' and idService='$idService' and idBureau<>'$idb'";
$resultat=$pdo->query($requete);
$tab=$resultat->fetch();     
$nb=$tab['count'];
     
if (($idService==0) || ($idb==0) || ($numb==""))
{
    $msg="Veuillez remplir tous les champs";
    header("location:alerte.php?message='$msg'");
}
else
{
    if (is_numeric($numb))
    {
        if($nb==0)
        {
$requete="update bureau set numBureau=?,idService=? where idBureau=?";
$params=array($numb,$idService,$idb);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:bureaux.php');
        }
        else
        {
          $msg="Ce bureau existe déjà!!Veuillez entrer un autre numéro de bureau ou changer de service";
         header("location:alerte.php?message='$msg'");  
        }
    }
    else
    {
    $msg="Veuillez entrer une valeur numérique";
    header("location:alerte.php?message='$msg'");
    }
 }
 }
else
{
   header('location:../index.php'); 
}

?>