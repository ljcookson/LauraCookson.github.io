function send_ajax_request() {
    // create a variable we need to send to our PHP file
    var letter = document.getElementById("search_text").value;
    //create XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();

    // access the onreadystatechange event for the XMLHttpRequest object
    xmlhttp.addEventListener("readystatechange", receive_ajax_response, false);

    
    //Do this line to prepare a GET
    xmlhttp.open("GET", "show_records.php?q=" + letter, true);
    
    //Do these three lines to prepare a POST
    //xmlhttp.open("POST", "show_records.php", true);
    //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //xmlhttp.send("q="+ letter);
        
    //Do this to actually execute the either type of request
    xmlhttp.send();

} //send_ajax_request() function



function receive_ajax_response() {
    if (this.readyState == 4 && this.status == 200) {
        var display_table = document.getElementById("display_records");
        var message_area = document.getElementById("display_messages");
        var display_table_body = document.getElementById("display_area");
        
        // try parsing AJAX response text as JSON
        var results;
        try {
            results = JSON.parse(this.responseText);
        }
        // If that fails, simply display the response text as HTML.
        // This will allow us to see debug messages! Yay!
        catch {
            display_table.style.visibility = "hidden";
            message_area.style.visibility = "visible";
            display_table_body.style.visibility = "collapse"; //only works on table rows

            message_area.innerHTML = this.responseText;
            return;
        }


        if (results.length > 0) {
            message_area.style.visibility = "hidden";
            display_table.style.visibility = "visible";
            display_table_body.style.visibility = "visible";

            //clear existing contents in the results table body (if any)
            display_table_body.innerHTML = "";

            // Make some reusable variables
            var db_record;
            var row;
            var cell;
            var content;

            // Iterate through results while creating new rows
            for (var i = 0; i < results.length; i++) {
                //create a row and add it to the table
                row = document.createElement("tr");
                display_table_body.appendChild(row);

                //extract a record from the json results
                db_record = results[i];

                //add the email field from this record to the table row
                cell = document.createElement("td");
                content = document.createTextNode(db_record.email);
                cell.appendChild(content);
                row.appendChild(cell);

                //TODO: add code to display password and birthday fields
                cell = document.createElement("td");
                content = document.createTextNode(db_record.password);
                cell.appendChild(content);
                row.appendChild(cell);
                
                cell = document.createElement("td");
                content = document.createTextNode(db_record.DOB);
                cell.appendChild(content);
                row.appendChild(cell);
            }
        } //endif processing sql results
        //handle 0 results
        else 
        {
            display_table.style.visibility = "hidden";
            message_area.style.visibility = "visible";
            display_table_body.style.visibility = "collapse"; // only works on table rows

            message_area.innerHTML = "No results found.";
        }
    }//endif: check ajax readyState and status

    return;
} //end receive_ajax_response() function


