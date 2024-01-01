<?php
include 'config.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    
   $image = $_FILES['image-select']['name'];

   $image = $_POST["image-select"];

    $car_id = $_POST["plate-id"];
    
    $model = $_POST["model"];
    $manfacturer = $_POST["manufacturer"];
    $color = $_POST["color"];
    $price = $_POST["price"];
    $mileage = $_POST["mileage"];
    $officeId = $_POST["office_id"];

    $insertion = "INSERT INTO car (plate_id, model, manufacturer, color ,image, status, price, mileage, office_id) 
    VALUES('$car_id','$model', '$manfacturer', '$color', 'images/$image', 'available', '$price', '$mileage', '$officeId')";

    $result = mysqli_query($conn, $insertion);
    if(!$result){
        die("Error" . mysqli_error($conn));
    }
    
    echo "<script>alert('car registeration succefull');</script>";
    header("Location: car.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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

</head>
<body>
 
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Auto<span>Rent</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item active"><a href="car-registeration.php" class="nav-link">add a car</a></li>
	          <li class="nav-item"><a href="pricing.html" class="nav-link">Pricing</a></li>
	          <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
	          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>

      <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/home-header.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Register Your car, <?php echo $_SESSION['client_name'];?>!</h1>
          </div>
        </div>
      </div>
    </section>

<form action="car-registeration.php" method="post">        
    <div style="
        float: right;
        margin-right: 60px;">
        <img id="image" name="image" src="images/upload.jpg" 
        style="width: 700px; height: 60vh;">
        <br><br>
        <div class="form-group">
            <label for="image-select" class="btn btn-secondary py-3 px-4" style="width: 100vh;">select an image</label>
            <input type="file" id="image-select" name="image-select" style="display: none;" accept="image/*"/>
            <input type="hidden" id="car-image" name="car-image"/>
        </div>
    </div>
    <section
    style="
    background-color: white;
    border: 5px solid black !important;
    border-radius: 10px;
    margin-left: 20px;
    margin-right: 20px;
    width: 75vh;
    padding-bottom: 10px; 
    margin-top: 10px;
    "
    class="container">

       
        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">plate id</label>
            <input type="text" class="form-control" id="plate-id" name="plate-id" placeholder="plate id">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">Car model</label>
            <input type="text" class="form-control" id="model" name="model" placeholder="model">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">Car manufactrer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="manufacturer">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">Car color</label>
            <input type="text" class="form-control" id="color" name="color" placeholder="color">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">price/day</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="price">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">mileage</label>
            <input type="text" class="form-control" id="mileage" name="mileage" placeholder="eg. 10000">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: black;">office id</label>
            <input type="text" class="form-control" id="office_id" name="office_id" placeholder="id">
        </div>

        <div class="form-group">
            <input style="width: 65vh;" type="submit" name="car_register" value="register the car" class="btn btn-secondary py-3 px-4">
          </div>
    </form>

    </section>
  

    <script>
        let img = document.getElementById("image");
        let inputFile = document.getElementById("image-select");
        let urlStore = document.getElementById("car-image");

        inputFile.onchange = function(){
            img.src = URL.createObjectURL(inputFile.files[0]);
            urlStore.value = img.src;
        }
    </script>
        		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">

            </div>
          </div>
        </div>
    	</div>
    </section>
 <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    <?php mysqli_close($conn);?>


</body>


</html>