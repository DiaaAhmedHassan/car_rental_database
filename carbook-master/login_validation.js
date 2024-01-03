function valid_login(){
    var email = document.getElementById('email');
    var password = document.getElementById('password');

    if (email.value==""){
        alert("please insert your email");
        return false;
    }
    else if(password.value==""){
        alert("please insert your password");
        return false;
    }
    return true;
}