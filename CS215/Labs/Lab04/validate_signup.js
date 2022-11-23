function SignUpForm(){
    var email = document.forms.SignUp.email.value;
    var uname = document.forms.SignUp.uname.value;
    var pass = document.forms.SignUp.pword.value;
    var cpass = document.forms.SignUp.firmpword.value;
    var warn = "";
    var userInput = "";
    var valid = true;

    if(emptyCheck(email, uname, pass, cpass) == false){
        boxAlert();
    }
    else{
        if(email.length > 60){
            warn += "Maximum Email length is 60 characters.\n";
            valid = false;
        }
        else{
            userInput += "Email: " + email + "\n";
        }

        if(uname.length > 40)
        {
            warn += "Maximum Username length is 40 characters. \n";
            valid = false;
        }
        else{
            userInput += "UserName: " + uname + "\n";
        }

        if(pass.length != 8){
            warn += "Password has to be exactly 8 characters. \n";
            valid = false;
        }
        else{
            userInput += "Password: " + pass + "\n";
        }

        if(cpass != pass){
            warn += "Passwords do not match. \n";
        }
        else{
            userInput += "Confirmed Password: " + cpass + "\n";
        }

        if(valid==true){
            alert("User Input: \n" + userInput);
        }
        else{
            alert("Warning: \n" + warn);
        }
    }
}

function boxAlert()
{
    alert("The following fields must be filled out: \nEmail \nUserName \nPassword \nPassword has to be 8 characters long! \nConfirm Password ");
}

function emptyCheck(email, uname, pass, cpass){
    var check = true;
    if(email == null || email == ""){
        check = false;
    }
    if(uname == null || uname == ""){
        check = false;
    }
    if(pass == null || pass == ""){
        check = false;
    }
    if(cpass == null || cpass == ""){
        check = false;
    }
    
    console.log("Check = ", check);
    return check;
}