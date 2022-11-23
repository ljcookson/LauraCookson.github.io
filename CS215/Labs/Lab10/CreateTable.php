<?php
    require_once("db.php");

    //  Load the database
    try {
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);

        // Create User Table
        $userTable = "CREATE TABLE User(
                        user_id INT NOT NULL AUTO_INCREMENT,
                        email VARCHAR(255) NOT NULL,
                        password VARCHAR(30) NOT NULL,
                        DOB DATE NOT NULL, 
                        PRIMARY KEY (user_id)
                        )";
        
        $dbconnection->exec($userTable);
        echo "User Table successfully created\n<br/>";
    }
    catch (PDOException $e) {
        print ("PDO Error >> " . $e->getMessage() . "\n<br/>");
        //throw new PDOException($e->getMessage(),(int)$e->getCode());
        //echo "Connection Unsuccessful";
    }

    $dbconnection = null;
?>