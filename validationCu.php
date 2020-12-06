<?php 

include "connection.php";

session_start();


if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $s = "select * from customer where email = '$email' && password = '$password'";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $id = $row['ID'];
       
        if($num == 1){
            $query = "select id from customer where email = '$email' && password = '$password'";
            $result = mysqli_query($con, $query);
            $_SESSION['id'] = $result;
            header ("location: dashcu.php?id=$id");
        }
        else{
            header("Location: loginCu.html");
        }
}

?>