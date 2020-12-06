<?php
include 'connection.php';

session_start();

$id = $_GET['id'];

$parts = $_POST['parts'];
    $quantity = $_POST['quantity'];
    $book_id = $_POST['book_id'];
    
    $query6 = "insert into usedparts values ('$book_id','$parts','$quantity')";
    if(mysqli_query($con, $query6)){
        header ("location:dashme.php?id=$id");
    }
    else{
        header ("location:dashme.php?id=$id");
    }
?>