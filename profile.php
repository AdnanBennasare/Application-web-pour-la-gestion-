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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="style12.css">
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





<div class="section">
<div class="d-flex gap-2 justify-content-center p-4">
  <button type="submit" class="btn btn-primary mb-3 w-25" data-bs-target="#addannounce" data-bs-toggle="modal">+ Ajouter un announce</button>
  <a data-bs-target="#editinfo" data-bs-toggle="modal"><i class="fa-solid fa-gear fa-2x"></i></a>
</div>
<div id="annonces">
  <?php
  $sql ="SELECT announce.numero_annouce,announce.code_postal, announce.titre, announce.prix, announce.categorie, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
   WHERE numero_client=1 AND  images.check_image=1";
  $query = $con->prepare($sql);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  for ($i = 0; $i < count($results); $i++) {
  ?>
    <div class="annonce">
      <img src="images/<?php echo $results[$i]["image"] ?>" alt="">
      <div class="inf">
        <p><?php echo $results[$i]["prix"] ?> Dh</p>
        <h3><?php echo $results[$i]["titre"] ?></h3>
      </div>
      <div class="inf2">
        <div>
          <p><?php echo $results[$i]["categorie"] ?></p>
        </div>
        <div>
          <p style="color:black;"><b>For <?php echo $results[$i]["Type"] ?></b></p>
        </div>

        <div>
          <a href="details.php?id=<?php echo $results[$i]["numero_annouce"] ?>" class="more"> More </a>
          </form>

        </div>
      </div>
      <div class="btns">
        <a data-bs-target="#editannounce<?php echo $results[$i]["numero_annouce"] ?>" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></a>
        <a data-bs-target="#deleteannonce<?php echo $results[$i]["numero_annouce"] ?>" data-bs-toggle="modal"><i class="fa-regular fa-trash-can"></i></a>
      </div>
      <!-- modal delete -->
  </div>
      <div class="modal fade" id="deleteannonce<?php echo $results[$i]["numero_annouce"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <form action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $results[$i]["numero_annouce"] ?>">
                <h2 class="text-center">Supprimer votre annonce</h2>
                <p>pouvez vous supprimer cette announce</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Supprimer</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal updat -->
      <div class="modal modal-lg fade" id="editannounce<?php echo $results[$i]["numero_annouce"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body container p-5">
              <form action="editannounce.php" method="POST" class="myFormupdat" enctype="multipart/form-data">
                <h2 class="text-center">Modifier votre annonce</h2>
                <input type="hidden" name="id" value="<?php echo $results[$i]["numero_annouce"] ?>">
                <div class=" d-flex flex-column gap-3">
                  <div class="formvalid">
                    <div class="d-flex gap-2 flex-wrap m-3 ">
                      <?php
                      $sql_images = "SELECT image FROM `images` WHERE `numero_annouce`=:numero_annouce";
                      $query_images = $con->prepare($sql_images);
                      $query_images->execute(array(':numero_annouce' => $results[$i]["numero_annouce"]));
                      $result_images = $query_images->fetchAll(PDO::FETCH_ASSOC);
                      for ($j = 0; $j < count($result_images); $j++) { ?>
                        <div class="d-flex flex-wrap gap-3 images1">
                          <div class="image">
                            <img src="images/<?php echo $result_images[$j]["image"] ?>" alt="Snow" style="width:100%;">
                            <div class="bottom-left">
                              <input type="radio" name="statuupdat" value="<?php echo $result_images[$j]["image"] ?>">
                              principal
                            </div>
                            <input type="hidden" name="imageupdtat<?php echo $results[$i]["numero_annouce"] ?>[]" value="<?php echo $result_images[$j]["image"] ?>">
                            <a class="top-right" onclick="remove_updat(this)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
                          </div>
                        </div>
                      <?php

                      }
                      ?>
                      <div class="rectangle_updat">
                        <label for="image_updat<?php echo $results[$i]["numero_annouce"] ?>" class="icon">
                          <i class="fa fa-plus"></i>
                        </label>
                        <input id="image_updat<?php echo $results[$i]["numero_annouce"] ?>" name="images_updat<?php echo $results[$i]["numero_annouce"] ?>[]" type="file" multiple>
                      </div>
                    </div>
                    <small></small>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="titleupdat" class="form-label">Titre</label>
                      <input type="text" name="titleupdat" class="form-control titleupdat" value="<?php echo $results[$i]["titre"] ?>" placeholder="Titre" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="priceupdat" class="form-label">Montant</label>
                      <input type="number" min="0" name="priceupdat" class="form-control priceupdat" value="<?php echo $results[$i]["prix"] ?>" placeholder="Montant" />
                      <small></small>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="villeupdat" class="form-label">Ville</label>
                      <input type="text" name="villeupdat" class="form-control villeupdat" value="<?php echo $results[$i]["Ville"] ?>" placeholder="Adresse" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="typeupdat" class="form-label">Type</label>
                      <select class="form-select typeupdat" name="typeupdat">
                        <option selected disabled>Choisir</option>
                        <option value="Location" <?php if ($results[$i]["Type"] == "Location") echo 'selected'; ?>>Location</option>
                        <option value="Vente" <?php if ($results[$i]["Type"] == "Vente") echo 'selected'; ?>>Vente</option>
                      </select>
                      <small></small>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="codpostalupdat" class="form-label">Code postal</label>
                      <input type="number" name="codpostalupdat " class="form-control codpostalupdat" value="<?php echo $results[$i]["code_postal"] ?>" placeholder="Code postal" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="categorieupdat" class="form-label">Categorie</label>
                      <select class="form-select categorieupdat" name="categorieupdat">
                        <option selected disabled>Choisir</option>
                        <option value="appartement" <?php if ($results[$i]["categorie"] == "appartement") echo 'selected'; ?>>appartement</option>
                        <option value="maison" <?php if ($results[$i]["categorie"] == "maison") echo 'selected'; ?>>maison</option>
                        <option value="villa" <?php if ($results[$i]["categorie"] == "villa") echo 'selected'; ?>>villa</option>
                        <option value="bureau" <?php if ($results[$i]["categorie"] == "bureau") echo 'selected'; ?>>bureau</option>
                        <option value="terrain" <?php if ($results[$i]["categorie"] == "terrain") echo 'selected'; ?>>terrain</option>
                      </select>
                      <small></small>
                    </div>
                  </div>
                  <div class="formvalid">
                    <label for="descriptionupdat" class="form-label">Description</label>
                    <textarea class="form-control descriptionupdat" name="descriptionupdat" rows="3"></textarea>
                    <small></small>
                  </div>
                  <div class="justify-content-end d-flex">
                    <button name="updatBtn" value="updatBtn" type="submit" class="btn bg-dark text-white">Modifier</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php
  }
    ?>
    <!-- modal info -->
    <?php
   $sql_info ="SELECT `nom`,`prenom`,`adresse_email`,`telephone` FROM `client` WHERE `numero_client`=1";
  $query_info = $con->prepare($sql_info);
  $query_info->execute();
  $results_info = $query_info->fetch(PDO::FETCH_ASSOC);
  ?>
<div class="modal fade" id="editinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content h-25">
        <div class="modal-body container p-5">
          <form action="editinfo.php" method="POST" id="myFormainfo" enctype="multipart/form-data">
            <h2 class="text-center">Modifier le profil</h2>
            <div class=" d-flex flex-column gap-3">
              <div class="formvalid">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" value="<?php echo $results_info["nom"] ?>"/>
                <small></small>

              </div>
              <div class="formvalid" >
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" min="0" name="prenom" class="form-control" id="prenom" value="<?php echo $results_info["prenom"] ?>" placeholder="Prenom"/>
                  <small></small>

              </div>
              <div class="formvalid">
                <label for="telephon" class="form-label">Telephone</label>
                <input type="number" name="telephon" class="form-control" id="telephon" minlenght="10" maxlength="10" placeholder="Telephone" value="<?php echo $results_info["telephone"] ?>" />
                  <small></small>

              </div>
              <div class="formvalid">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $results_info["adresse_email"] ?>" />
                                <small></small>

              </div>
              <div class="formvalid">
                <label for="mot_passe" class="form-label">Mot de passe</label>
                <div class="input-group">
                <input type="password" name="mot_passe" class="form-control" id="mot_passe" placeholder="mot de passe"  />
                <span class="input-group-text"  id="togglePassword"><i class="fa fa-eye-slash"></i></span>
                </div>
                  <small></small>

              </div>
              <div class="formvalid">
                <label for="mot_passe_confirm" class="form-label">Confirmation de mot de passe</label>
                <div class="input-group">
                   <input type="password" name="mot_passe_confirm" class="form-control" id="mot_passe_confirm" placeholder="mot de passe"  />
                   <span class="input-group-text" ><i class="fa fa-eye-slash" id="togglePasswordconfirm"></i></span>
                </div>
                                  <small></small>

              </div>

              <div class="justify-content-end d-flex">
                <button name="updatprofil" value="updatprofil" type="submit" class="btn bg-dark text-white" id="updatprofil">Modifier</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <?php require('modal_add.php') ?>
    </div>
</div>
</div>

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













<script src="gestion.js"></script>



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