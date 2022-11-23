/*
 * Lab5 validate.js 
 *
 * Contains:
 *  - SignUpForm: submit event handler / form validator 
 *  - ResetForm: reset event handler / form resetter
 * 
 * Read Carefully and watch for //TODO: comments
 */


// Lab 5 SignUpForm Validator Event Handler
//
// This sample event handler function should validate all 4 input fields,  
//    ie. (Email, Username, Password, Confirm Password)
// at once as elements of event.currentTarget, which is provided by the 
// submit event. 
//
// Follow the TODO: instructions to complete the following:
//  - add a parameter to the function to receive the event object
//  - get the form's submitted field values from the event object
//  - complete validation of username, password and confirm password
//  - display feedback in an alert dialog
//  
//
// OR: you can write separate functions to validate each input field when
// they are changed. See the "DOM2 Event Registration" example in Lab 5:
// https://www.cs.uregina.ca/Links/class-info/215/js_dom/index.html#dom2 
// In such a solution, each input field would get its own change function. For
// example, checkEmail(), checkUsername(), checkPswd(), checkMatchPswd() 
// You will still need a submit() event to check that flags for all fields are OK,
// to provide feedback in display_info div and to use event.preventDefault() to
// avoid reloading the page.
// 


//TO DO: add a parameter to this function to receive the event object
function SignUpForm(event){

    var valid=true;
    var warnings="";
    var user_inputs = "";
 
    // TODO: remove this line
    //var email = document.forms.SignUp.email.value;
 
    // TODO: Get field values for all form fields from the event object
    var elements = event.currentTarget;
    var email = elements[0].value;      //Email
    var user = elements[1].value;       //Username
    var pword = elements[2].value;      //Password
    var cpword = elements[3].value;     //Confirm Password

    if(emptyCheck(email, user, pword, cpword) == false){
        boxAlert();
    }
    else{
        if(email.length > 60){
            warnings += "\tMax length for email is 60 characters.\n";
            valid = false;
        }
        else{
            user_inputs += "\t\tEmail: " + email + "\n";
        }

        if (user.length > 40){
            warnings += "\tMaximum Username length is 40 characters.\n";
            valid = false;
        }
        else{
            user_inputs += "\t\tUsername: " + user + "\n";
        }

        if (pword.length != 8){
            warnings += "\tPassword has to be exactly 8 characters. \n";
            valid = false;
        }
        else{
            user_inputs += "\t\tPassword: " + pword + "\n";
        }

        if (cpword != pword){
            warnings += "\tPasswords do not match.\n";
            valid = false;
        }
        else{
            user_inputs += "\t\tConfirmed Password: " + cpword + "\n";
        }

        if(valid==true){
            alert("Signup successful!\n\tUser Input: \n" + user_inputs);
        }
        else{
            alert("Warning: \n" + warnings);
        }
    }
 

    /*This is the code that was given to us.  My added code will work and validate properly.  I opted to change the way the validations were done and closely matches my Lab 4 validation (LC)
    //-- validate email --
    if (email == null || email == ""){
       warnings +="Email is empty.\n";
       valid=false;
    }
    else if(email.length > 60){
       warnings += "Max length for email is 60 characters.\n";
       valid = false;
    }
    //if everything is okay, the form should be submitted.
 
 
 
    //NOTE: for the following validations, always check to see
    //      if the field exists or is empty first
 
 
    //-- validate Username --
    //TO DO: check if username is too long
    if (user == null || user == ""){
        warnings += "UserName is empty.\n";
        valid = false;
    }
    else if (user.length > 40){
        warnings += "Maximum Username length is 40 characters.\n";
        valid = false;
    }
 
 
 
    //-- validate password --
    //TO DO: check if password is exactly 8 characters long
    if (pword == null || pword ==""){
        warnings += "Password is empty. \n";
        valid = false;
    }
    else if (pword.length != 8){
        warnings += "Password has to be exactly 8 characters. \n";
        valid = false;
    }
 
 
 
    //-- Confirm password --
    //TO DO: check if password and confirmation match
    if (cpword == null || cpword == ""){
        warnings += "Confirm password is empty.\n";
        valid = false;
    }
    else if (cpword != pword){
        warnings += "Passwords do not match.\n";
        valid = false;
    }
 
 
 
    if(valid == false )
    {    
       alert(warnings);
       //prevent form to be submitted if one of above fields is invalid
       event.preventDefault();
    }
    else{
       alert("Signup successful!");
       //event.preventDefault(); // should not appear here, but you may add it while
                               //testing to keep the form from resetting.
    }*/
 }

 function boxAlert()
 {
     alert("The following fields must be filled out: \n\tEmail \n\tUserName \n\tPassword \n\tPassword has to be 8 characters long! \n\tConfirm Password ");
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
     return check;
 }
 
 
 // Lab 5 ResetForm Reset Event Handler
 //
 // This event handler function should reset the SignUp form to its default state
 // 
 
 function ResetForm(event){
   //TODO: add code to reset the value of SignUp form's text inputs to ""
    email = "";      //Email
    user = "";       //Username
    pword = "";      //Password
    cpword = "";     //Confirm Password
 }
 