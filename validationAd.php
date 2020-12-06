<?php 

include "connection.php";

session_start();


if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $s = "select * from administrator where email = '$email' && password = '$password'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $id = $row['ID'];
       
        if($num == 1){
            $query = "CALL `showAppointment`();";
            $result = mysqli_query($con, $query);
            header ("location: dashad.php?id=$id");
        }
        else{
            header("Location: loginAd.html");
        }
}

?>