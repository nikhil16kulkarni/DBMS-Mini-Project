<?php


$username = "root";
  $password = "";
  $db = "dbms";
  $host = "localhost";
  $port = 3307;

  $con = mysqli_connect(
    "$host:$port",
    $username,
    $password
  );



mysqli_select_db($con, $db);

?>