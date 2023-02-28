<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solaz Agency</title>
  <link rel="stylesheet" href="gestion.css">
  <link rel="stylesheet" href="style12.css">


<link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>
<body>



<div id="header">
        <div>
        <h1 class="title"><a href="http://localhost/homepage.php">Solaz Agency</a></h1>
        </div>





<?php
  // ======== IF SESSION EXIST WE WILL SHOW USER PROFILE
  if (isset($_SESSION["client_id"])) {
    $mysqli = require __DIR__ . "/dbh.inc.php";
    $sql = "SELECT * FROM client WHERE numero_client = {$_SESSION["client_id"]}";
    $result = mysqli_query($mysqli, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>

    <div id="profiediv">

     <div class="btn-group dropleft">
     <a class="bg-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img style="width: 43px; height: 43px;" src="assests/profile1.png" alt="">
     </a>



    <div class="dropdown-menu">
    <a class="dropdown-item" href="profile.php?id=<?php echo $user["numero_client"]?>">
    <img style="width: 18px; height: 18px;" src="assests/profile1.png" alt="">
    See Profile</a>

    <a class="dropdown-item ml-1" href="logout.php"><i style="font-size: 14px;"
    class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

</div>

  </div>
  </div>

<?php

  } else {
  // ======== IF SESSION DOESN'T EXIST WE WILL SHOW USER SIGN UP PLUS LOG IN BUTTONS
  ?>


  <div class="regestration">
  <a style="margin-right: 40px;" id="opensing" class="btn btn-dark" data-toggle="modal"
  data-target="#exampleModal">Sign Up</a>
  <a class="btn btn-light" id="notexist" data-toggle="modal" data-target="#exampleModalLong">log in</a>
  </div>




  </div>

  
<?php
  }
?>





<!--start annonce header  -->
<div id="announce_header_p">
  <?php
  include("connect.php");
  $sql = "SELECT announce.titre,announce.description,announce.date_publication,announce.prix, announce.date_publication,announce.categorie,announce.Type ,announce.code_postal, announce.Ville, client.nom,client.prenom,client.telephone FROM `announce` JOIN client ON announce.numero_client=client.numero_client WHERE numero_annouce=:numero_annouce";
  $query = $con->prepare($sql);
  $query->execute(array(':numero_annouce' => $_GET["id"]));
  $results = $query->fetch(PDO::FETCH_ASSOC);
  ?>
  <div id="announce_header_c">
    <div>
      <p><?php echo $results["Type"] ?></p>
      <p><?php echo $results["categorie"] ?></p>
    </div>
    <h2><?php echo $results["titre"] ?></h2>
    <p><i class="fa-solid fa-location-dot"></i> <?php echo $results["Ville"] . " " . $results["code_postal"] ?></p>
    <p><i class="fa-solid fa-calendar-days"></i> <?php echo $results["date_publication"] ?></p>
  </div>
  <div>
    <p><?php echo $results["prix"] ?>DH /month</p>
    <p><i class="fa-sharp fa-solid fa-share-nodes"></i> Share</p>
  </div>
</div>
<!--end annonce header  -->
<!--start gallery  -->
<section id="main-carousel" class="splide" aria-label="My Awesome Gallery">
  <div class="splide__track">
    <ul class="splide__list">
    <?php
            $sql_images = "SELECT * FROM images WHERE numero_annouce=:numero_annouce";
            $query_images = $con->prepare($sql_images);
            $query_images->execute(array(':numero_annouce' => $_GET["id"]));
            $results_images = $query_images->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($results_images); $i++) { ?>
      <li class="splide__slide">
        <img src="images/<?php echo $results_images[$i]["image"] ?>" alt="">
      </li>
      <?php
      }
      ?>
    </ul>
  </div>
</section>

<ul id="thumbnails" class="thumbnails">
<?php
            $sql_images = "SELECT * FROM images WHERE numero_annouce=:numero_annouce";
            $query_images = $con->prepare($sql_images);
            $query_images->execute(array(':numero_annouce' => $_GET["id"]));
            $results_images = $query_images->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($results_images); $i++) { ?>
  <li class="thumbnail">
    <img src="images/<?php echo $results_images[$i]["image"] ?>" alt="">
  </li>
  <?php
      }
      ?>

</ul>

<!--end gallery  -->
<!--start annonce description and contact  -->
<div id="contact">
  <p><?php echo $results["nom"] . " " . $results["prenom"] ?></p>

  <button type="button" data-bs-target="#teleclient" data-bs-toggle="modal">Call Now</button>
</div>
<!-- modal telephone -->
<div class="modal fade" id="teleclient" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2 class="text-center">Telephone </h2>
        <p class="text-center border"> <?php echo $results["telephone"] ?></p>
      </div>
    </div>
  </div>
</div>
<!--end annonce description and contact  -->
<!-- /* start description and map */ -->
<div id="description">
  <div>
    <h3>Description:</h3>
    <p> <?php echo $results["description"] ?></p>
  </div>
  <div>
    <img src="./images/_ (1).jpeg" alt="">
  </div>
</div>
<!-- /* end description and map */ -->
<!-- start simular product -->
<h2 style="text-align:center;">Similar Listings</h2>
<hr class="boldLine">
<div id="annonces">
<?php
      include("connect.php");
      $sql1= "SELECT announce.numero_annouce,announce.code_postal,announce.date_publication, announce.titre, announce.prix, announce.categorie, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
      WHERE announce.Ville=:ville AND  images.check_image=:check_image";
      $query1 = $con->prepare($sql1);
      $query1->execute(array(':ville' => $results['Ville'], ':check_image'=>1));
      $results1 = $query1->fetchAll(PDO::FETCH_ASSOC);
      for ($i = 0; $i < count($results1); $i++) { ?>
  <div class="annonce">
    <img src="images/<?php echo $results1[$i]["image"] ?>" alt="">
    <div class="inf">
      <p><?php echo $results1[$i]["prix"] ?> Dh</p>
      <h3><?php echo $results1[$i]["titre"] ?></h3>
    </div>

    <div class="inf2">
      <div>
        <p><?php echo $results1[$i]["Ville"] ?></p>
      </div>
      <div>
        <p> <?php echo $results1[$i]["date_publication"] ?></p>
      </div>
      <div>
        <a  class="more" href="details.php?id=<?php echo $results1[$i]["numero_annouce"] ?>"> More </a>
      </div>
    </div>
    <div class="typeAndcateg">
      <p><?php echo $results1[$i]["categorie"] ?></p>
      <p><?php echo $results1[$i]["Type"] ?></p>
    </div>
  </div>
      <?php
      }
      ?>
</div>
<!-- end simular product -->
<!-- start footer -->
<footer class="footer">
  <div class="containerr">
    <div class="row">
      <div class="footer-col">
        <h4>company</h4>
        <ul>
          <li><a href="#">about us</a></li>
          <li><a href="#">our services</a></li>
          <li><a href="#">privacy policy</a></li>
          <li><a href="#">affiliate program</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>










<!--======================================== SIGN UP MODAL =======================================-->
<div class="modal fade bd-exampl-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="d-flex">

        <img src="assests/signuppic.png" style="width: 50%; height: 100%;" alt="">
        <!-------------------------------- form ---------------------------------->
        <div class="form">
          <h4 class="h4create">Create an acount !</h4>
          <form action="signup.inc.php" method="POST" class="signupform" id="signupform">
<!-- NAME input -->
            <div class="formvalid">
              <input type="text" name="name"
                value="<?php if (isset($_SESSION["all_details_signup"])) {
                  if ($_SESSION["all_details_signup"] !== "") {
                    echo $_SESSION["all_details_signup"][0];
                  }
                } ?>"
                placeholder="Firstname" id="name" class="">
                <br>
              <small></small>
              <br>

            </div>

<!-- LASTNAME input -->
            <div class="formvalid">
              <input type="text" name="lastname"
                value="<?php if (isset($_SESSION["all_details_signup"])) {
                  if ($_SESSION["all_details_signup"] !== "") {
                    echo $_SESSION["all_details_signup"][1];
                  }
                } ?>"
                placeholder="lastname" id="lastname" class="">
                <br>
              <small></small>
              <br>
            </div>
<!-- EMAIL input -->
            <div
              class="formvalid">
              <input type="text" name="email" placeholder="adresse Email"
                value="<?php if (isset($_SESSION["all_details_signup"])) {
                  if ($_SESSION["all_details_signup"] !== "") {
                    echo $_SESSION["all_details_signup"][3];
                  }
                } ?>"
                id="email" class="">
                <br>
              <small>
                <?php
                if (isset($_SESSION["all_details_signup"])) {
                  if ($_SESSION["all_details_signup"] !== "") {
                    echo 'this email is already taken';
                  }
                }
                ?>
              </small>
              <br>
            </div>
<!-- NUMBER input -->
            <div class="formvalid">
              <input type="number" name="phone"
              value="<?php if (isset($_SESSION["all_details_signup"])) {
                if ($_SESSION["all_details_signup"] !== "") {
                  echo $_SESSION["all_details_signup"][2];
                }
              } ?>"
                placeholder="Numéro de téléphone" id="phone" class="">
                <br>
              <small></small>
              <br>

            </div>
<!-- PASSWORD input -->
            <div class="formvalid">
              <input type="password" name="pwd"          
                placeholder="Password" id="pwd" class="">
                <br>
              <small></small>
            </div>
<!-- PASSWORD input -->
            <div class="formvalid">
              <input type="password" name="pwd_repeated"
                min="0" placeholder="Repeat Password" class="" id="pwd_repeated">
                <br>
              <small></small>
              <br>
            </div>
    
            <button type="submit" class="btn btn-primary" name="signupbtn" id="signupbtn">sign up</button>
            <a  id="gotologin" data-dismiss="modal">already have an acount <span style="color: #8B7A5B;" >log in</span><i style="color: #8B7A5B;" class="fa-solid fa-arrow-right"></i></a>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!--======================================== LOG IN MODAL =======================================-->

<div class="modal fade bd-exampl-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="d-flex">

        <img src="assests/signuppic.png" style="width: 50%; height: 100%;" alt="">
        <!-------------------------------- form ---------------------------------->
        <div class="form">
          <h4 class="h4create">log into an existing acount !</h4>
          <form action="login.inc.php" method="POST" id="loginform">
<!-- EMAIL input -->
            <div class="formvalidation">
              <input type="text" name="email" placeholder="adresse Email" id="emaillogin" class=""
                value="<?php 
                if (isset($_SESSION["notexistEmail"])) {      
                    echo $_SESSION["notexistEmail"];         
                } else if (isset($_SESSION["existEmailpwdfalse"])) {
                  echo $_SESSION["existEmailpwdfalse"];
                }?>">
              <br>

              <small>
                <?php
            if(isset($_SESSION["notexistEmail"])){
 
              echo "invalid email";
            
            }else {
              echo "";
            }
                ?>
              </small>
              <br>

            </div>

<!-- PASSWORD input -->
            <div class="formvalidation" id="signupform">
              <input type="password" name="pwdlog" placeholder="password" class="" id="pwdlogin">
              <br>
              <small>
                <?php
                if (isset($_SESSION["existEmailpwdfalse"])) {
                  echo 'password incorrect !!';
                }
                ?>
              </small>
         
              <br>
            </div>
            <button type="submit" class="btn btn-primary" name="loginbtn" id="loginbtn">log in</button>
            <a  id="gotosignup" data-dismiss="modal">don't have an acount sign up<span style="color: #8B7A5B;" > Sign UP</span><i style="color: #8B7A5B;" class="fa-solid fa-arrow-right"></i></a>

    
          </form>
        </div>
      </div>
    </div>
  </div>
</div>












































































































































<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@1.3.3/dist/js/splide.min.js"></script>
<script src="slide.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" ></script>
<script src="https://kit.fontawesome.com/0f55910cdd.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>




<script src="signup.js"></script>


</body>
</html>

<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
     

        $("#gotologin").click(function(){
            $("#exampleModal").modal('hide');
            $("#exampleModalLong").modal('show');
        });
 

        $("#gotosignup").click(function(){
            $("#exampleModalLong").modal('hide');
            $("#exampleModal").modal('show');

        });
    });
</script>




<?php
if (isset($_SESSION['all_details_signup'])) {
  if (isset($_SESSION['all_details_signup'])) {
    echo '<script>document.getElementById("opensing").click();</script>';
    session_destroy();
    // session_unset($_SESSION['all_details_signup']);

  }
}


if (isset($_SESSION["notexistEmail"]) || isset($_SESSION["existEmailpwdfalse"]) || isset($_SESSION["password_false"])) {
    echo '<script>document.getElementById("notexist").click();</script>';
    session_destroy();
    // session_unset($_SESSION["notexistEmail"]);

}

?>