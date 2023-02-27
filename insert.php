<?php 
include("connect.php");
session_start();
try {
    $check = 0;
    $count = count($_FILES['images']['name']);
    
    // SQL query to insert data into the announce table
    $sql = "INSERT INTO announce (`numero_annouce`, `titre`, `prix`, `date_publication`, `date_modification`, `categorie`, `Type`, `code_postal`, `Ville`, `numero_client`) 
            VALUES (NULL, :title, :price, :datepub, :dateupdat, :categorie, :type, :codepostal, :ville, :client)";
    
    // Prepare the query and bind the parameters
    $query = $con->prepare($sql);
    $result = $query->execute(array(
        ':title' => $_POST["titleAdd"], 
        ':price' => $_POST["priceAdd"],
        ':datepub' => date('Y-m-d'),
        ':dateupdat' => date('Y-m-d'),
        ':categorie' => isset($_POST["categorieaadd"]) ? $_POST["categorieaadd"] : 'default_value', 
        ':type' => isset($_POST["typeAdd"]) ? $_POST["typeAdd"] : 'default_value', 
        ':codepostal' => $_POST["codpostal"], 
        ':ville' => $_POST["villeadd"], 
        ':client' => isset($_SESSION["client_id"]) ? $_SESSION["client_id"] : '1' 
    ));

    if ($result) {
        // Get the ID of the newly inserted row
        $lastindex = $con->lastInsertId();

        // Loop through each uploaded file and insert its data into the images table
        for ($i = 0; $i < $count; $i++) { 
            $fileName = $_FILES["images"]["name"][$i];
            $tempName = $_FILES["images"]["tmp_name"][$i];
            $folder = "images/" . $fileName;
            move_uploaded_file($tempName, $folder);
            
            // Set the check value based on whether the current file is the checked image
            if ($_FILES['images']['name'][$i]== $_POST['statu']) {
                $check=1;
            }
            else
            {
                $check=0;
            }
            
            // SQL query to insert data into the images table
            $sql1 = "INSERT INTO images (`image`, `check_image`, `numero_annouce`) VALUES (:image, :check_image, :numero_annouce)";
            
            // Prepare the query and bind the parameters
            $query1 = $con->prepare($sql1);
            $result1 = $query1->execute(array(
                ':image' => $fileName,
                ':check_image' => $check,
                ':numero_annouce' => $lastindex
            ));
        }
        
        // Redirect the user to the profile page
        header("location: profile.php");
    }
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}

?>