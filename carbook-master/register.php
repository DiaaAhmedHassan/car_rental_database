<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    session_start();
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "car_rental";

    $conn = mysqli_connect($servername, $username, $pass, $dbname);
    if(! $conn)
    {
      die("failed to connect!");
    }
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $duplicate = mysqli_query($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMER.email = '$email' ");

    if(mysqli_num_rows($duplicate) > 0){
        echo "<script>alert(\"this email is already used\");</script>";
    }else{
        if($password == $confirm_password){
            $query = "INSERT INTO CUSTOMER (name, email, phone_number, password) VALUES('$name', '$email', '$phone', '$password')";
            mysqli_query($conn, $query);
            echo"<script>alert(\"registeration succesfull\");</script>";
        }
        else
        {
          echo"<script>alert(\"assword confirmation failed\");</script>";
        }
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
<body>
  
  <div class="container">
    <form action="#" method="post" class="request-form ftco-animate bg-primary fadeInUp ftco-animated">
      <h2>Welcome to AutoRent</h2>
      <div class="form-group">
        <label for="" class="label">User name</label>
        <input type="text" class="form-control" placeholder="Enter Your name" name="name">
      </div>
      <div class="form-group">
        <label for="" class="label">phone</label>
        <input type="text" class="form-control" placeholder="Enter Your phone number" name="phone">
      </div>
      <div class="form-group">
        <label for="" class="label">Email</label>
        <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
      </div>
      <div class="form-group">
        <label for="" class="label">Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="password">
      </div>
      <div class="form-group">
        <label for="" class="label">confirm Password</label>
        <input type="password" class="form-control" placeholder="confirm your password" name="confirm_password">
      </div>
      <div class="form-group">
        <input type="submit" value="Register" class="btn btn-secondary py-3 px-4">
      </div>

      <p>already have an account? <a href="login.html">Sign in now</a></p>
    </form>
  </div>

  
</body>
</html>