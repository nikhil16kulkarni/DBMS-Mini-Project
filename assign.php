<?php
include 'connection.php';

session_start();


if(isset($_POST['book']) && isset($_POST['mech'])){
    $bookid = $_POST['book'];
    $mechname = $_POST['mech'];
    $query = "INSERT INTO done_assign (bookid, mechname) VALUES ('$bookid','$mechname')";
    if(mysqli_query($con, $query)){
        $query = "CREATE TRIGGER `changefieldmech` AFTER INSERT ON `done_assign` FOR EACH ROW UPDATE mechanic SET work_status = 'busy' WHERE full_name = '$mechname'";
        if(mysqli_query($con, $query)){
            echo '<script>alert("Assigned Successfully !"); window.location.href = dashad.php?id =$id;</script>';
    }
    else{
        echo '<script>alert("Failed !");</script>';
}
}
}
?>