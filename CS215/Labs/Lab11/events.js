var searchButton = document.getElementById("search_button");
searchButton.addEventListener("click", send_ajax_request, false);

var searchReceive = document.getElementById("search_button");
searchReceive.addEventListener("input", receive_ajax_response);

var typeLetter = document.getElementById("search_text");
typeLetter.addEventListener("input", send_ajax_request, false);

var typeReceive = document.getElementById("search_text");
typeReceive.addEventListener("input", receive_ajax_response);