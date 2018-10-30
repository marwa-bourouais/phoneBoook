<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");
$ent=isset($_POST['ent'])? $_POST['ent']:"";
     
     
     
$requeteCount="select count(*) count from externe where rss='$ent' ";
$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();     
$nb=$tabCount['count'];
   if ($ent!="")            
   {
       if ($nb==0)
       {
$requete="insert into externe (rss) values (?)";
$params=array($ent);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);      
header('location:externe.php');
       }
       else
       {
       $msg="Cette entreprise  existe déjà!!Veuillez entrer une autre raison sociale  d'entreprise.";
       header("location:alerte.php?message='$msg'");
       }
   }
     else 
     {
       $msg="la raison sociale de l'entreprise  ne doit pas etre vide";
       header("location:alerte.php?message='$msg'");
     }
}

else{
 require_once("../index.php");
}
?>