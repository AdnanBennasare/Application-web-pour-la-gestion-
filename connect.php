<?php 
$host="localhost";
$db_name="agence";
$username="root";
$password="";
try{ 
    $con=new PDO("mysql:host={$host};dbname={$db_name}",$username,$password); 
}
//showerror 
catch(PDOException $exception){
 echo"Connectionerror:". $exception -> getMessage(); 
}
?>