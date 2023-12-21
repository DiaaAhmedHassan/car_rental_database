<?php

    // session_start();
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "car_rental";

    $conn = mysqli_connect($servername, $username, $pass, $dbname);
    if(! $conn)
    {
    die("failed to connect!");
    }

?>