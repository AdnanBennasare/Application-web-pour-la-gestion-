<?php
try {
    include("connect.php");
    $sql1="DELETE FROM `images` WHERE `numero_annouce` =:numero_annouce";
    $query1 = $con->prepare( $sql1 );
    $result1 = $query1->execute( array(':numero_annouce'=>$_POST["id"]));
    if($result1)
    {
        $sql="DELETE FROM `announce` WHERE `numero_annouce` =:numero_annouce";
        $query = $con->prepare( $sql );
        $result = $query->execute( array(':numero_annouce'=>$_POST["id"]));
        header("location: profile.php");
    }


} catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }

            
?>