/*
 * Lab6 validate.js 
 *
 * Contains:
 *  - SignUpForm: submit event handler / form validator 
 *  - ResetForm: reset event handler / form resetter
 * 
 * Read Carefully and watch for //TODO: comments
 */


// Lab 6 SignUpForm Validator Event Handler
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
    /* Prevent default event action.
        Normally only called if a form does not validate.  We put it here so you can see the feedback in the display_info div when the page validates.
        For a submitted form the default action is to send form data to the URI in the form's action="" attribute.  If a form has no action, the page will reload, clearing the form and removing any DOM modified elements.*/
    //event.preventDefault();

    // Assume the form is valid; set to false if any validation tests fail.
    var valid=true;
  
    // TODO: Get field values for all form fields
    var elements = event.currentTarget;
    var email = elements[0].value;      //Email
    var user = elements[1].value;       //Username
    var pword = elements[2].value;      //Password
    var cpword = elements[3].value;     //Confirm Password
    //  javascript regular expressions (jre) to validate email, username and password.
    //  TODO: you may wish to change these to better match exercise requirements
    var regex_email = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/;
    var regex_user = /^[a-zA-Z0-9_-]+$/;
    var regex_pword = /^[a-zA-Z0-9_-]+$/;

    //  Empty error message calls have been added to the table above the email, username, password and confirm password fields styled with red text color
    //  TODO: Get references to all error message calls and make sure they are empty before validating
    var msg_email = document.getElementById("msg_email");
    var msg_user = document.getElementById("msg_user");
    var msg_pword = document.getElementById("msg_pword");
    var msg_cpword = document.getElementById("msg_cpword");
    msg_email.innerHTML = "";
    msg_user.innerHTML = "";
    msg_pword.innerHTML = "";
    msg_cpword.innerHTML = "";

    //  Variables for DOM manipulation commands
    var textNode;
    var htmlNode;

    //-- validate email --
    if (email == null || email == ""){
       textNode = document.createTextNode("Email address is empty.");
       msg_email.appendChild(textNode);
       valid = false;
    }
    else if(regex_email.test(email) == false){
        textNode = document.createTextNode("Email address wrong format. Example: username@somewhere.sth");
        msg_email.appendChild(textNode);
        valid = false;
    }
    else if(email.length > 60){
        textNode = document.createTextNode("Email address too long.  Maximum is 60 characters.");
        msg_email.appendChild(textNode);
        valid = false;
    }

    //TO DO: add code to complete validation of username - don't forget regex or length requirements from lab 5
    if (user == null || user == ""){
        textNode = document.createTextNode("Username is empty");
        msg_user.appendChild(textNode);
        valid = false;
    }
    else if (regex_user.test(user) == false){
        textNode = document.createTextNode("Username is invalid. Cannot contain strange symbols or have spaces. Example: abc123");
        msg_user.appendChild(textNode);
        valid = false;
    }
    else if (user.length > 40){
        textNode = document.createTextNode("Username is too long.  Maximum is 40 characters.");
        msg_user.appendChild(textNode);
        valid = false;
    }

    //TO DO: add code to validate password - don't forget regex and length requirements
    if (pword == null || pword ==""){
        textNode = document.createTextNode("Password is empty.");
        msg_pword.appendChild(textNode);
        valid = false;
    }
    else if (regex_pword.test(pword) == false){
        textNode = document.createTextNode("Password is invalid. Cannot contain strange symbols or have spaces. Example: abc123");
        msg_pword.appendChild(textNode);
        valid = false;
    }
    else if (pword.length != 8){
        textNode = document.createTextNode("Password has to be exactly 8 characters.");
        msg_pword.appendChild(textNode);
        valid = false;
    }

    //TO DO: add code to confirm password - must match password
    if (cpword == null || cpword == ""){
        textNode = document.createTextNode("Confirm Password is empty.");
        msg_cpword.appendChild(textNode);
        valid = false;
    }
    else if (cpword != pword){
        textNode = document.createTextNode("Passwords do not match");
        msg_cpword.appendChild(textNode);
        valid = false;
    }
 
    //  TODO: complete the next section based on the comments below
    //  Provide feedback in "display_info" div at the bottom of the page
    var display_info = document.getElementById("display_info");
    display_info.innerHTML = "";
 
    if(valid === true){    
       // Set greed text color indicating everything is OK
       display_info.style.color = "green";  // Style method 1: manipulate style directly

       // Add validated contents of form to the display_info div
       textNode = document.createTextNode("Email: " + email);
       display_info.appendChild(textNode);
       htmlNode = document.createElement("br");
       display_info.appendChild(htmlNode);

       textNode = document.createTextNode("Username: " + user);
       display_info.appendChild(textNode);
       htmlNode = document.createElement("br");
       display_info.appendChild(htmlNode);

       textNode = document.createTextNode("Password: " + pword);
       display_info.appendChild(textNode);
       htmlNode = document.createElement("br");
       display_info.appendChild(htmlNode);

       textNode = document.createTextNode("Confirm Password: " + cpword);
       display_info.appendChild(textNode);
       htmlNode = document.createElement("br");
       display_info.appendChild(htmlNode);

       // send a form reset event to clear the form
       //ResetForm(event);
    }
    else{
       event.preventDefault();  // Normally, this is where this command should be

       // If the form is not valid, display an "Invalid Data Entered" message and set red text color
       textNode = document.createTextNode("Invalid Data Entered");
       display_info.appendChild(textNode);

       display_info.setAttribute("style", "color: red");    // Style Method 2: manipulate HTML attribute
    }
 } 
 
 // Lab 6 ResetForm Reset Event Handler
 //
 // This event handler function should reset the SignUp form to its default state
 // 
 
 function ResetForm(event){
   //TODO: add code to reset the value of SignUp form's text inputs to ""
   var elements = event.currentTarget;
   elements[0].value = "";
   elements[1].value = "";
   elements[2].value = "";
   elements[3].value = "";

    // TODO: add code to empty the contents of the SignUp form's error message calls
    msg_email.innerHTML = "";
    msg_user.innerHTML = "";
    msg_pword.innerHTML = "";
    msg_cpword.innerHTML = "";
    display_info.innerHTML = "";
 }
 