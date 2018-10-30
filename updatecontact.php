<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idE=isset($_POST['idE'])? $_POST['idE']:0;
     $idC=isset($_GET['idC'])? $_GET['idC']:0;
$nom=isset($_POST['nom'])? $_POST['nom']:"";
$prenom=isset($_POST['prenom'])? $_POST['prenom']:""; 
$tel=isset($_POST['tel'])? $_POST['tel']:"";

if (($nom=="") || ($prenom==""))
{
    $msg="Le nom et le prénom du contact ne doivent pas etre vides ";
    header("location:alerte.php?message='$msg'");
}
else{

         if(is_numeric($tel))
         {
         
        
        $requete="update contact set nom=?,prenom=?,tel=?,idExterne=? where idContact=?";
         $params=array($nom,$prenom,$tel,$idE,$idC);
         
      $resultat=$pdo->prepare($requete);
      $resultat->execute($params);
      header('location:externe.php');
         }
         else
         {
           $msg="Veuillez choisir des valeurs numériques pour le numéro de téléphone ";
          header("location:alerte.php?message='$msg'");  
         }
    }
    

 }
else
{
   header('location:../index.php'); 
}

?>