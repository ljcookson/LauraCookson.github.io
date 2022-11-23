function SignUpForm(event){ 
    var elements = event.currentTarget; 
    var email = elements[0].value; 
    var uname = elements[1].value; 
    var photo = elements[2].value;
 
    var result = true;    
 
    var email_v = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/;// /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
    var uname_v = /^[a-zA-Z0-9_-]+$/;
 
    document.getElementById("email_msg").innerHTML ="";
    document.getElementById("uname_msg").innerHTML ="";
    document.getElementById("photo_msg").innerHTML ="";  
 
 
    if (email==null || email==""||!email_v.test(email))
    {   
       document.getElementById("email_msg").innerHTML="Invalid email address (should be name@somewhere.sth)";
       result = false;
    }
 
    if (uname==null || uname==""||!uname_v.test(uname))
    {
       document.getElementById("uname_msg").innerHTML="Username should not have any leading or trailing spaces";
       result = false;
    }
 
    if (photo==null || photo=="")
    {
       document.getElementById("photo_msg").innerHTML="Please upload a photo";
       result = false;
    }
 
    if(result == false)
    {    
       event.preventDefault();
    }
 }

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