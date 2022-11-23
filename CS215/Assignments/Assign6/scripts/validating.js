function emailValidation(email){
    var valid=true;
    var regex_email = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/;
    
    var msg_email = document.getElementById("msg_email");
    msg_email.innerHTML = "";
    
    //-- validate email --
    if (email == null || email == ""){
       textNode = document.createTextNode("Email address is required.");
       msg_email.appendChild(textNode);
       valid = false;
    }
    else if(regex_email.test(email) == false){
        textNode = document.createTextNode("Example Email format: username@somewhere.sth");
        msg_email.appendChild(textNode);
        valid = false;
    }
    else if(email.length > 60){
        textNode = document.createTextNode("Maximum Email length is 60 characters.");
        msg_email.appendChild(textNode);
        valid = false;
    }
    return valid;
 } 

function userValidation(user){
var valid=true;
        
var regex_user = /^[a-zA-Z0-9_-]+$/;

var msg_user = document.getElementById("msg_userName");
msg_user.innerHTML = "";

// --validate userName--
if (user == null || user == ""){
    textNode = document.createTextNode("Username is required");
    msg_user.appendChild(textNode);
    valid = false;
}
else if (regex_user.test(user) == false){
    textNode = document.createTextNode("Username cannot contain strange symbols or have spaces. Example: abc123");
    msg_user.appendChild(textNode);
    valid = false;
}
else if (user.length > 40){
    textNode = document.createTextNode("Maximum UserName length is 40 characters.");
    msg_user.appendChild(textNode);
    valid = false;
}
return valid;
} 

function passwordValidation(pword){
var valid=true;
var regex_pword = /^[a-zA-Z0-9_-]+$/;

var msg_pword = document.getElementById("msg_password");
msg_pword.innerHTML = "";

// --validate password--
if (pword == null || pword ==""){
    textNode = document.createTextNode("Password is required.");
    msg_pword.appendChild(textNode);
    valid = false;
}
else if (regex_pword.test(pword) == false){
    textNode = document.createTextNode("Password cannot contain strange symbols or have spaces. Example: abc123");
    msg_pword.appendChild(textNode);
    valid = false;
}
else if (pword.length != 8){
    textNode = document.createTextNode("Password has to be exactly 8 characters.");
    msg_pword.appendChild(textNode);
    valid = false;
}
return valid;
} 

function confirmPasswordValidation(cpword, pword){
var valid=true;

var msg_cpword = document.getElementById("msg_confirmPassword");
msg_cpword.innerHTML = "";

// --validate confirm password--
if (cpword == null || cpword == ""){
    textNode = document.createTextNode("Confirm Password is required.");
    msg_cpword.appendChild(textNode);
    valid = false;
}
else if (cpword != pword){
    textNode = document.createTextNode("Passwords do not match");
    msg_cpword.appendChild(textNode);
    valid = false;
}
return valid;
} 

function avatarValidation(avatar){
var valid=true;

var msg_avatar = document.getElementById("msg_avatar");
msg_avatar.innerHTML = "";

// --check radio button--
if(avatar == null){
    textNode = document.createTextNode("Avatar selection is required")
    msg_avatar.appendChild(textNode);
    valid = false;
}
return valid;
} 

function loginFormValidation(event){
//event.preventDefault();

var elements = event.currentTarget;
var email = elements[0].value;       //Email
var pword = elements[1].value;      //Password

var textNode;
var htmlNode;

var emailValid = emailValidation(email);
var passValid = passwordValidation(pword);

// --create display_info--
var display_info = document.getElementById("display_info");
display_info.innerHTML = "";

if(emailValid === true && passValid === true){
    /*display_info.style.color = "green";

    textNode = document.createTextNode("Email: " + email);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    textNode = document.createTextNode("Password: " + pword);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    // send a form reset event to clear the form
    //ResetForm(event);*/
}
else{
    event.preventDefault();
    
    textNode = document.createTextNode("Invalid Data Entered");
    display_info.appendChild(textNode);

    display_info.setAttribute("style", "color: red");
}
}

function signupFormValidation(event){
//event.preventDefault();

var elements = event.currentTarget;
var fname = elements[0].value;      //First Name
var lname = elements[1].value;      //Last Name
var user = elements[2].value;       //Username
var pword = elements[3].value;      //Password
var cpword = elements[4].value;     //Confirm Password
var email = elements[5].value;      //Email
var avatar = document.querySelector('input[name="avatar"]:checked');
    
var regex_email = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/;
var regex_user = /^[a-zA-Z0-9_-]+$/;
var regex_pword = /^[a-zA-Z0-9_-]+$/;

var textNode;
var htmlNode;

var emailValid = emailValidation(email);
var userValid = userValidation(user);
var passValid = passwordValidation(pword);
var cpassValid = confirmPasswordValidation(cpword, pword);
var avatarValid = avatarValidation(avatar);

// --create display_info--
var display_info = document.getElementById("display_info");
display_info.innerHTML = "";

if(emailValid === true && userValid === true && passValid === true && cpassValid ===true && avatarValid === true){    
    /*display_info.style.color = "green";

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
else{*/
    event.preventDefault();
    
    textNode = document.createTextNode("Invalid Data Entered");
    display_info.appendChild(textNode);

    display_info.setAttribute("style", "color: red");
}
} 

function ResetForm(event){
var data = event.currentTarget;
data[0].value = "";
data[1].value = "";
data[2].value = "";
data[3].value = "";
data[4].value = "";
data[5].value = "";
data[6].value = "";
data[7].value = "";

var msg_char = document.getElementById("msg_char" + "");
if(msg_char.childNodes[3]){
    msg_char.childNodes[3].textContent = "0";
    msg_charA1.childNodes[3].textContent = "0";
    msg_charA2.childNodes[3].textContent = "0";
    msg_charA3.childNodes[3].textContent = "0";
    msg_charA4.childNodes[3].textContent = "0";
    msg_charA5.childNodes[3].textContent = "0";
}
if((msg_char.textContent.includes('Required')) || msg_char.textContent.includes('Maximum')){
    resetMSG(msg_char, 100, "");
    resetMSG(msg_charA1, 50, "A1");
    resetMSG(msg_charA2, 50, "A2");
}
    display_info.textContent = "";
    msg_openDate.innerHTML = "";
    msg_closeDate.innerHTML = "";
}

function resetMSG(msg_char, max, num){
msg_char.textContent = "";
htmlNode = document.createElement("span");
msg_char.appendChild(htmlNode);
msg_char.childNodes[0].classList.add("wordCount");
msg_char.childNodes[0].id = "maximum" + num;
msg_char.childNodes[0].textContent = "/" + max;
htmlNode = document.createElement("span");
msg_char.appendChild(htmlNode);
msg_char.childNodes[1].classList.add("wordCount");
msg_char.childNodes[1].id = "create" + num + "Current";
msg_char.childNodes[1].textContent = "0";
}

function characterValidation(event, num, max){
var msg_character = document.getElementById("msg_char" + num);
msg_character.innerHTML = "";

var valid = true;
var currentCount = event.value.length;

if (currentCount == null || currentCount == "" || currentCount == 0){
    textNode = document.createTextNode("Required (under " + max + " characters)");
    msg_character.appendChild(textNode);
    valid = false;
}
else if(currentCount > max){
    textNode =  document.createTextNode("Maximum of " + max + " characters permitted.")
    msg_character.appendChild(textNode);
    valid = false;
}
else if(currentCount == max){
    textNode = document.createTextNode("Maximum of " + max + " characters reached.");
    msg_character.appendChild(textNode);
}
return valid;
}
function characterValidationInput(event){
var currentCount = event.target.value.length;
var current = document.getElementById(event.target.id + "Current");
current.innerHTML = currentCount;
}
function characterFormValidation(event){
//event.preventDefault();
var elements = event.currentTarget;
var open = elements[0];
var close = elements[1];
var question = elements[2];
var answer1 = elements[3];
var answer2 = elements[4];
var answer3 = elements[5];
var answer4 = elements[6];
var answer5 = elements[7];

var openCloseValid = dateTimeValidation(open, close);
var quesValid = characterValidation(question, "", 100);
var a1Valid = characterValidation(answer1, "A1", 50);
var a2Valid = characterValidation(answer2, "A2", 50);

// --create display_info--
var display_info = document.getElementById("display_info");
display_info.innerHTML = "";

if(openCloseValid === true && quesValid === true && a1Valid ===true && a2Valid === true){    
    display_info.style.color = "green";

    textNode = document.createTextNode("Open Date: " + open.value);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    textNode = document.createTextNode("Close Date: " + close.value);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    textNode = document.createTextNode("Question: " + question.value);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    textNode = document.createTextNode("Answer 1: " + answer1.value);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    textNode = document.createTextNode("Answer 2: " + answer2.value);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    // send a form reset event to clear the form
    //ResetForm(event);
}
else{
    event.preventDefault();
    
    textNode = document.createTextNode("Please fix all errors");
    display_info.appendChild(textNode);

    display_info.setAttribute("style", "color: red");
}
}
function dateTimeValidation(open, close){
var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
var openDate = document.getElementById("dateTimeOpen").value;
var closeDate = document.getElementById("dateTimeClose").value;
var msg_openDate = document.getElementById("msg_openDate");
msg_openDate.innerHTML = "";
var msg_closeDate = document.getElementById("msg_closeDate");
msg_closeDate.innerHTML = "";
var valid = true;

// --Open check--
if(openDate == null || openDate == ""){
    textNode = document.createTextNode("Open date is required.");
    msg_openDate.appendChild(textNode);
    valid = false;
}
else if(dateRegex.test(openDate)  == false){
    textNode = document.createTextNode("Incorrect format. Example: 2022-07-15");
    msg_openDate.appendChild(textNode);
    valid = false;
}

// --Close check--
if(closeDate == null || closeDate == ""){
    textNode = document.createTextNode("Close date is required.");
    msg_closeDate.appendChild(textNode);
    valid = false;
}
else if(dateRegex.test(closeDate)  == false){
    textNode = document.createTextNode("Incorrect format. Example: 2022-07-15");
    msg_closeDate.appendChild(textNode);
    valid = false;
}
else if((closeDate - openDate) < 7){
    textNode = document.createTextNode("Poll must be open for at least 7 days");
    msg_closeDate.appendChild(textNode);
    valid  = false;
}

return valid;
}
 
function mainAjax(){    
    // create XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();
    var parent = document.getElementsByClassName("mainActivePollsBody")[0];
    var pollID = parent.firstElementChild.value;
    // access onreadystatechange event
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            console.log(xmlhttp.responseText);
            if(xmlhttp.responseText != "No polls have been created."){
                // create a response object
                var response = JSON.parse(xmlhttp.responseText);
                console.log(xmlhttp.responseText);
                var resArray = response["polls"];
                var responseLength = resArray.length;

                for(var i = responseLength, j = i - 1; i > 0; i--, j--){
                    var lastKid = parent.lastElementChild;
                    var llKid = lastKid.previousElementSibling;
                    var ques = resArray[j]["question"];
                    var pid = resArray[j]["poll_ID"];
                    var insertChild = NewPollInput(ques, pid);
                    parent.removeChild(lastKid);
                    parent.removeChild(llKid);
                } // end loop of DOM Manipulation
            }
        }//end readystate if statement
    }//End no name function
    // Prepare a GET/open event
    xmlhttp.open("GET", "../php_tasks/main.php?pID=" + encodeURIComponent(pollID));
    // Execute the request
    xmlhttp.send();
}

function NewPollInput(ques, pid){
    const newInput = document.createElement("input");
    newInput.setAttribute("type", "radio");
    newInput.setAttribute("name", "polls");
    newInput.setAttribute("class", "mainActivePollsBodyRadio");
    newInput.setAttribute("value", pid);

    const newLabel = document.createElement("label");
    newLabel.setAttribute("for", pid);
    newLabel.innerHTML = "\n" + ques;

    var parent = document.getElementsByClassName("mainActivePollsBody")[0]
    var originalList = parent.children;

    var newList = parent.prepend(newInput, newLabel);
}

function voteAjax(event){
    var pollID = event.target.previousElementSibling.previousElementSibling.value;
    var answerID = document.querySelector("input[name=votePolls]:checked").value;
    var castVoteButton = document.getElementsByName("VotePageButton")[0];
    //console.log(castVoteButton);
    var votexmlhttp = new XMLHttpRequest();

    votexmlhttp.onreadystatechange = function(){
        /* console.log("Readystate: " + votexmlhttp.readyState);
        console.log("Status: " + votexmlhttp.status); */
        if(votexmlhttp.readyState == 4 && votexmlhttp.status == 200){
            //console.log(votexmlhttp.responseText);
            var response = JSON.parse(votexmlhttp.responseText);
            //console.log(response);
            castVoteButton.classList.add("hideText");
            var p = document.createElement("p");
            p.setAttribute("class", "italic");
            p.innerHTML = "Thank you for your vote!";
            castVoteButton.parentElement.appendChild(p);
        }
    }
    votexmlhttp.open("GET", "../php_tasks/castVote.php?pID=" + encodeURIComponent(pollID) + "&ansID=" + encodeURIComponent(answerID));

    // Execute the request
    votexmlhttp.send();
}

function mgmtAjax(event){

}

function goToVotePage(){
    window.location.href("http://http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign6/pages/vote.php");
}

function goToResultPage(){
    window.location.href("http://http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign6/pages/results.php");
}