<?php
   // Complete the TODOs and FIXMEs
   // - HINT: when reading www.php.net, check the User Contributed Notes too...

    //  From show_records.php
    /*TODO 1: Create a connection to your database using the PDO API
      - be sure to handle errors raised by PDO properly - see FIXME 1a and 1b
      - see example 2 here: https://www.php.net/manual/en/mysqli.construct.php
      - see also lab 10:
         https://www.cs.uregina.ca/Links/class-info/215/php_mysql_PDO/index.html#dbconnection
    */

    /* TODO 2: query the User table... 
        - Be sure to select only fields you need.
        - filter your results using 'q' value sent in the request
        - use PDO::query https://www.php.net/manual/en/pdo.query.php
        - set $fetchMode so you get ASSOCiative arrays, not NUMbered or BOTH 
    */

    /*TODO 3: if the query returned 0 results, echo an error message
         - the Javascript we provide will directly print anything that is not JSON encoded
         - warning: users are not always happy to see error messages...
         - you might be tempted to use PDOStatement::rowCount for this. 
            Read the documentation carefully first, and consider example #2:
               https://www.php.net/manual/en/pdostatement.rowcount.php 
    */
    
    /*TODO 4: if the query returned 1 or more results, built an array with them
         - loop through the results using fetch()
         https://www.php.net/manual/en/pdostatement.fetch.php
         - add each row to an array
            -> fetchAll() does this for you, but please use fetch() to pracitec PHP array buiding.
               - appending to PHP arrays: 
               - https://www.php.net/manual/en/language.types.array.php#language.types.array.syntax.modifying
               - https://www.php.net/manual/en/function.array-push.php/
    */

    /*TODO 5: after creating a query results array, encode it as JSON and echo it as the message
         - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php
    */

    //  From ajax_dom.html
    /* <!-- TODO: add headers for Password and Birthday--> */

    //  From scripts.js
    //  From events.js
    /* TODO: add code to register the "input" event on the search text box so that it sends ajax requests whenever a key is pressed 
    */
?>