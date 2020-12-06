<?php 
include 'connection.php';

    $bookId = $_POST['bookId'];
    $cart = $_POST["cartString"];
    $query = "INSERT INTO usedparts VALUES ('".$bookId."', '".$cart."')";
    if(mysqli_query($con,$query)){
      echo "👍";
    }else {
      echo "👎";
      echo "\n".$query;
    }


?>