<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idu=isset($_POST['idu'])? $_POST['idu']:0;
$login=isset($_POST['login'])? $_POST['login']:"";
$email=isset($_POST['email'])? $_POST['email']:""; 

$requete="update utilisateur set login=?,email=? where idUser=?";
$params=array($login,$email,$idu);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
header('location:utilisateurs.php'); }
else
{
    header('location:../index.php');
}

?>