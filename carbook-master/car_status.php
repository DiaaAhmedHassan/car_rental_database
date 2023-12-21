<?php 
    if(strtolower($car_status) == 'available')
    {
        echo "style=\"color: green;\"";
    }
    else if(strtolower($car_status) == 'rented')
    {
        echo "style=\"color: orange;\"";
    }
    else
    {
        echo "style=\"color: red;\"";
    }
?>