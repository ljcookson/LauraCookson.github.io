//  Register 'blur' events
//document.getElementById("uname").addEventListener("blur", validateUserName);

//document.getElementById("uname").addEventListener("blur", formValidation);

//document.getElementById("pword").addEventListener("blur",validatePassword);

//document.getElementById("cpword").addEventListener("blur",validateConfirmPassword);

//document.getElementById("email").addEventListener("blur", validateEmail);
//  End of 'blur' event registrations

//  Form Registrations
if(document.getElementById("LoginForm")){
    document.getElementById("LoginForm").addEventListener("submit", loginFormValidation);
}
else if(document.getElementById("SignUpForm")){
    document.getElementById("SignUpForm").addEventListener("submit", signupFormValidation);
}else if(document.getElementById("createPoll")){
    document.getElementById("createPoll").addEventListener("submit", characterFormValidation)
}

document.getElementById("createPoll").addEventListener("reset", ResetForm);
//  End of Form Registrations

// Register 'input' events
document.getElementById("createQuestion").addEventListener("input", characterValidationInput);
document.getElementById("createAnswer1").addEventListener("input", characterValidationInput);
document.getElementById("createAnswer2").addEventListener("input", characterValidationInput);
document.getElementById("createAnswer3").addEventListener("input", characterValidationInput);
document.getElementById("createAnswer4").addEventListener("input", characterValidationInput);
document.getElementById("createAnswer5").addEventListener("input", characterValidationInput);
//  End of 'input' events