<?php
    if(isset($_POST['rent_button']))
    {
        $startDate = $_POST["start_date"];
        $endDate = $_POST["end_date"];
        $time = $_POST["time_pick"];
        $totalPrice = 200;

        $renting = "INSERT INTO reservation (start_date, end_date, total_price, customer_id, plate_id, time) values ('$startDate', '$endDate', '$totalPrice','{$_SESSION['client_id']}', '$car_id', '$time');";
        mysqli_query($conn, $renting);
        
        $renting = "UPDATE car SET status = 'rented' WHERE plate_id = '$car_id;'";
        mysqli_query($conn, $renting);
        echo "<script>alert('Rent Successful!'); window.location='index.php'</script>";
    }
?>