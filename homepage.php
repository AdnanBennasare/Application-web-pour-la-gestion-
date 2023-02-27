<?php 
require "connect.php";
session_start();

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solaz Agency</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style12.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">

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





















































    <section id="sec1">
        <img src="./images/francesca-tosolini-tHkJAMcO3QE-unsplash (1).jpg" alt="">
   <div id="intro">
    <h1>Connecting people &
        Lorem properties perfectly</h1>
        <p>We are recognized for exceeding client expectations and delivering great results through dedication, ease of process, and extraordinary services to our worldwide clients.</p>
   </div>
   <div id="panelSearch">
   <form action="searchPage.php" method="post">
   <div>
    <label for="type">Type</label>
    <select name="Category" id="types">
        <option value="" selected disabled>Choose one</option>
        <option value="vente">Sell</option>
        <option value="location">Rent</option>
    </select>
</div>
<div>
    <label for="city">City</label>
    <input type="text" name="city" id="city" placeholder="Tangier">
    </div>
    <div>
    <label for="type">Category</label>
    <select name="type" id="Category">
        <option value="" selected disabled>Choose one</option>
        <option value="appartement">appartement</option>
        <option value="maison">maison</option>
        <option value="villa">villa</option>
        <option value="bureau">bureau</option>
        <option value="terrain">terrain</option>
    </select>
</div>
    <div>
    <label for="price">Price</label>
    <input type="number" name="price" id="price" placeholder="1500$">
</div>
<div>
<a href="searchPage.php"> <button type="submit"name="search" >Search</button></a>
</div>
</form>
   </div>
    </section>
<section id="sec2">
<h2>Discover the latest properties in Morocco</h2>
<p class="desc">We are very proud of the service we provide and what our guests have to say about us. Our locations and services prove we are the best.</p>
<hr class="boldLine">



<form method="POST">
    <select name="sortingSelect" id="sortingSelect">
        <option selected disabled>Sort by:</option>
        <option value="Newest">Newest annonces</option>
        <option value="Oldest">Oldest annonces</option>
        <option value="Pricelth">Price low to high</option>
        <option value="Pricehtl">Price high to low</option>
    </select>
    <button type="submit" class="sortBtn">Sort</button>
</form>

<?php
// Get the selected sort option
$sortOption = isset($_POST['sortingSelect']) ? $_POST['sortingSelect'] : '';

// Set the default sort order if no option is selected
$sortOrder = 'date_publication DESC';

// Change the sort order based on the selected option
switch ($sortOption) {
  case 'Newest':
    $sortOrder = 'date_publication DESC';
    break;
  case 'Oldest':
    $sortOrder = 'date_publication ASC';
    break;
  case 'Pricelth':
    $sortOrder = 'prix ASC';
    break;
  case 'Pricehtl':
    $sortOrder = 'prix DESC';
    break;
}
// Get the annonces from the database using the selected sort order
$sql = "SELECT announce.numero_annouce,announce.code_postal, announce.titre, announce.prix, announce.categorie,announce.date_publication, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
WHERE numero_client=1 AND  images.check_image=1";
$annonces = $con->query($sql);
?>
<div id="annonces">
    <?php 
    foreach($annonces AS $annonce){
    ?>
    <div class="annonce">
        <img src="./images/<?= $annonce['image'];?>" alt="">
        <div class="inf">
        <p><?= $annonce['prix']; ?> Dh</p>
        <h3><?= $annonce['titre']; ?></h3>
    </div>
   
    <div class="inf2">
    <div>
    <p><?= $annonce['Ville']; ?></p>
</div>
<div>
    <p> <?= $annonce['date_publication'];?></p>
</div>
<div>
       <a class="more" href="details.php?id=<?= $annonce['numero_annouce']?>"> More </a> 
</div>
</div>
<div class="typeAndcateg">
  <p><?= $annonce['categorie']; ?></p>
  <p><?= $annonce['Type']; ?></p>
</div>
    </div>
    <?php } ?>
</div>

</section>
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
              <br>
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










<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>


<script src="signup.js"></script>
<script src="main.js"></script>
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