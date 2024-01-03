<?php
include 'config.php';
if(isset($_POST['car_register'])){

   $image = $_FILES['file']['name'];

   $image = $_POST["file"];

    $car_id = $_POST["plate_id"];
    
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

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

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
            padding: 0px 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            color: black !important;
        }

        .sidebar {
            display: flex !important;
            padding: 0px 20px;
            display: block;
            grid-column: span 1;
        }

        .sidebar form {
            display: flex;
            flex-direction: column;
        }

        .sidebar_option {
            margin: 0px 0px 30px 0px;
            border-bottom: 1px solid lightgray;
        }

        .sidebar_option input[type="radio"] {
            accent-color: #1089ff;
        }

        input[type="text"] {
            margin: 10px 10px 10px 30px;
            padding: 5px;
            border: 0px solid black;
            border-radius: 5px;
            background-color: lightgray;
        }

        .new_car_form{
            grid-column: 2 / 4;
            background-color: rgb(254, 227, 213);
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: 1fr;
        }
        .new_car_form .group{
            margin: 0px 0px 20px 0px;
        }
        .file_group{
            grid-column: 3;
        }
        .file_group input[type="file"]{
            display: none;
        }
        .file_group label{
            height: 100px;
            width: 150px;
            border-radius: 6px;
            border: 1px dashed #999;
            text-transform: capitalize;
        }
        .file_group label:hover{
            color: #de0611;
            border: 1px dashed #de0611;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Car<span>Book</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
                    <li class="nav-item active"><a href="pricing.php" class="nav-link">Pricing</a></li>
                    <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/home-header.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Dashboard <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Dashboard</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-cart flex_section">
        <div class="middle">
            <div class="sidebar">
                <form action="dashboard.php">
                    <h2 style="text-align: left !important;">Filters</h2>
                    <div class="sidebar_option">
                        <input type="radio" id="option1" name="group1" value="option1" onclick="choose()">
                        <label for="option1">Show Reservation</label><br>
                        <input type="text" name="start_date" placeholder="Start Date" id="text1" disabled>
                        <input type="text" name="end_date" placeholder="End Date" id="text2" disabled>
                    </div>
                    <div class="sidebar_option">
                        <input type="radio" id="option2" name="group1" value="option2" onclick="choose()">
                        <label for="option1">Show Car Status</label><br>
                        <input type="text" name="start_date" placeholder="Choose Date" id="text3" disabled>
                    </div>
                    <div class="sidebar_option">
                        <input type="radio" id="option3" name="group1" value="option3" onclick="choose()">
                        <label for="option1">Show Customer</label><br>
                        <input type="text" name="start_date" placeholder="Customer id" id="text4" disabled>
                    </div>
                    <div class="sidebar_option">
                        <input type="radio" id="option4" name="group1" value="option4" onclick="choose()">
                        <label for="option4">Show Customer</label><br>
                        <input type="text" name="start_date" placeholder="Start Date" id="text5" disabled>
                        <input type="text" name="end_date" placeholder="End Date" id="text6" disabled>
                    </div>
                    <input type="submit" value="GO" style="width: 90% !important; margin: 0px auto;"
                        class="btn btn-secondary">
                </form>
            </div>
            <form action="dashboard.php" method="POST" class="new_car_form">
                <div class="up_group">
                    <div class="group">
                        <label>Plate id</label><br>
                        <input name="plate_id" id="plate_id" type="text" placeholder="car plate id">
                    </div>
                    <div class="group">
                        <label>Car Model</label><br>
                        <input name="model" id="model" type="text" placeholder="car model">
                    </div>
                    <div class="group">
                        <label>Car Manufacturer</label><br>
                        <input name="manufacturer" id="manufacturer" type="text" placeholder="car manufacurer">
                    </div>
                    <div class="group">
                        <label>Car Color</label><br>
                        <input name="color" id="color" type="text" placeholder="car color">
                    </div>
                </div>
                <div class="up_group">
                    <div class="group">
                        <label>Price/Day</label><br>
                        <input name="price" id="price" type="text" placeholder="car price/day">
                    </div>
                    <div class="group">
                        <label>Mileage</label><br>
                        <input name="mileage" id="mileage" type="text" placeholder="car mileage">
                    </div>
                    <div class="group">
                        <label>Office id</label><br>
                        <input name="office_id" id="office_id" type="text" placeholder="car office id">
                    </div>
                    <input name="car_register" id="car_register" type="submit" value="GO" class="btn btn-secondary" style="min-width: 70%; align-self: center; display: block !important; margin: auto;">
                </div>
                <div class="file_group">
                    <input type="hidden">
                    <img src="images/upload.jpg" id="image" style="width: 300px; height: 175px; margin: 10px;"/>
                    <label for="file" class="btn btn-secondary py-3 px-4" style="height: 45px; width: 300px; margin-top: 10px; margin-left: 10px;">Upload File</label>
                    <input type="file" name="file" id="file" accept="images/*">
                    
                    
                </div>
            </form>
        </div>
    </section>


    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="#" class="logo">Car<span>book</span></a></h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
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
                                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain
                                        View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
                                            210</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved | This template
                        is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

    <script>
        let img = document.getElementById("image");
        let inputFile = document.getElementById("file");
        let urlStore = document.getElementById("car-image");

        inputFile.onchange = function(){
            img.src = URL.createObjectURL(inputFile.files[0]);
            urlStore.value = img.src;
        }
    </script>

    <script>
        function choose() {
            var option1 = document.getElementById("option1");
            var option2 = document.getElementById("option2");
            var option3 = document.getElementById("option3");
            var option4 = document.getElementById("option4");
            var text1 = document.getElementById("text1");
            var text2 = document.getElementById("text2");
            var text3 = document.getElementById("text3");
            var text4 = document.getElementById("text4");
            var text5 = document.getElementById("text5");
            var text6 = document.getElementById("text6");

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

            text5.disabled = option4.checked ? false : true;
            if (text5.disabled == false) {
                text5.style.backgroundColor = "white";
            } else {
                text5.style.backgroundColor = "#D3D3D3";
            }

            text6.disabled = option4.checked ? false : true;

            if (text6.disabled == false) {
                text6.style.backgroundColor = "white";
            } else {
                text6.style.backgroundColor = "#D3D3D3";
            }
        }
    </script>
</body>

</html>