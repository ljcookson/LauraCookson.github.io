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
}else if(document.getElementById("homePage")){
    var mainVote = document.getElementsByName("mainVoteButton");

    for(var i = 0; i < pollVote.length; i++){
        mainVote[i].addEventListener("click", goToVotePage);
    }

    var mainResult = document.getElementById("extra_ResultButton").addEventListener("click", goToResultPage);

    setInterval(mainAjax, 90000);
}else if(document.getElementById("myPolls")){
    
    var mgmt = document.getElementById("mgmtextra_vote").addEventListener("click", goToVotePage);
    
    var mgmtResult = document.getElementById("extra_ResultmgmtButton").addEventListener("click", goToResultPage);
}

//  End of Form Registrations

//  Ajax requests

if(document.getElementsByClassName("voteContainer")){
    var pollVote = document.getElementsByName("VotePageButton");

    for(var i = 0; i < pollVote.length; i++){
        pollVote[i].addEventListener("click", voteAjax);
    }
}