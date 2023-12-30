<?php
include 'config.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $image = $_POST["car-image"];
    $model = $_POST["model"];
    $manfacturer = $_POST["manufacturer"];
    $color = $_POST["color"];
    $price = $_POST["price"];
    $mileage = $_POST["mileage"];
    $officeId = $_POST["office_id"];

    $insertion = "INSERT INTO car (plate_id, model, manufacturer, color ,image, status, price, mileage, office_id) 
    VALUES(40,'$model', '$manfacturer', '$color', '$image', 'available', '$price', '$mileage', '$officeId')";

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car registeration</title>

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
    <section style="
    background-image: linear-gradient(rgb(1, 99, 127),rgba(26, 208, 240, 0.456));
    margin-left: 20px;
    margin-right: 20px;
    width: 70vh;
    padding-bottom: 10px; 
    margin-top: 10px;
    border: 10px;
    border-color: black;
    border-radius: 5px;
    border-width: 20px;
    "
    class="container">

        <h1 style="margin-left: 25px;color: white;">New car registeration</h1>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: white;">Car model</label>
            <input type="text" class="form-control" id="model" name="model" placeholder="model">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: white;">Car manufactrer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="manufacturer">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: white;">Car color</label>
            <input type="text" class="form-control" id="color" name="color" placeholder="color">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: white;">price/day</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="price">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: white;">mileage</label>
            <input type="text" class="form-control" id="mileage" name="mileage" placeholder="eg. 10000">
        </div>

        <div class="form-group ml-2" style="margin: 10px;">
            <label for="" class="label" style="color: white;">office id</label>
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



</body>
</html>