<?php
session_start();
 if(isset($_SESSION['user'])) 
 {
 require_once("connexiondb.php");
$numb=isset($_POST['numb'])? $_POST['numb']:"";
     $numT=isset($_POST['numT'])? $_POST['numT']:"";
$idService=isset($_POST['idService'])? $_POST['idService']:0;

$requete="select count(*) count from bureau where numBureau='$numb' and idService='$idService'";
$resultat=$pdo->query($requete);
$tab=$resultat->fetch();     
$nb=$tab['count'];
     
   if ($numb!="" &&  $idService!=0)            
   {
       if (is_numeric($numb) && (is_numeric($numT) || $numT==""))
        {  
           if($nb==0)
           {   
           $requete="insert into bureau (numBureau,idService) values (?,?)";
               
               
           $params=array($numb,$idService);
           $resultat=$pdo->prepare($requete);
           $resultat->execute($params); 
           $requeteI="select idBureau from bureau where numBureau='$numb'";
           $resultatI=$pdo->query($requeteI);
               $bureau=$resultatI->fetch();
               $idB=$bureau['idBureau'];
           $requeteT="insert into telephone (numTel,idBureau,etat)  values (?,?,?)";
               $paramss=array($numT,$idB,1);
           $resultatT=$pdo->prepare($requeteT);
           $resultatT->execute($paramss);
           header('location:bureaux.php');
           }
           else
           {
            $msg="Ce bureau existe déjà!!Veuillez entrer un autre numéro.";
            header("location:alerte.php?message='$msg'");
           }
       }
       else
       {
       $msg="Veuillez entrer une valeur numérique";
       header("location:alerte.php?message='$msg'");
       }

   }
  else 
   {
       $msg="Veuillez remplir tous les champs";
       header("location:alerte.php?message='$msg'");
   }
}

else{
 require_once("../index.php");
}
?>