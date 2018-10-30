<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");
$noms=isset($_POST['Service'])? $_POST['Service']:"";
     $dir=isset($_POST['idDirection'])? $_POST['idDirection']:"";
$requeteCount="select count(*) count from service where ( designation='$noms' and idDirection='$dir')";
$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();     
$nb=$tabCount['count'];
   if ($noms!="")            
   {
       if ($nb==0)
       {
$requete="insert into service (designation,idDirection) values (?,?)";
$params=array($noms,$dir);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);      
header('location:services.php');
       }
       else
       {
       $msg="Ce service existe déjà!!Veuillez entrer un autre nom de service.";
       header("location:alerte.php?message='$msg'");
       }
   }
     else 
     {
       $msg="Le nom du service ne doit pas etre vide";
       header("location:alerte.php?message='$msg'");
     }
}

else{
 require_once("../index.php");
}
?>