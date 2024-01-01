function valid_register(){
    var name = document.getElementById('name');
    var email = document.getElementById('email');
    var phone = document.getElementById('phone');
    var password = document.getElementById('password');
    var confirm_password = document.getElementById('confirm_password');

    if (name.value==""){
        alert("please insert your name");
        return false;
    }
    else if(email.value==""){
        alert("please insert your email");
        return false;
    }
    else if(phone.value==""){
        alert("please insert your phone");
        return false;
    }
    else if(password.value==""){
        alert("please insert a password");
        return false;
    }
    else if(confirm_password.value==""){
        alert("please insert a confirmation password");
        return false;
    }
    return true;
    //window.location.href="login.php";
}