<?php
require 'config.php';
if(isset($_POST['login']))
{
  $email = $_POST["email"];
  $password = $_POST["password"];

  $hashed_password = md5($password);

  $result = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$email'");
  $row = mysqli_fetch_assoc($result);

  if(mysqli_num_rows($result) > 0){

    if($hashed_password == $row["password"]){
      
      $_SESSION["login"] = true;
      $_SESSION["client_id"] = $row["id"];
      $_SESSION['client_name'] = $row["name"];
      header("Location: car.php");

    }else{
      echo"<script>alert('incorrect password');</script>";
    }

  }else{
    echo"<script>alert('email not found');</script>";
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

    <script src="login_validation.js"> </script>


  </head>
<body>
  <div class="container">
    <form action="#" method="post" onsubmit ="return valid_login()" class="request-form ftco-animate bg-primary fadeInUp ftco-animated">
      <h2 style="color: white">Welcome to AutoRent</h2>
      <div class="form-group">
        <label style="color: white" for="" class="label">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email">
      </div>
      <div class="form-group">
        <label style="color: white" for="" class="label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
      </div>
      
      <div class="form-group">
        <input type="submit" id="submit" name="login" value="Log in" class="btn btn-secondary py-3 px-4">
      </div>

      <p style="color: white">Don't have an account? <a href="register.php">Sign up now</a></p>
    </form>
  </div>
  
</body>
</html>