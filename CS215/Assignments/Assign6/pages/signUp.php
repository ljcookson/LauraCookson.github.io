<?php 
    session_start();

    //  If someone is logged in, redirect them to the Management Page
    if(isset($_SESSION["email"])){
        header("Location: mgmt.php");
        exit();
    }

    require_once("../php_tasks/db.php");
    $valid = true;
    $error = "";
    $email = "";
    $emailReg = "/^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[\w*]{2,3}$/";
    $pwordReg = "/^(\S*)?\d+(\S*)?$/";
    $userReg = "/^[a-zA-Z0-9_-]+$/";
    
    //  Create other variables for form data
    $fName = "";
    $lName = "";
    $userName = "";
    $password = "";
    $confirmPass = "";
    $avatar = "";

    //  Verify Sign-up Form Submission
    if(isset($_POST["submitSignupForm"]) && $_POST["submitSignupForm"]){
        //  print("The form has been submitted.");
        //  retrieve the field information
        print_r($_POST);
        $fName = trim($_POST["fname"]);
        $lName = trim($_POST["lname"]);
        $userName = trim($_POST["uname"]);
        $password = trim($_POST["pword"]);
        $confirmPass = trim($_POST["cpword"]);
        $email = trim($_POST["email"]);
        $avatar = $_POST["avatarImages"];

        //  Load the database
        try {
            $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);

            /*echo ("First Name: $fName \n<br/>");
            echo ("Last Name: $lName \n<br/>");*/
            // Validate all fields before query
            // UserName Validation:
            $lengthuser = strlen($userName);
            $userCheck = preg_match($userReg, $userName);
            if($userName == NULL || $userName == "" || $lengthuser > 40 ||$userCheck == false){
                $valid = false;
                $error .= "UserName is invalid. \n<br/>";
                /*print($error);
            }else{
                print ("UserName is Valid");
                echo ("Username: $userName \n<br/>");*/
            }
            // Password Validation:
            $lengthpWord = strlen($password);
            $pwordCheck = preg_match($pwordReg, $password);
            if($password == NULL || $password == "" || $lengthpWord != 8 || $pwordCheck == false){
                $valid = false;
                $error .= "Password is invalid. \n<br/>";
                /*print ($error);
            }else{
                print ("Password is valid");
            echo ("Password: $password \n<br/>");*/
            }

            // Confirm Password Validation
            if($confirmPass == NULL || $confirmPass == "" || $confirmPass != $password){
                $valid = false;
                $error .= "Confirm Password is invalid. \n<br/>";
                /*print ($error);
            }else{
                print ("Confirm Password is valid. \n<br/>");
            echo ("Confirm Password: $confirmPass \n<br/>");*/
            }

            // Email Validation
            $lengthemail = strlen($email);
            $emailCheck = preg_match($emailReg, $email);
            if($email == NULL || $email == "" || $lengthemail > 60 || $emailCheck == false){
                $valid = false;
                $error .= "Email contains invalid information. \n<br/>";
                /*print($error);
            }else{
                print ("Email is valid");
            echo ("Email: $email \n<br/>");*/
            }
            
            // Avatar Validation
            //$avatar = $_POST['avatarImages'];
            //echo ("Avatar Location: $avatar \n<br/>");
            if(empty([$avatar])){
                $valid = false;
                $error .= "Avatar selection is required";
                /*print($error);
            } else{
                $sql = "INSERT INTO Users (avatar) VALUES ";
                $sql .= "($avatar)";*/
            }
            
            if(!$valid){
                $error .= "Signup Failed.";
            } else {
                //print("Signup successful.");
                $signupQuery = "INSERT INTO Users (first_name, last_name, userName, pword, email, avatar) VALUES ('$fName', '$lName', '$userName', '$password', '$email', '$avatar')";
                //print($signupQuery);
                $signupResult = $dbconnection->exec($signupQuery);
                //print("User Entery successfully created \n<br/>");

                $getUID = "SELECT user_ID FROM Users WHERE email='$email' AND first_name='$fName'";

                $getUIDResult = $dbconnection->query($getUID);
                if($signupResult){
                    //  Signup was successful
                    //print ("Sign up successful\n<br/>");
                    
                    $_SESSION["User_id"] = $getUIDResult->fetch()['user_ID'];
                    $_SESSION["First_Name"] = $fName;
                    $_SESSION["Last_Name"] = $lName;
                    $_SESSION["User_Name"] = $userName;
                    $_SESSION["Avatar"] = $avatar;

                    header("Location: mgmt.php");
                    $signupResult = null;
                    $dbconnection = null;
                    exit();
                }
                else{
                    //  Sign up Failed
                    //  print ("Sign up failed");
                    $signupResult = null;
                    $valid = false;
                    $error = ("Sign-up failed\n<br/>");
                    print($error);
                }
            }
            $dbconnection = null;
        }
        catch (PDOException $e) {
            throw new PDOException($e->getMessage(),(int)$e->getCode());
            print("Error");
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - Sign Up</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
        <script type="text/javascript" src="../scripts/validating.js"> </script>  
    </head>
    <body class="overallContainer">
        <div class="top">
            <div class="headerLeft">
                <div class="headerTopTwoLeft">Sign-up</div>
            </div>
            <div class="headerRight right">
                <img class="headerImage" src="../images/Icon1.png" alt="Survey Icon" />
            </div>
            <div class="headerBottom">Create your account below to begin creating polls</div>
        </div>
        <div class="center">
            <form id="SignUpForm" class="signContainer" action="" method="post">
                <div class="signFields">
                    <div class="signErrors">
                        <p>First Name:</p>
                        <input class="signFieldBox" type="text" id="fname" name="fname"/>
                    </div>
                    <div class="signErrors">
                        <p>Last Name:</p>
                        <input class="signFieldBox" type="text" id="lname" name="lname"/>
                    </div>
                    <div class="signErrors">
                        <label id="msg_userName" class="errorMessage"></label>
                        <p class="signFieldName">UserName:</p>
                        <input class="signFieldBox" type="text" id="uname" name="uname"/>
                    </div>
                    <div class="signErrors">
                        <label id="msg_password" class="errorMessage"></label>
                        <p class="signFieldName">Password:</p>
                        <input type="password" id="pword" name="pword"/>
                    </div>
                    <div class="signErrors">
                        <label id="msg_confirmPassword" class="errorMessage"></label>
                        <p class="signFieldName">Confirm Password: </p>
                        <input type="password" id="cpword" name="cpword"/>
                    </div>
                    <div class="signErrors">
                        <label id="msg_email" class="errorMessage"></label>
                        <p class="signFieldName">Email Address:</p>
                        <input type="email" id="email" name="email"/><!--Type Error on validation, it does not like 'email'  I have opted to leave it.-->
                    </div>
                </div>
                <div class="signAvatarGrid">
                    <div class="signAvatarHeadBody">
                        <p class="signupAvatarHead">Choose an Avatar:</p>
                        <label class="avatarImages">
                            <input type="radio" name="avatarImages" value="../images/Avatar1.JPG"/>
                            <img class="image" src="../images/Avatar1.JPG" alt="Avatar choice 1"/>
                        </label>
                        <label class="avatarImages">
                            <input type="radio" name="avatarImages" value="../images/Avatar2.JPG"/>
                            <img class="image" src="../images/Avatar2.JPG" alt="Avatar choice 2"/>
                        </label>
                        <label class="avatarImages">
                            <input type="radio" name="avatarImages" value="../images/Avatar3.JPG"/>
                            <img class="image" src="../images/Avatar3.JPG" alt="Avatar choice 3"/>
                        </label>
                        <label class="avatarImages">
                            <input type="radio" name="avatarImages" value="../images/Avatar4.JPG"/>
                            <img class="image" src="../images/Avatar4.JPG" alt="Avatar choice 4"/>
                        </label>
                        <label class="avatarImages">
                            <input type="radio" name="avatarImages" value="../images/Avatar5.JPG"/>
                            <img class="image" src="../images/Avatar5.JPG" alt="Avatar choice 5"/>
                        </label>
                    </div>
                    <div class="signErrors signupAvatarError">
                        <label id="msg_avatar" class="errorMessage"></label>
                    </div>
                </div>
                <div class="signButtons">
                    <div class="signButtonsLeft">
                        <div class="signButtonsLeftLeft">
                            <div id="display_info" class="errorMessage"></div>
                        </div>
                        <div class="signButtonsLeftRight">
                            <input type="submit" name="submitSignupForm" value="Sign-up" />
                        </div>
                    </div>
                    <div class="signButtonsRight">
                        <input type="button" value="Cancel" onclick="document.location.href='mainPage.php' "/>
                    </div>
                </div>
            </form>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign6/pages/signUp.php">Validate 'signUp.php'</a>
        </div>
        <script type = "text/javascript"  src = "../scripts/registrations.js" ></script>
    </body>
</html>