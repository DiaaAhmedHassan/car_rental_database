<?php
    if (isset($_POST['register']))
    {
        include("config.php");
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $duplicate = mysqli_query($conn, "SELECT * FROM CUSTOMER WHERE CUSTOMER.email = '$email' ");

        $hashed_password = md5($password);

        if(mysqli_num_rows($duplicate) > 0)
        {
            echo "<script>alert(\"this email already exists\");</script>";
        }
        else
        {
            if($password == $confirm_password){
                // inserting new user  
                $query = "INSERT INTO CUSTOMER (name, email, phone_number, password) VALUES('$name', '$email', '$phone', '$hashed_password')";
                mysqli_query($conn, $query);
                
                // retreving the new user's id (set by the database)
                $query = "SELECT id FROM customer WHERE email = '$email'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                // saving the id in the session variables
                $_SESSION['client_id'] = $row['id'];
                $_SESSION['client_name'] = $name;
                echo"<script>alert(\"registeration succesfull\");</script>";
                sleep(3);
                header("Location: car.php");
            }
            else
            {
                echo"<script>alert(\"password confirmation failed\");</script>";
            }
        }

        mysqli_close($conn);
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
    <form action="register.php" method="post" class="request-form ftco-animate bg-primary fadeInUp ftco-animated">
      <h2 style="color: white">Welcome to AutoRent</h2>
      <div class="form-group">
        <label style="color: white" for="" class="label">User name</label>
        <input type="text" class="form-control" placeholder="Enter Your name" name="name">
      </div>
      <div class="form-group">
        <label style="color: white" for="" class="label">Email</label>
        <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
      </div>
      <div class="form-group">
        <label style="color: white" for="" class="label">phone</label>
        <input type="text" class="form-control" placeholder="Enter Your phone number" name="phone">
      </div>
      
      <div class="form-group">
        <label style="color: white" for="" class="label">Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" name="password">
      </div>
      <div class="form-group">
        <label style="color: white" for="" class="label">confirm Password</label>
        <input type="password" class="form-control" placeholder="confirm your password" name="confirm_password">
      </div>
      <div class="form-group">
        <input type="submit" name="register" value="register" class="btn btn-secondary py-3 px-4">
      </div>

      <p style="color: white">already have an account? <a href="login.php">Sign in now</a></p>
    </form>
  </div>
</body>
</html>