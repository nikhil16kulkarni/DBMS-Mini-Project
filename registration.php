<?php
include "connection.php";


session_start();


$fullname = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

//$s = "select * from administrator where username = '$uname'";
//$result = mysqli_query($con, $s);
//$num= mysqli_num_rows($result);
//
//if($num == 1){
//    echo 'Username taken' ;
//}

    $reg = "insert into administrator(name, email, password) values ('$fullname','$email', '$password')";
    if(mysqli_query($con, $reg))
    {
        header('Location:loginAd.html');
    }
    else{
        header('Location:registerAd.html');
    }

?>