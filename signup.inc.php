
<?php
    // harsh the pass word
    $password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
   
    $mysqli = require __DIR__ . "/dbh.inc.php";

    $sql = "INSERT INTO client (nom, prenom, adresse_email, mot_passe, telephone) VALUES (?, ?, ?, ?, ?)"; 
    $stmt = mysqli_stmt_init($mysqli);

    $stmt = mysqli_stmt_init($mysqli);
    if (! mysqli_stmt_prepare($stmt, $sql)) {
      header("location: homepage.php?error=failderror");
      exit();
      // die("SQL error :" . $mysqli->error);
    }
    mysqli_stmt_bind_param($stmt, "ssssi", $_POST["name"], $_POST["lastname"], $_POST["email"], $password_hash, $_POST["phone"]);


    $email = $_POST["email"];
    $query = mysqli_query($mysqli, "SELECT * FROM `client` WHERE adresse_email= '$email'");

    if (mysqli_num_rows($query) > 0) { 
    // THIS MEANS THE SIGN IN EMAIL IS ALREADY IN USE
  
    while ( $row = mysqli_fetch_array($query)) {
      session_start();
      $_SESSION['all_details_signup'] = array();
      $client_name = $_POST['name']; 
      $client_prenom = $_POST['lastname'];
      $client_phone = $_POST['phone']; 
      $client_email = $row["adresse_email"];
  
      array_push($_SESSION['all_details_signup'], $client_name, $client_prenom, $client_phone, $client_email); 
      header("location: homepage.php");
     }
    
  

    } else {
// THIS MEANS THAT THE USER ENTERED EVRETHIN SUCCESSFULLY

      $stmt->execute();
      session_start();
      header("location: homepage.php");
      exit;

    }
   















