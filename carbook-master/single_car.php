<?php
include("config.php");
function numberOfDays($sDate, $eDate){
	$sDate = strtotime($sDate);
	$eDate = strtotime($eDate);

	$noDays = round(($eDate - $sDate)/(60*60*24));

	return $noDays;
}

	if(isset($_GET['details_button']))
	{
		

		//querying the car
		$car_id = $_GET['car_id'];
		$query = "SELECT * FROM car WHERE plate_id = $car_id";
		$result = mysqli_query($conn, $query);
		$car = mysqli_fetch_assoc($result);
		$car_model = $car['model'];
		$car_img = $car['image'];
		$car_mileage = $car['mileage'];
		$car_price = $car['price'];
		$car_manufacturer = $car['manufacturer'];
		$car_status = $car['status'];
		
		

		if($car_status == "rented")
		{
			$status = "disabled";
			$rentButton = "Rented";
			$buttonColor = "orange";
		}
		else if($car_status == 'maintenance')
		{
			$status = "disabled";
			$rentButton = "Maintenance";
			$buttonColor = "red";
		}
		else
		{
			$status = null;
			$rentButton = "Rent Now!";
			$buttonColor = "#01d28e";
		}

		// querying the office
		$q2 = "SELECT office.name, office.country FROM office WHERE {$car['office_id']} = office.id";
		$officeData = mysqli_query($conn, $q2);
		$officeRow = mysqli_fetch_assoc($officeData);
		$officeName = $officeRow['name'];
		$officeCountry = $officeRow['country'];
	}



	if(isset($_GET['rent_button']))
    {
		

       // include "config.php";
        $car_id = $_GET["car_id"];
        $startDate = $_GET["start_date"];
        $endDate = $_GET["end_date"];
        $time = $_GET["time_pick"];
		$car_price = $_GET["car_price"];
		
		$nDays = numberOfDays($startDate, $endDate);
        $totalPrice = $nDays*$car_price;
		
        $renting = "INSERT INTO reservation (start_date, end_date, total_price, customer_id, plate_id, time) values ('$startDate', '$endDate', '$totalPrice','{$_SESSION['client_id']}', '$car_id', '$time');";
        mysqli_query($conn, $renting);
        
        $q = "CALL update_car_status();";
  		mysqli_query($conn, $q);

		$q = "SELECT * FROM reservation AS r WHERE r.start_date = '$startDate' AND r.end_date = '$endDate' AND r.plate_id = '$car_id'";
		$result = mysqli_query($conn, $q);
		$row = mysqli_fetch_assoc($result);
        echo "<script>window.location='car.php'; alert('Rent Successful total price will be: \${$row['total_price']}'); </script>";
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

	<style>
		form{
			width: 40%;
			margin-left: 15px;
			padding: 15px;
			box-shadow: none;
			height: 40px;
			font-size: 12px;
		}
		.car-img{
			width: 100%;
			height: 100%;
			height: auto;
		}
		form h2{
			font-size: 26px;
			font-weight: 600;
		}
		form h2, form label{
			color: black !important;
		}
		form input[type="text"]{
			border-color: black !important;
			padding: 4px 8px;
		}
		form input[type="submit"]{
			width: 100%;
		}
		form p{
			font-size: 16px;
			margin-bottom: 0px;
		}
	</style>

</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html">Car<span>Book</span></a>
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
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
					<h1 class="mb-3 bread">Car Details</h1>
				</div>
			</div>
		</div>
	</section>


	<section class="ftco-section ftco-car-details">
		<div class="container">
			<div style="display: flex;">
				<div class="img rounded" style="width: 100%; object-fit:contain;">
					<img class="car-img" src="<?php echo "$car_img"; ?>" alt="car">
				</div>
				<!-- need to validate if the car is rented or not -->
				<!-- model -->
				<!-- manufacturer -->
				<!-- country -->
				<!-- office -->
				<!-- price "at the end of the form" -->
				<form action="single_car.php" method="get" class="ftco-animate">
					<h2><?php echo "$car_model"?></h2>
					<p><label>Manufacurer:</label> <?php echo "$car_manufacturer"?></p>
					<p><label>Available at:</label> <?php echo "$officeCountry"?>, <?php echo "$officeName"?></p>
					<input type="hidden" name="car_id" value="<?php echo "$car_id";?>">
					<div class="d-flex">
						<div class="form-group mr-2">
							<label for="" class="label">Start date</label>
							<input type="text" class="form-control" id="start_date" name="start_date" placeholder="Date">
						</div>
						<div class="form-group ml-2">
							<label for="" class="label">End date</label>
							<input type="text" class="form-control" id="end_date" name="end_date" placeholder="Date">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="label">Pick-up time</label>
						<input type="text" class="form-control" id="time_pick" name="time_pick" placeholder="Time">
					</div>
					<p style="margin: 0; padding: 0;">
					<label style="color: black;">Price/Day:</label> 
					<input type="text" id="car_price" style="border: none; background: none" readonly name="car_price" value="<?php echo $car_price?>"/>
					</p>
					<div class="form-group">
						<input type="submit" name="rent_button" value="<?php echo "$rentButton" ?>" class="btn btn-secondary py-3 px-4"style="background: <?php echo "$buttonColor"?> !important; border: none !important;" <?php echo "$status"?>>
					</div>
				</form>

			</div>
			<div class="row">
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Mileage
										<span><?php echo "$car_mileage"; ?></span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Transmission
										<span>Manual</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Seats
										<span>5 Adults</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-backpack"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Luggage
										<span>4 Bags</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services">
						<div class="media-body py-md-4">
							<div class="d-flex mb-3 align-items-center">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
								<div class="text">
									<h3 class="heading mb-0 pl-3">
										Fuel
										<span>Petrol</span>
									</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 pills">
					<div class="bd-example bd-example-tabs">
						<div class="d-flex justify-content-center">
							<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								<li class="nav-item">
									<a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Review</a>
								</li>
							</ul>
						</div>

						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								<div class="row">
									<div class="col-md-4">
										<ul class="features">
											<li class="check"><span class="ion-ios-checkmark"></span>Airconditions</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Child Seat</li>
											<li class="check"><span class="ion-ios-checkmark"></span>GPS</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Luggage</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Music</li>
										</ul>
									</div>
									<div class="col-md-4">
										<ul class="features">
											<li class="check"><span class="ion-ios-checkmark"></span>Seat Belt</li>
											<li class="remove"><span class="ion-ios-close"></span>Sleeping Bed</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Water</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Bluetooth</li>
											<li class="remove"><span class="ion-ios-close"></span>Onboard computer</li>
										</ul>
									</div>
									<div class="col-md-4">
										<ul class="features">
											<li class="check"><span class="ion-ios-checkmark"></span>Audio input</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Long Term Trips</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Car Kit</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Remote central locking</li>
											<li class="check"><span class="ion-ios-checkmark"></span>Climate control</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
								<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
								<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
							</div>

							<div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
								<div class="row">
									<div class="col-md-7">
										<h3 class="head">23 Reviews</h3>
										<div class="review d-flex">
											<div class="user-img" style="background-image: url(images/person_1.jpg)"></div>
											<div class="desc">
												<h4>
													<span class="text-left">Jacob Webb</span>
													<span class="text-right">14 March 2018</span>
												</h4>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
													</span>
													<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
												</p>
												<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
											</div>
										</div>
										<div class="review d-flex">
											<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
											<div class="desc">
												<h4>
													<span class="text-left">Jacob Webb</span>
													<span class="text-right">14 March 2018</span>
												</h4>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
													</span>
													<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
												</p>
												<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
											</div>
										</div>
										<div class="review d-flex">
											<div class="user-img" style="background-image: url(images/person_3.jpg)"></div>
											<div class="desc">
												<h4>
													<span class="text-left">Jacob Webb</span>
													<span class="text-right">14 March 2018</span>
												</h4>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
													</span>
													<span class="text-right"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
												</p>
												<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrov</p>
											</div>
										</div>
									</div>

									<div class="col-md-5">
										<div class="rating-wrap">
											<h3 class="head">Give a Review</h3>
											<div class="wrap">
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(98%)
													</span>
													<span>20 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(85%)
													</span>
													<span>10 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(70%)
													</span>
													<span>5 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(10%)
													</span>
													<span>0 Reviews</span>
												</p>
												<p class="star">
													<span>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														<i class="ion-ios-star"></i>
														(0%)
													</span>
													<span>0 Reviews</span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg></div>


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

</body>

</html>