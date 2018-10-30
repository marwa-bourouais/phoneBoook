<?php
 session_start();
if(isset($_SESSION['user']))   
{
 require_once("connexiondb.php");

$idu=isset($_GET['idu'])? $_GET['idu']:0;
$etat=isset($_GET['etat'])? $_GET['etat']:0;

if ($etat==0) $newEtat=1;
else 
{
    $newEtat=0;
}
$requete="update utilisateur set etat=? where idUser=?";
$params=array($newEtat,$idu);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);
    
if( ($newEtat==0 )&& ($_SESSION['user']['idUser']==$idu))
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
