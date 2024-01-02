<!DOCTYPE html>
<?php
include "config.php";
// var_dump($_POST);
if (isset($_POST["filter_button"])) {
  
  $option = $_POST["group"];
  if($option == '1')
  {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $q = "SELECT * from reservation as r
          JOIN car ON r.plate_id = car.plate_id
          JOIN customer ON customer.id = r.customer_id
          WHERE r.start_date>='$start_date' AND r.end_date< '$end_date';";

    $q2 = "SELECT 
    start_date,
    SUM(total_price) AS total_price_for_day
    FROM 
        reservation
    WHERE
        reservation.start_date BETWEEN '$start_date'  and '$end_date'
    GROUP BY 
        start_date;";
  }
  elseif($option == '2')
  {
      $date = $_POST['date'];
      $q = "SELECT car.plate_id, car.model, car.image, car.price,
      IF(car.plate_id IN (SELECT r.plate_id
                          FROM reservation as r
                          WHERE r.start_date <= 'date'
                          AND r.end_date > 'date'),
                          'rented', 'available') AS `status`
      FROM car;";
  }
  elseif($option == '3')
  {
    $cus_email = $_POST['email'];
    $q = "SELECT * from reservation as r
          JOIN car ON r.plate_id =car.plate_id
          JOIN customer as c ON c.id = r.customer_id
          WHERE c.email='$cus_email';";
  }
}
else
{
  header("Location: dashboard.php");
}
?>

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
    html,
    body {
      height: 100%;
    }

    .flex_section {
      background-color: rgb(248, 248, 248);
    }

    .middle {
      width: 100%;
      /* box-sizing: border-box; */
      padding: 0px 30px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
    }

    .sidebar {
      display: flex !important;
      flex-direction: column;
      padding: 0px 20px;
      color: black;
      border-right: 2px solid rgba(0, 0, 0, 0.25);
    }
    .r4_card{
      padding: 20px;
      margin: 20px;
      font-size: 16px;
      background-color: white;
      border-radius: 5px;
      display: block; 
    }

    .cars_container {
      display: flex !important;
      height: 100%;
      grid-column: span 3;
    }

    .table {
      width: 100% !important;
    }

    th,
    td {
      max-width: 200px !important;
      min-width: 190px !important;
      text-align: center;
      padding: 30px 20px 30px 20px !important;
    }
    .product-name{
      text-align: left !important;
    }

    td p,
    label {
      margin: 0px;
    }

    tbody td {
      background-color: white;
      border-radius: 7px;
    }

    td p label {
      color: red;
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
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pricing <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Pricing</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-cart flex_section">
    <div class="middle">
      <?php 
        if($option == '1'){
      ?>
      <div class="sidebar">
      <h2>Daily Payments</h2>
          <?php
          $result2 = mysqli_query($conn, $q2);
          while($row2 = mysqli_fetch_assoc($result2))
          {
            $date = $row2['start_date'];
            $payment = $row2['total_price_for_day']
            ?>
            <div class="r4_card">
              <p>date: <?php echo"$date"; ?></p>
              <p>payments: $<?php echo"$payment"; ?></p>
            </div>

          <?php }?>
      </div>
      <?php } ?>
      
      <div class="cars_container">
        <table class="table">
          <thead class="thead-primary">
            <tr class="text-center">
              <th></th>
              <th class="bg-primary heading">Car Model</th>
              <th class="bg-primary heading">Reservation</th>
              <th class="bg-black heading">Customer</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $result = mysqli_query($conn, $q);
              while($row = mysqli_fetch_assoc($result)){
                if($option == '1' || $option == '3')
                {
                  $car_img = $row['image'];
                  $car_id = $row['plate_id'];
                  $car_model = $row['model'];
                  $car_status = $row['status'];
                  $car_price = $row['price'];
                  $res_start = $row['start_date'];
                  $res_end = $row['end_date'];
                  $res_cost = $row['total_price'];
                  $cus_name = $row['name'];
                  $cus_phone = $row['phone_number'];
                }
                elseif($option == '2')
                {
                  $car_img = $row['image'];
                  $car_id = $row['plate_id'];
                  $car_model = $row['model'];
                  $car_status = $row['status'];
                  $car_price = $row['price'];
                  
                  $res_start = "-";
                  $res_end = "-";
                  $res_cost = "-";
                  $cus_name = "-";
                  $cus_phone = "-";
                }
            ?>
            <tr class="">
              <td class="car-image">
                <div class="img" style="background-image:url(<?php echo "$car_img";?>);"></div>
              </td>
              <td class="product-name">
                <h3><?php echo "$car_model"; ?></h3>
                <p class="mb-0 rated">
                  <span style="color: black;">$<?php echo "$car_price";?>/per day</span>
                  <span style="color: black;">currently <?php echo "$car_status";?></span>
                </p>
              </td>

              <td class="product-name">
                <div class="price-rate">
                  <span class="subheading">from: <?php echo "$res_start";?></span> <br>
                  <span class="subheading">to: <?php echo "$res_end";?></span> <br>
                  <span class="subheading">paid $<?php echo "$res_cost";?></span>
                </div>
              </td>

              <td class="product-name">
                <div class="price-rate">
                  <span class="subheading">Name: <?php echo "$cus_name";?></span> <br>
                  <span class="subheading">Phone: <?php echo "$cus_phone";?></span>
                </div>
              </td>
            </tr><!-- END TR-->
          <?php } ?>
          </tbody>
        </table>
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

  <script>
    function choose() {
      var option1 = document.getElementById("option1");
      var option2 = document.getElementById("option2");
      var option3 = document.getElementById("option3");
      var text1 = document.getElementById("text1");
      var text2 = document.getElementById("text2");
      var text3 = document.getElementById("text3");
      var text4 = document.getElementById("text4");

      text1.disabled = option1.checked ? false : true;
      if (text1.disabled == false) {
        text1.style.backgroundColor = "white";
      } else {
        text1.style.backgroundColor = "#D3D3D3";
      }

      text2.disabled = option1.checked ? false : true;
      if (text2.disabled == false) {
        text2.style.backgroundColor = "white";
      } else {
        text2.style.backgroundColor = "#D3D3D3";
      }


      text3.disabled = option2.checked ? false : true;
      if (text3.disabled == false) {
        text3.style.backgroundColor = "white";
      } else {
        text3.style.backgroundColor = "#D3D3D3";
      }

      text4.disabled = option3.checked ? false : true;
      if (text4.disabled == false) {
        text4.style.backgroundColor = "white";
      } else {
        text4.style.backgroundColor = "#D3D3D3";
      }
    }
  </script>

</body>

</html>