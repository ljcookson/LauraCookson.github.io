console.log("Event handlers and registration loaded");

//  Email Validation
function validateEmail(event){
    console.log("Verify as a proper email: " + event.target.value);
    //let error = document.getElementById(event.target.id + "Error");
   // let help = document.getElementById(event.target.id + "Help");

    if(checkEmail(event.target.value)){
        console.log("Email is valid");
        //error.style.display = "none";
        //help.style.display = "inline";
    }else{
        console.log("Email is not valid");
        //error.style.display = "inline";
        //help.style.display = "none";
    }
}
function checkEmail(email){
    let emailRegEx = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/;
    if(emailRegEx.test(email)){
        return true;
    }else{
        return false;
    }
}
//  End of Email Validation

//  Event handler for the password field
function validatePassword(event){
    console.log("Verify as a proper password: " + event.target.value);
    //let help = document.getElementById(event.target.id + "Help");
    //let errorLength = document.getElementById(event.target.id + "ErrorLength");
    //let errorFormat = document.getElementById(event.target.id + "ErrorFormat");

    let errorFree = true;

    if(checkPassLength(event.target.value)){
        console.log("Password length is okay");
        //errorLength.classList.add("hideMe");
    }else{
        console.log ("Password is too short");
        //errorLength.classList.remove("hideMe");
        errorFree = false;
    }

    if(checkPassFormat(event.target.value)){
        console.log("Password format is okay");
        //errorFormat.classList.add("hideMe");
    }else{
        console.log("Password does not match criteria");
        //errorFormat.classList.remove("hideMe");
        errorFree = false;
    }
    console.log("errorFree is: " + errorFree);
    if(errorFree){
        console.log("errorFree = true");
        //help.classList.remove("hideMe");
    }else{
        console.log("errorFree = false");
        //help.classList.add("hideMe");
    }
}
function checkPassLength(passValue){
    if(passValue.length != 8){
        return false;
    }else{
        return true;
    }
}
function checkPassFormat(passValue){
    let nwcRegEx = /[^\w]/; //non-word-character
    let spaceRegEx = /(\s)/g;
    let positionInPassValue = passValue.search(nwcRegEx);
    let spacePositionInPassValue = passValue.search(spaceRegEx);
    if(positionInPassValue < 0 && spacePositionInPassValue <0){
        return false;
    }else{
        return true;
    }
}
//  End of Password Validation

//  Confirm Password Validation
function validateConfirmPassword(event){
    console.log("Verify as a proper password: " + event.target.value);
    //let error = document.getElementById(event.target.id + "Error");

    if(checkPasswordConfirmation(event.target.value)){
        console.log("Passwords Match");
        //error.style.display = "none";
    }else{
        console.log("Passwords do not match");
        //error.style.display = "inline";
    }
}
function checkPasswordConfirmation(confirmPassValue){
    console.log("confirmPassValue: " + confirmPassValue)
    var pswd = document.getElementById("pword").value;
    console.log("pswd = " + pswd);
    console.log("confirmPassValue == pword" + (confirmPassValue == pword));
    if(confirmPassValue == pword){
        console.log("Match");
        return true;
    }else{
        console.log("Do not match");
        return false;
    }
}
//  End of Confirm Password Validation

//  UserName Validation
function validateUserName(event){
    console.log("Verify as a proper UserName: " + event.target.value);
    //let help = document.getElementById(event.target.id + "Help");
    //let errorSpace = document.getElementById(event.target.id + "ErrorSpace");
    //let errorSymbol = document.getElementById(event.target.id + "ErrorSymbol");

    let noErrors = true;

    if(checkUsernameSpace(event.target.value)){
        console.log("No spaces found");
        //errorSpace.style.display = "none";
    }else{
        console.log("Spaces found");
        //errorSpace.style.display = "inline";
        noErrors = false;
    }

    if(checkUsernameSymbol(event.target.value)){
        console.log("No symbols found");
        //errorSymbol.style.display = "none";
    }else{
        console.log("Symbols found");
        //errorSymbol.style.display = "inline";
        noErrors = false;
    }

    if (noErrors){
        help.classList.remove("hideText");
    }else{
        help.classList.add("hideText");
    }
}
function checkUsernameSpace(userName){
    let userNameSpaceRegEx = /[\s]/;
    let positionInUserNameValue = userName.search(userNameSpaceRegEx);
    if(positionInUserNameValue < 0){
        return true;
    }else{
        return false;
    }
}
function checkUsernameSymbol(userName){
    let userNameSymbolRegEx = /[^\w^\s]/;
    let positionInUserNameValue = userName.search(userNameSymbolRegEx);
    if(positionInUserNameValue < 0){
        return true;
    }else{
        return false;
    }
}
//  End of UserName Validation  

//  Event handler for the form
function validateForm(event){
    //  get the username and password
    var userName = document.getElementById("uname");
    let password = document.getElementById("pword");
    var conpass = document.getElementById("cpword");

    //  validate all the form fields
    if(checkUsername(userName.value) && checkPassLength(password.value) && checkPassFormat(password.value) && checkPasswordConfirmation(conpass.value)){
        console.log("No Errors");
    }else{
        console.log("At least one of the form elements is not valid");
        event.preventDefault();
    }
}