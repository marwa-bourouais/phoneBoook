<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

$ide=isset($_POST['ide'])? $_POST['ide']:0;
$nome=isset($_POST['nome'])? $_POST['nome']:"";
$prenome=isset($_POST['prenome'])? $_POST['prenome']:""; 
$numTel=isset($_POST['numTel'])? $_POST['numTel']:"";
$email=isset($_POST['email'])? $_POST['email']:"";
$numPer=isset($_POST['numPer'])? $_POST['numPer']:"";
$poste=isset($_POST['poste'])? $_POST['poste']:"";
$sexe=isset($_POST['sexe'])? $_POST['sexe']:"";
$idService=isset($_POST['idService'])? $_POST['idService']:0;
$idBureau=isset($_POST['idBureau'])? $_POST['idBureau']:0;
$photo=isset($_FILES['photo']['name'])? $_FILES['photo']['name']:"";
$imagetmp=$_FILES['photo']['tmp_name'];
move_uploaded_file($imagetmp,"../images/".$photo);
if (($nome=="") || ($prenome==""))
{
    $msg="Le nom et le prénom de l'employé ne doivent pas etre vide";
    header("location:alerte.php?message='$msg'");
}
else{
$requeteB="select * from bureau where idBureau='$idBureau'";
$resultatB=$pdo->query($requeteB);
$bureau=$resultatB->fetch();
$ids=$bureau['idService'];
     if($ids==$idService)
    {
         if(is_numeric($numTel)&&(is_numeric($numPer)))
         {
         if(!empty($photo))
         {
             $requete="update employe set nomEmploye=?,prenomEmploye=?,numTel=?,email=?,numPer=?,fonction=?,
              sexe=?,photo=?,idBureau=? where idEmploye=?";
             $params=array($nome,$prenome,$numTel,$email,$numPer,$poste,$sexe,$photo,
                           $idBureau,$ide);
         }
        else
        {
        $requete="update employe set nomEmploye=?,prenomEmploye=?,numTel=?,email=?,numPer=?,fonction=?,
         sexe=?,idBureau=? where idEmploye=?";
         $params=array($nome,$prenome,$numTel,$email,$numPer,$poste,$sexe,$idBureau,$ide);
         }
      $resultat=$pdo->prepare($requete);
      $resultat->execute($params);
      header('location:employes.php');
         }
         else
         {
           $msg="Veuillez choisir des valeurs numériques pour le numéro de téléphone et le numéro personnel";
          header("location:alerte.php?message='$msg'");  
         }
    }
    else
    {
    $msg="Veuillez choisir un numéro d'un bureau qui appartient au service selectionné";
    header("location:alerte.php?message='$msg'");
    }
}
 }
else
{
   header('location:../index.php'); 
}

?>