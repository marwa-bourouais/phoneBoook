<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$idu=isset($_GET['idu'])? $_GET['idu']:0;
$login=isset($_GET['login'])? $_GET['login']:"";
             

$requete="delete from utilisateur where idUser=?";
$params=array($idu);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
 

if( ($_SESSION['user']['idUser']==$idu))
    { 
     header('location:../index.php');
    }
else
    {
  header('location:utilisateurs.php');  
    }
}
else
{
    header('location:../index.php');
}


?>