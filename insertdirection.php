<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

     $dir=isset($_POST['direction'])? $_POST['direction']:"";
$requeteCount="select count(*) count from direction where nom='$dir' ";
$resultatCount=$pdo->query($requeteCount);
$tabCount=$resultatCount->fetch();     
$nb=$tabCount['count'];
   if ($dir!="")            
   {
       if ($nb==0)
       {
$requete="insert into direction (nom) values (?)";
$params=array($dir);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);      
header('location:services.php');
       }
       else
       {
       $msg="Cette  direction  existe déjà!!Veuillez entrer un autre nom de direction.";
       header("location:alerte.php?message='$msg'");
       }
   }
     else 
     {
       $msg="Le nom de la direction ne doit pas etre vide";
       header("location:alerte.php?message='$msg'");
     }
}

else{
 require_once("../index.php");
}
?>