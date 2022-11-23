/*
 * Lab6 signup-r.js 
 *
 * Contains:
 *  - event registrations for signup.html
 *  
 * Event handler functions are defined in validate.js
 * 
 * Read Carefully and watch for //TODO: comments
 */

//TODO: use addEventListener() to add a function as the listener for form submit events. 
//      Use the submit event handler function we started for you in validate.js
document.getElementById("SignUp").addEventListener("submit", SignUpForm, false);

//TODO: use addEventListener() to add a function as the listener for form reset events. 
//      Use the reset event handler function we started for you in validate.js
document.getElementById("SignUp").addEventListener("reset", ResetForm, false);

