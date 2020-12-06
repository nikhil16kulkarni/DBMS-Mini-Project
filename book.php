<?php
include "connection.php";
include "functions.php";

session_start();


$fullname = $_POST['name'];
$model = $_POST['model'];
$vno = $_POST['vno'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$date = $_POST['date'];

$s = "SELECT * from customer where full_name = '$fullname'";
$result = mysqli_query($con, $s);
$id = mysqli_fetch_array($result);
    
    $gbid = generate_bid();
    $query = "insert into appointment(full_name, model_name, vehicle_no, phone, address, date, mech_assign, gbid) values ('$fullname','$model', '$vno','$phone','$address','$date','N','$gbid')";
    if(mysqli_query($con, $query))
    {
        echo '<script>alert("Booking Successful !"); window.location.href ="loginCu.html";</script>';
    }
    else{
        header('Location:./appointment/form.html');
    }

?>