<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $mysqli = require __DIR__ . "/dbh.inc.php";

// WE TAKE THE EMAIL THAT THE VISITEUR ENTERED AND WE SEARCH IF IT EXIST IN OUR TABLE IN DATABASE
  $sql = sprintf("SELECT * FROM client WHERE adresse_email = '%s'", htmlspecialchars($_POST["email"]));
  $result = mysqli_query($mysqli, $sql);
  $user =  mysqli_fetch_assoc($result);

// IF (USER) WE FOUND THE USER
  if ($user){

// NOW WE CHECK IF PÄSSWOED IS CORRECT
  if (password_verify($_POST["pwdlog"], $user["mot_passe"])) {
        session_start();
        $_SESSION["client_id"] = $user["numero_client"];
        header("Location: homepage.php");
        exit;   

    } else {
//  PÄSSWOED IS INCORRECT
      session_start();
      $_SESSION["existEmailpwdfalse"] = $user["adresse_email"];
      // $_SESSION["password_false"] = $_POST["pwdlog"];
      echo 'password ghalat';
      header("Location: homepage.php");
    }
  } else {
    //  NO USER FOUND THAT MEANS THE EMAIL WRONG
    session_start();
    $_SESSION["notexistEmail"] = $_POST["email"];
    header("location: homepage.php");
    exit;
  }
  } 
  exit;
?>
