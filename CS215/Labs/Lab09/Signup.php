<html>
    <head>
        <title>Sign UP PHP Display</title>
        <script type="text/javascript" src="./validate.js"> </script>
        <link rel="stylesheet" type="text/css" href="../../CSS/CooksonLabs.css"/>  
        <style>
            .err_msg{ color:red;}
        </style>
    </head>
    <body>
        <header>
            <nav class="lab_navigate">
                <div class="navbar">
                    <a href="../../">Home Page</a>
                    <div class="dropdown">
                        <button class="dropButton">Lab 9 Links&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                        <div class="dropdownContent">
                            <a href="./Signup.html">Sign-up Page</a>
                            <a href="./validate.js">validate.js</a>
                            <a href="./signup-r.js">signup-r.js</a>
                            <a href="./Signup.php">Signup.php</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropButton">Labs&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                        <div class="dropdownContent">
                            <a href="../Lab01/">Lab 1</a>
                            <a href="../Lab02/">Lab 2</a>
                            <a href="../Lab03/">Lab 3</a>
                            <a href="../Lab04/">Lab 4</a>
                            <a href="../Lab04/signup.html">Lab 4 JS</a>
                            <a href="../Lab05/">Lab 5</a>
                            <a href="../Lab05/signup.html">Lab 5 DOM</a>
                            <a href="../Lab06/">Lab 6</a>
                            <a href="../Lab06/signup.html">Lab 6 DOM2</a>
                            <a href="../Lab07/">Lab 7</a>
                            <a href="../Lab08/">Lab 8</a>
                            <a href="./">Lab 9</a>
                            <a href="./Signup.html">Lab 9 PHP</a>
                            <a href="../Lab10/">Lab 10</a>
                            <a href="../Lab11/">Lab 11</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropButton">Assignments&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                        <div class="dropdownContent">
                            <a href="../../Assignments/Assign1/200388154-Assignment1.pdf">Assignment 1</a>
                            <a href="../../Assignments/Assign2/basic_html_pages/mainPage.html">Assignment 2</a>
                            <a href="../../Assignments/Assign3/basic_html_pages/mainPage.html">Assignment 3</a>
                            <a href="../../Assignments/Assign4/basic_html_pages/mainPage.html">Assignment 4</a>
                            <a href="../../Assignments/Assign5/">Assignment 5</a>
                            <a href="../../Assignments/Assign6/">Assignment 6</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropButton">Validations&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                        <div class="dropdownContent">
                            <!--These validations are for the files that are connected to this page-->
                            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab09/">index.html</a>
                            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab09/Signup.html">Signup.html</a>
                            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab09/validate.js">validate.js</a>
                            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab09/signup-r.js">signup-r.js</a>
                            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab09/Signup.php">signup-r.js</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <?php
        $target_directory = "uploads/";
        $target_file = $target_directory.basename($_FILES["fileToUpload"]["name"]);
        $uploadOK = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //Check if image file is an actual image or a fake image
        if(isset($_POST["submit"])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false){
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOK = 1;
            } else {
                echo "File is not an image.";
                $uploadOK = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)){
            echo "Sorry, file already exists.";
            $uploadOK = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000){
            echo "Sorry, your file is too large.";
            $uploadOK = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOK = 0;
        }

        // Check if $uploadOK is set to 0 by an error
        if ($uploadOK == 0){
            echo "\nSorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                //echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
                $email = $_REQUEST['email'];
                $uname = $_REQUEST['uname'];

                echo "<h1>Display User Information</h1>";
                echo 
                "<table border=1 solid black>
                    <tr>
                        <td rowspan='2'border=1 solid black>
                            <img src='$target_file' width='130' height='130'/>
                        </td>
                        <td border=1 solid black>Email: $email</td>
                    </tr>
                    <tr>
                        <td border=1 solid black>Username: $uname</td>
                    </tr>
                </table>";
            } else {
                echo "\nSorry, there was an error uploading your file.";
            }
        } ?>
    </body>
</html>