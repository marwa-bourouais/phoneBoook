<?php
 session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");

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

if($nome=="" || $prenome=="")
{
    $msg="Le nom et le prénom de l'employé ne doivent pas etre vide";
    header("location:alerte.php?message='$msg'");
}
else
{
$requeteB="select * from bureau where idBureau='$idBureau'";
$resultatB=$pdo->query($requeteB);
$bureau=$resultatB->fetch();
$ids=$bureau['idService'];
     if($ids==$idService)
    {  
         if ((is_numeric($numTel)) &&  (is_numeric($numPer)) )
         {
        if($photo!="")
         {
        $requete="insert into employe (nomEmploye,prenomEmploye,numTel,email,numPer,fonction,
        sexe,idBureau,photo) values (?,?,?,?,?,?,?,?,?)";
       $params=array($nome,$prenome,$numTel,$email,$numPer,$poste,$sexe,$idBureau,
                     $photo);
         }
         else
            {
                 $requete="insert into employe (nomEmploye,prenomEmploye,numTel,email,numPer,fonction,
              sexe,idBureau,photo) values (?,?,?,?,?,?,?,?,?)";
             $params=array($nome,$prenome,$numTel,$email,$numPer,$poste,$sexe,$idBureau,
                  'default.jpg'); 
   
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
else{
header('location:../index.php');}
?>