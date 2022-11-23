<?php
    session_start();
    if(isset($_SESSION["email"])){
        header("Location: mainPage.php");
        exit();
    }

    require_once("../php_tasks/db.php");
    $fName = $_SESSION["First_Name"];
    $userID = $_SESSION["User_id"];

    $error = "";
    $valid = true;
    $open = "";
    $close = "";
    $ques = "";
    $ans = [];
    $dateRegex = "/^\d{4}-\d{2}-\d{2}$/";

    if(isset($_POST["createButton"]) && $_POST["createButton"]){
        //print_r($_POST);
        $open = trim($_POST["dateTimeOpen"]);
        $close = trim($_POST["dateTimeClose"]);
        $ques = trim($_POST["createQuestion"]);
        $num = 1;
        while($num < 6){
            $ans[$num] = ($_POST["createA$num"]);
            $num++;
        }
        
        // Connect to database
        try {
            $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
            // Open Validation
            $openCheck = preg_match($dateRegex, $open);
            if($open == NULL || $open == "" || $openCheck == false){
                $valid = false;
                $error .= "Open date is invalid. \n<br/>";
                /* print ($error);
            } else {
                print ("Open date is Valid.");
                print ("Open Date: $open \n<br/>"); */
            }
            // Close Validation
            $closeCheck = preg_match($dateRegex, $close);
            if($close == NULL || $close == "" || $closeCheck == false){
                $valid = false;
                $error .= "Close date is invalid. \n<br/>";
                /* print ($error);
            } else {
                print ("Close date is Valid.");
                print ("Close Date: $close \n<br/>"); */
            }
            // Question Character Validation
            $quesLength = strlen($ques);
            if($ques == NULL || $ques == "" || $quesLength > 100){
                $valid = false;
                $error .= "Question is invalid \n<br/>";
                /* print ($error);
            } else {
                print ("Question is Valid.");
                print ("Question: $ques \n<br/>"); */
            }
            // Character Validation
            $int = 1;
            while($int < 3){
                $ansLength = strlen($ans[$int]);
                if($ans[$int] == NULL || $ans[$int] == "" || $ansLength > 50){
                    $valid = false;
                    $error .= "Answer $int is invalid \n<br/>"; 
                    /* print ($error);
                } else {
                    print ("Answer is Valid.");
                    print ("Answer: $row[int] \n<br/>"); */
                }
                $int++;
            }
            
            if(!$valid){
                $error .= "Poll creation failed.";
            } else {
                $createPollQuery = "INSERT INTO Polls (openDate, closeDate, question, user_ID, createdDate) VALUES ('$open', '$close', '$ques', '$userID', NOW())";
                print($createPollQuery);
                $createPollResult = $dbconnection->exec($createPollQuery);
                
                $getPollID = "SELECT poll_ID FROM Polls WHERE question='$ques'";
                print($getPollID);
                $getPollIDResult = $dbconnection->query($getPollID);
                $PollID = $getPollIDResult->fetch();

                $cPollQuery = "INSERT INTO Answers (answer, poll_ID) VALUES ";
                
                $qnum = 1;
                
                while($qnum != 6){
                    $qup = $qnum + 1;
                    if($qup < 6){
                        if(strlen($ans[$qup]) > 0){
                            $cPollQuery .= ("('$ans[$qnum]', '$PollID[poll_ID]'), ");
                            $qnum++;
                        } else {
                            $cPollQuery .= ("('$ans[$qnum]', '$PollID[poll_ID]')");
                            $qnum = 6;
                        }
                    } else {
                        $cPollQuery .= ("('$ans[$qnum]', '$PollID[poll_ID]')");
                        $qnum = 6;
                    }
                }
                print $cPollQuery;
                $createAnsResult = $dbconnection->exec($cPollQuery);
                
                if($createPollResult){
                    header("Location: mgmt.php");
                    $createPollResult = null;
                    $createAnsResult = null;
                    $dbconnection = null;
                    exit();
                } else {
                    $createPollResult = null;
                    $createAnsResult = null;
                    $valid = false;
                    $error = ("Poll creation failed.\n<br/>");
                }
            }
            $dbconnection = null;
        }
        catch (PDOException $e) {
            throw new PDOException($e->getMessage(),(int)$e->getCode());
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - New Poll</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
        <script type="text/javascript" src="../scripts/validating.js"> </script>  
    </head>
    <body class="overallContainer">
        <div class="top">
            <div class="headerLeft">
                <div class="headerTopTwoLeft">
                    Create a Poll
                </div>
            </div>
            <div class="headerRight right">
                Hi <?PHP
                    echo $fName?>!
                <a href="../php_tasks/Logout.php"><button>Logout</button></a>
            </div>
            <div class="headerBottom">Create a new poll</div>
        </div>
        <div class="center">
            <form class="createContainer" id="createPoll" action="" method="post">
                <div class="createOpenClose">
                    <div>
                        <div class="createOpenHead">Open:&nbsp;<input type="date" id="dateTimeOpen" name="dateTimeOpen" class="createOpenBox"/> </div>
                        <label id="msg_openDate" class="errorMessage errorColumn"></label>
                    </div>
                    <div>
                        <div class="createCloseHead">Close:&nbsp;
                        <input type="date" id="dateTimeClose" name="dateTimeClose" class="createCloseBox" /></div>
                        <label id="msg_closeDate" class="errorMessage errorColumn"></label>
                    </div>
                </div>
                <div class="createQuestion">
                    <div class="createQuestionHead">Question:&nbsp;
                    </div>
                    <textarea class="createQuestionBox" name="createQuestion" id="createQuestion" placeholder="Type your question..." maxlength="100" rows="" cols=""></textarea>
                    <label id="msg_char" class="errorMessage errorColumn">
                        <span class="wordCount" id="maximum">/100</span>
                        <span class="wordCount" id="createQuestionCurrent"> 0</span>
                    </label>
                </div>
                <div class="createAnswer">
                    <div class="createAnswerHead">Answers:&nbsp;</div>
                    <div class="createAnswerNum">
                <?php
                    $rowCount = 1;
                    while($rowCount < 6){?>
                        <div class="createErrors">
                            <div class="createAnswerNumText"><?=$rowCount?>.&nbsp;</div>
                            <textarea class="createAnswerBox" name="createA<?=$rowCount?>" id="createA<?=$rowCount?>" rows="" cols=""></textarea>
                            <label id="msg_charA<?=$rowCount?>" class="errorColumn errorMessage">
                                <span class="wordCount" id="maximumA<?=$rowCount?>">/50</span>
                                <span class="wordCount" id="createA<?=$rowCount?>Current">0</span>
                            </label>
                        </div><?php
                        $rowCount++;
                    }?>
                    </div>
                </div>
                <div class="createButtons">
                    <div class="createButtonsLeft">
                        <a href="mgmt.php">
                        <input type="submit" name="createButton" value="Create"/></a>
                    </div>
                    <div class="createButtonsMiddle">
                        <input type="reset" value="Reset"/>
                    </div>
                    <div class="createButtonsRight">
                        <a href="mgmt.php">
                        <input type="button" value="Cancel"/>
                    </div>
                    <div id="display_info" class="errorMessage"></div>
                </div>
            </form>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign6/pages/create.php">Validate 'create.php'</a>
        </div>
        <script type = "text/javascript"  src = "../scripts/registrations.js" ></script>
    </body>
</html>