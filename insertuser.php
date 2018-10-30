<?php

require_once("connexiondb.php");
$nome=isset($_POST['nome'])? $_POST['nome']:"";
$prenome=isset($_POST['prenome'])? $_POST['prenome']:""; 
$login=isset($_POST['login'])? $_POST['login']:"";
$email=isset($_POST['email'])? $_POST['email']:"";
$pwd=isset($_POST['pwd'])? $_POST['pwd']:"";
     
$requeteCountE="select count(idEmploye) countE from employe where (nomEmploye='$nome' and prenomEmploye='$prenome')";   
     
  $resultatCountE=$pdo->query($requeteCountE);
  $tabCountE=$resultatCountE->fetch();     
  $nbreEmploye=$tabCountE['countE'];
     
     if ($nbreEmploye==0)
     {
     $msg="Nom ou prénom erroné";
      header("location:alerte.php?message='$msg'"); 
     }
     if ($nbreEmploye==1)
     {
     $requeteE="select * from employe where (nomEmploye='$nome' and prenomEmploye='$prenome')";   
     
     $resultatE=$pdo->query($requeteE);
     $employe=$resultatE->fetch();     
     $ide=$employe['idEmploye'];
         
    $requete="insert into utilisateur (login,email,etat,pwd,idEmploye) 
    values(?,?,?,?,?)";
    $params=array($login,$email,0,$pwd,$ide);
    $resultat=$pdo->prepare($requete);
    $resultat->execute($params);
     
     header('location:../index.php');
     }
    if($nbreEmploye!=0 && $nbreEmploye!=1)
     {
      $msg="Veuillez contacter l'administrateur";
      header("location:alerte.php?message='$msg'"); 
     }
?>