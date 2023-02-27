<?php  


$servername = "localhost";
$DBUsername = "root";
$DBPassword= "";
$DBname = "agence";

$mysqli = new mysqli($servername, $DBUsername, $DBPassword, $DBname);

if ($mysqli->connect_errno) {

    die("connection failed: " . $mysqli->connect_error);
}
return $mysqli;


// <?php
// $servername = "localhost";
// $DBUsername = "root";
// $DBPassword= "";
// $DBname = "agence";

// try {
//     $pdo = new PDO("mysql:host=$servername;dbname=$DBname", $DBUsername, $DBPassword);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $pdo;
// } catch(PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }


