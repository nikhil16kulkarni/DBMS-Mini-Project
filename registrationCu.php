<?php
include "connection.php";

session_start();


$fname = $_POST['fname'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = trim($_POST['phone']);
$address = $_POST['address'];
$gender = $_POST['gender'];


//$s = "select * from administrator where username = '$uname'";
//$result = mysqli_query($con, $s);
//$num= mysqli_num_rows($result);
//
//if($num == 1){
//    echo 'Username taken' ;
//}

    $reg = "insert into customer (full_name, email, password, phone_no, address, gender) values ('$fname','$email', '$password','$phone','$address','$gender')";
    if(mysqli_query($con, $reg))
    {
        header('Location:loginCu.html');
    }
    else{
        header('Location:registerCu.html');
    }


?>