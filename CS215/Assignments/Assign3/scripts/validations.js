console.log("Event handlers and registration for Signup Page loaded");

function validateEmail(email){
    var check = true;
    var regex_email = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/;
    var msg_email = document.getElementById("msg_email");
    msg_email.innerHTML = "";
    var textNode;

    if(email.value == null || email == ""){
        textNode = document.createTextNode("Email is required.");
        msg_email.appendChild(textNode);
        check = false;
    }
    else if(regex_email.test(email) == false){
        textNode = document.createTextNode("Email address is the wrong format. Example: username@somewhere.sth");
        msg_email.appendChild(textNode);
        check = false;
    }
    else if(email.length > 60){
        textNode = document.createTextNode("Maximum email address length is 60 characters.");
        msg_email.appendChild(textNode);
        check = false;
    }

    return check;
}

function validateUserName(userName){
    var regex_userName = /^[a-zA-Z0-9_-]+$/;
    var msg_userName = document.getElementById("msg_userName");
    msg_userName.innerHTML = "";
    
    console.log("userName: " + userName.value);
    if(userName == null || userName == ""){
        textNode = document.createTextNode("Username is required.");
        msg_userName.appendChild(textNode);
        check = false;
    }
    else if(regex_userName.test(userName) == false){
        textNode = document.createTextNode("UserName cannot contain symbols or spaces. Example: 123abc");
        msg_userName.appendChild(textNode);
        check = false;
    }
    else if(userName.length > 40){
        textNode = document.createTextNode("Maximum UserName length is 40 characters.");
        msg_userName.appendChild(textNode);
        check = false;
    }

    return check;
}

function validatePassword(password){
    var regex_password = /^[a-zA-Z0-9_-]+$/;
    var msg_password = document.getElementById("msg_password");
    msg_password.innerHTML = "";

    if(password == null || password == ""){
        textNode = document.createTextNode("Password is required.");
        msg_password.appendChild(textNode);
        check = false;
    }
    else if(regex_password.test(password) == false){
        textNode = document.createTextNode("Passwords cannot contain symbols or spaces. Example: abc123");
        msg_password.appendChild(textNode);
        check = false;
    }
    else if(password.length != 8){
        textNode = document.createTextNode("Passwords must be exactly 8 characters.");
        msg_password.appendChild(textNode);
        check = false;
    }

    return check;
}

function validateConfirmPassword(confirmPassword, password){
    var msg_confirmPassword = document.getElementById("msg_confirmPassword");
    msg_confirmPassword.innerHTML = "";

    if(confirmPassword == null || confirmPassword == ""){
        textNode = document.createTextNode("Confirm Password is required");
        msg_confirmPassword.appendChild(textNode);
        check = false;
    }
    else if(confirmPassword != password){
        textNode = document.createTextNode("Passwords do not match.");
        msg_confirmPassword.appendChild(textNode);
        check = false;
    }

    return false;
}

function formValidation(event){
    event.preventDefault();

    var emailValid = true;
    var userNameValid = true;
    var passwordValid = true;
    var confirmPasswordValid = true;
    var htmlNode = document.createElement("br");

    var elements = event.currentTarget;
    //console.log("event.currentTarget: " + e)
    //var email = elements[0].value;
    //var userName = elements[1].value;
    //var password = elements[2].value;
    //var confirmPassword = elements[3].value;

    console.log("elements: " + elements);
    /*console.log("elements[1]" + elements[1]);
    console.log("elements[2]" + elements[2]);

    emailValid = validateEmail(email.value);
    userNameValid = validateUserName(userName.value);
    passwordValid = validatePassword(password.value);
    confirmPasswordValid = validateConfirmPassword(confirmPassword.value);

    var display_info = document.getElementById("display_info");
    display_info.innerHTML = "";

    if(emailValid === true || userNameValid === true || passwordValid === true || confirmPasswordValid === true){
        display_info.style.color = "green";

        textNode = document.createTextNode("Email: " + email);
        display_info.appendChild(textNode);
        display_info.appendChild(htmlNode);

        textNode = document.createTextNode("UserName: " + userName);
        display_info.appendChild(textNode);
        display_info.appendChild(htmlNode);

        textNode = document.createTextNode("Password: " + password);
        display_info.appendChild(textNode);
        display_info.appendChild(htmlNode);

        textNode = document.createTextNode("Confirm Password: " + confirmPassword);
        display_info.appendChild(textNode);
        display_info.appendChild(htmlNode);
    }
    else{
        event.preventDefault();
        textNode = document.createTextNode("Invalid Data Entered");
        display_info.appendChild(textNode);

        display_info.setAttribute("style", "color: red");
    }*/
}

function resetForm(event){
    var data = event.currentTarget;
    data[0].value = "";
    data[1].value = "";
    data[2].value = "";
    data[3].value = "";

    msg_email.innerHTML = "";
    msg_userName.innerHTML = "";
    msg_password.innerHTML = "";
    msg_confirmPassword.innerHTML = "";
    display_info.innerHTML = "";
}