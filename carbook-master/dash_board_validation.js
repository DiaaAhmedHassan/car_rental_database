function valid_dash_board(){
    var plate_id = document.getElementById('plate_id');
    var model = document.getElementById('model');
    var manufacturer = document.getElementById('manufacturer');
    var color = document.getElementById('color');
    var price = document.getElementById('price');
    var mileage = document.getElementById('mileage');
    var office_id = document.getElementById('office_id');
    var file = document.getElementById('file');

    if (plate_id.value=="" || !isInteger(plate_id.value)){
        alert("please insert the palte id");
        return false;
    }
    else if(model.value==""){
        alert("please insert the car model");
        return false;
    }
    else if(manufacturer.value==""){
        alert("please insert the manufacturer");
        return false;
    }
    else if(color.value==""){
        alert("please insert the color");
        return false;
    }
    else if(price.value=="" || !isInteger(price.value)){
        alert("please insert the price");
        return false;
    }
    else if(mileage.value=="" || !isInteger(mileage.value)){
        alert("please insert the mileage");
        return false;
    }
    else if(office_id.value==""){
        alert("please insert the office id");
        return false;     
    }
    else if(file.value==""){
        alert("please upload a file");
        return false;     
    }
    return true;
}