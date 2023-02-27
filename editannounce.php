<?php 
include "connect.php";
$a=$_POST["id"];
$images= array();
$image=$_POST["imageupdtat$a"];
$files= $_FILES["images_updat$a"]["name"];
// $fileName = $_FILES["images_updat$a"]["name"][$i];
// $tempName = $_FILES["images_updat$a"]["tmp_name"][$i];
// $folder = "images/" . $fileName;
// move_uploaded_file($tempName, $folder);
$images= array();
for ($i=0; $i < count($_FILES["images_updat$a"]['name']); $i++) { 
    $images[]=$_FILES["images_updat$a"]['name'][$i];
}
$images=array_merge($images, $_POST["imageupdtat$a"]);
$count=count($images);
try {
    $sql_delete= "DELETE FROM `images` WHERE `numero_annouce`=:numero_annouce";
    $query_delete = $con-> prepare( $sql_delete );
    $query_delete-> execute(array( ':numero_annouce'=>$_POST["id"]));
    $result_delete = $query_delete -> fetchAll(PDO::FETCH_ASSOC);
    $check=0;
    $sql = "UPDATE `announce` SET `titre`=:title,`prix`=:price,`date_modification`=:dateupdat,`categorie`=:categorie,`Type`=:type,`code_postal`=:codepostal,`Ville`=:ville WHERE  `numero_annouce`=:numero_annouce";
      $query = $con->prepare( $sql );
      $result = $query->execute( array( ':title'=>$_POST["titleupdat"], ':price'=>$_POST["priceupdat"],':dateupdat'=>date('Y-m-d'),':categorie'=>$_POST["categorieupdat"], ':type'=>$_POST["typeupdat"], ':codepostal'=>$_POST["codpostalupdat"], ':ville'=>$_POST["villeupdat"], ':numero_annouce'=>$_POST["id"]) );
      if ($result)
      {
        echo "dkhel";
          for ($i=0; $i < count($images) ; $i++) { 

              if ($images[$i]== $_POST['statuupdat']) {
                  $check=1;
              }
              else
              {
                  $check=0;
              }
              echo $check;
              $sql_insert=" INSERT INTO images (`id_image`, `image`, `check_image`, `numero_annouce`) VALUES (NULL , :image , :check_image, :numero_annouce)";
              $query_insert = $con->prepare( $sql_insert );
              $result_insert = $query_insert->execute( array(':image'=>$images[$i] , ':check_image'=>$check,':numero_annouce'=>$_POST["id"]));
          }
      }
      header("location: profile.php");

} catch (PDOException $e) {
  echo "There is some problem in connection: " . $e->getMessage();
}
?>