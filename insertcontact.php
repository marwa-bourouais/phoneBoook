<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$nom=isset($_POST['nom'])? $_POST['nom']:"";
$prenom=isset($_POST['prenom'])? $_POST['prenom']:""; 
$tel=isset($_POST['tel'])? $_POST['tel']:"";
$idE=isset($_POST['idE'])? $_POST['idE']:"";


if($nom=="" || $prenom=="")
{
    $msg="Le nom et le prénom du contact  ne doivent pas etre vides";
    header("location:alerte.php?message='$msg'");
}
else
{
 
         if (is_numeric($tel))
         {
        $requete="insert into contact (nom,prenom,tel,idExterne) values (?,?,?,?)";
        $params=array($nom,$prenom,$tel,$idE);
          $resultat=$pdo->prepare($requete);
        $resultat->execute($params);
         header('location:externe.php');
        }
         else
         {
           $msg="Veuillez choisir des valeurs numériques pour le numéro de téléphone";
         header("location:alerte.php?message='$msg'");  
         }
         
     
    
}
 }
else{
header('location:../index.php');}
?>