<?php
  require 'config.php';
  
  
  if(empty($_SESSION['client_id']))
  {
    header("Location: login.php");
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

    <script>
      function viewCar(carId){
        window.location.href = "single_car.php?car_id=" + carId;
      }
    </script>
    

  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Auto<span>Rent</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/home-header.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose Your car, <?php echo $_SESSION['client_name'];?>!</h1>
          </div>
        </div>
      </div>
    </section>
    
		

		<section class="ftco-section bg-light">
    	<div class="container">
        <h3>Filter By</h3>
        <form action="car.php" method="get">
        <div class="row" style="margin: 0px auto 30px 0px; display: block; width: 800px"> 

        <input type="radio" value="color" id="color" name="search" checked/>
      <label for="color" style="margin-right: 20px">Color</label>

      <input type="radio" value="model" id="model" name="search"/>
      <label for="model" style="margin-right: 20px">model</label>

      <input type="radio" value="manufacturer" id="Manufacturer" name="search"/>
      <label for="Manufacurer" style="margin-right: 20px">Manufacturer</label>

      <input type="radio" value="stat" id="stat" name="search"/>
      <label for="stat" style="margin-right: 20px">Status</label>
      
      <input type="radio" value="price" id="price" name="search"/>
      <label for="price" style="margin-right: 20px">Price</label>

      <input type="radio" value="mil" id="mil" name="search"/>
      <label for="mil" style="margin-right: 20px">Mileage</label>

      <input type="radio" value="office" id="office" name="search"/>
      <label for="office" style="margin-right: 20px">office name</label>
      <br><br>
      <input type="text" name="search_bar" id="search_bar" />
      <input type="submit" name="search_submit" id="search_submit" value="search" style="width: 100px"
      class="btn btn-secondary py-2 ml-1">
      <br><br>

  
    </div>
    
    		<div class="row">
				<?php
          include("config.php");

          
          
          $q = "SELECT * FROM car";

          if(isset($_GET["search_submit"])){
            
            $search = $_GET['search'];
            $color_search = $_GET['search_bar'];

            if($search == "color"){
              $q = "SELECT * FROM car WHERE car.color = '$color_search'";
            }else if($search == "model"){
              $q = "SELECT * FROM car WHERE car.model = '$color_search'";
            }else if($search == "manufacturer"){
              $q = "SELECT * FROM car WHERE car.manufacturer = '$color_search'";
            }else if($search == "stat"){
              $q = "SELECT * FROM car WHERE car.status = '$color_search'";
            }else if($search == "price"){
              $q = "SELECT * FROM car WHERE car.price = '$color_search'";
            }else if($search == "mil"){
              $q = "SELECT * FROM car WHERE car.mileage = '$color_search'";
            }else if($search == "office"){
              $q = "SELECT * FROM car INNER JOIN office
              ON car.office_id = office.id
              WHERE office.name = '$color_search'";
            }else{
              $q = "SELECT * FROM car";
            }
          }
					
          $result = mysqli_query($conn, $q);
          if(mysqli_num_rows($result) == 0){
            echo "<p>No results found.</p>
            <image src=\"images/not_found.png\" style=\"width: 500px; hight: 500px\"/>
            ";
            return;
          }
					while($row = mysqli_fetch_assoc($result))
					{
            $car_id = $row['plate_id'];
						$car_model = $row['model'];
						$car_status = $row['status'];
						$car_img = $row['image'];
						$car_price = $row['price'];
				?>
    			<div class="col-md-4">
    				<div class="car-wrap rounded ftco-animate">
    					<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo $car_img ?>);">
    					</div>
    					<div class="text">
    						<h2 class="mb-0"><a href="car-single.html"><?php echo $car_model ?></a></h2>
    						<div class="d-flex mb-3">
	    						<span class="cat" <?php include("car_status.php") ?> >
									<?php echo ucfirst($car_status); ?>
								</span>
	    						<p class="price ml-auto"><?php echo "$$car_price"; ?> <span>/day</span></p>
    						</div>
    						<p class="d-flex mb-0 d-block">
                                <form action="single_car.php" method="get">
                                    <input type="hidden" name="car_id" style="visibility: hidden;" value="<?php echo "$car_id";?>">
                                    <input type="submit" name="details_button" value="Details" style="width: 100%;" class="btn btn-secondary py-2 ml-1">
                                </form>
                                <!-- <?php echo "<a style=\"width: 100%;\" onclick=\"viewCar({$car_id})\" class=\"btn btn-secondary py-2 ml-1\">Details</a>"?> -->
                            </p>
    					</div>
    				</div>
    			</div>
				<?php } ?>
    		</div>
      </form>
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