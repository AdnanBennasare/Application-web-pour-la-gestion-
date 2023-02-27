<?php
include 'connect.php';
try{
   $nom=$_POST["nom"];
   $prenom=$_POST["prenom"];
   $telephon=$_POST["telephon"];
   $email=$_POST["email"];
   $mot_passe= $_POST["mot_passe"];
   $sql= "UPDATE `client` SET `nom`=:nom,`prenom`=:prenom,`adresse_email`=:adresse_email,`mot_passe`=:mot_passe,`telephone`=:telephone WHERE `numero_client`=:numero_client";
   $query = $con-> prepare( $sql );
   $result = $query->execute( array( ':nom'=>$_POST["nom"], ':prenom'=>$_POST["prenom"],':adresse_email'=>$_POST["email"],':mot_passe'=>$_POST["mot_passe"],':telephone'=>$_POST["telephon"], ':numero_client'=>1 ) );
   header("location: profile.php");

}
catch (PDOException $e) {
   echo "There is some problem in connection: " . $e->getMessage();
}