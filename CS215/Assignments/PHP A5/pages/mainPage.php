<?php
    //session_start(); - starts on line 44
    require_once("../php_tasks/db.php");
    
    //  Load the database
    try {
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(),(int)$e->getCode());
    }
    
    $error = "";
    $email = "";
    $pollToVote = "";

    // PHP for login section
    if(isset($_POST["mainLoginButton"]) && $_POST["mainLoginButton"]){
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //  print("The form has been submitted.");
        //  Get the email & password

        $email = trim($_POST["email"]);         //  trim removes white space before and after data
        $password = trim($_POST["pword"]);
              //print("Email: $email \n Password: $password");

        if(strlen($email) > 0 && strlen($password) > 0){
            //  Verify the email/password
            $epquery = "SELECT * FROM Users WHERE email='$email' AND pword='$password'";

            print ($epquery);
            $eqresult = $dbconnection->query($epquery);

            print ($eqresult->rowCount());

            if($eqresult->rowCount() > 0){
                //  Login was successful
                //print ("Login Successful");
                $row = $eqresult->fetch();
                //print_r($row);
                $userID = $row["user_ID"];
                $fName = $row["first_Name"];
                $lName = $row["last_Name"];
                $uName = $row["userName"];
                $avatar = $row["avatar_ID"];
                session_start();
                $_SESSION["User_id"] = $userID;
                $_SESSION["First_Name"] = $fName;
                $_SESSION["Last_Name"] = $lName;
                $_SESSION["User_Name"] = $uName;
                $_SESSION["Avatar"] = $avatar;

                //print_r($_SESSION);

                $dbconnection = null;
                header("Location: mgmt.php");
                exit(); 
            }
            else {
                //  Login Failed
                //print ("Login Failed");
                $error = ("The email/password combination is incorrect.");
                //print($error);
            }
        }
        else{
            $error = ("Email and password are required for login.");
            //print($error);
        }

        //  print_r($_POST);    
    }

    // PHP for displaying recent polls
    $recentPollQuery = "SELECT DISTINCT poll_ID, question, createdDate FROM Polls WHERE closeDate >= (SELECT CURRENT_TIMESTAMP) ORDER BY createdDate DESC LIMIT 5;";
    $pollToVote = "";
    //print($recentQuery);

    $recentPollResult = $pollIDResult = $dbconnection->query($recentPollQuery);
    $recentPollRowCount = $recentPollResult->rowCount();
    //print($recentPollRowCount);
    if(isset($_POST["mainVoteButton"]) && $_POST["mainVoteButton"]){
        print_r($_POST);
        if(isset($_POST['polls'])){
        /* $pollToVote = ((int)$_POST['polls']);
        echo($pollToVote);
        $_POST["pollID"] = $pollToVote; */
        /* $dbconnection = null;
        header("Location: vote.php");
        exit(); */
        }
    } else if(isset($_POST["mainResultButton"]) && $_POST["mainResultButton"]){
        //print_r($_POST);
        $dbconnection = null;
        header("Location: results.php");
        exit();
    }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - Home</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
        <script type="text/javascript" src="../scripts/validating.js"> </script>  
    </head>
    <body class="overallContainer">
        <div class="top">
            <div class="headerLeft">
                <div class="headerTopTwoLeft">Welcome to Cooky Polls!</div>
            </div>
            <div class="headerRight right">
                <img class="headerImage" src="../images/Icon1.png" alt="Survey Icon" />
            </div>
            <div class="headerBottom">Vote for the five most recent polls created by our Users</div>
        </div>
        <div class="center">
            <div class="mainContainer">
                <form class="mainActivePolls" method="POST" action="vote.php">
                    <div class="mainHeaders">
                        Most Recent Active Polls
                    </div>
                    <div class="mainActivePollsBody">
                        <?php
                        while($recentPollRowCount > 0){
                            $row = $recentPollResult->fetch();
                            //echo ($row['question']);
                            $recentPollRowCount--;
                        ?>
                        <input type="radio" name="polls" class="mainActivePollsBodyRadio" value=<?=$row['poll_ID']?> />
                        <label for=<?=$row['poll_ID']?>>
                            <?php
                                echo $row['question'];?>
                        </label>
                        <?php
                            }?>
                    </div>
                    <div class="mainActivePollsButtons">
                        <div class="mainActivePollsButtonsLeft">
                            <input type="hidden" name="extra_VoteButton" id="extra_VoteButton" value="<?=$row['poll_ID']?>" />
                            <input type="submit" value="Vote" name="mainVoteButton"/>
                        </div>
                        <div class="mainActivePollsButtonsRight">
                            <input type="hidden" name="extra_ResultButton" id="extra_ResultButton" value="<?=$row['poll_ID']?>" />
                            <input type="submit" value="Results" name="mainResultButton"/>
                        </div>
                    </div>
                </form>
                <form id="LoginForm" action="" method="POST" class="mainLogin">
                    <div  class="mainHeaders">
                        Login below to access your polls:
                    </div>
                    <div class="mainLoginBody"> 
                        <div class="mainErrors">
                            <label id="msg_email" style="text-align: center" class="errorMessage"></label>
                            <p class="mainLoginBodyFieldName">Email:</p>
                            <input class="mainLoginBodyFieldBox" type="text" id="email" name="email" value="<?=$email?>"/>
                        </div>
                        <div class="mainErrors">
                            <label id="msg_password" style="text-align: center" class="errorMessage"></label>
                            <p class="mainLoginBodyFieldName">Password:</p>
                            <input class="mainLoginBodyFieldBox" type="password" id="pword" name="pword"/>
                        </div>
                    </div>
                    <div class="mainLoginButtons">
                        <div class="mainLoginButtonsLeft">
                            <div class="mainLoginButtonsLeftLeft">
                                <div id="display_info" class="errorMessage"></div>
                            </div>
                            <div class="mainLoginButtonsLeftRight">
                                <input type="submit" value="Login" name="mainLoginButton"/>
                            </div>
                        </div>
                        <div class="mainLoginButtonsRight">
                            <a href="mainPage.html">Forgot My Password</a>
                        </div>
                    </div>
                </form>
                <div class="mainSignup">
                    <p class="mainHeaders">Want to create your own polls?&nbsp;
                        <a href="signUp.php">
                        <input type="button" value="Sign-up Here"/></a>
                    </p>
                    
                </div>
            </div>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign5/pages/mainPage.php">Validate 'mainPage.php'</a> | 
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign4/css/cookson.css">Validate 'cookson.css'</a>
        </div>

        <script type = "text/javascript"  src = "../scripts/registrations.js" ></script>
    </body>
</html>