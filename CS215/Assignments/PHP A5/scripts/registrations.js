//  Form Registrations
if(document.getElementById("LoginForm")){
    document.getElementById("LoginForm").addEventListener("submit", loginFormValidation);
}
else if(document.getElementById("SignUpForm")){
    document.getElementById("SignUpForm").addEventListener("submit", signupFormValidation);
}else if(document.getElementById("createPoll")){
    document.getElementById("createPoll").addEventListener("submit", characterFormValidation)
    document.getElementById("createPoll").addEventListener("reset", ResetForm);
    
    // Register 'input' events
    document.getElementById("createQuestion").addEventListener("input", characterValidationInput);
    document.getElementById("createA1").addEventListener("input", characterValidationInput);
    document.getElementById("createA2").addEventListener("input", characterValidationInput);
    document.getElementById("createA3").addEventListener("input", characterValidationInput);
    document.getElementById("createA4").addEventListener("input", characterValidationInput);
    document.getElementById("createA5").addEventListener("input", characterValidationInput);
    //  End of 'input' events
}

//  End of Form Registrations
