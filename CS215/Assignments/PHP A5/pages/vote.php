<?php
    session_start();
   /*  if(isset($_SESSION["First_Name"])){
        print_r($_POST);
    } */

    print_r($_POST);
    require_once("../php_tasks/db.php");
    try{
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
    }
    catch (PDOExceptprintion $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    //print_r($_POST);
    $pollID = ($_POST['polls']);
    print $pollID;
    $voteQuery = "SELECT Polls.question, Answers.answer, Polls.poll_ID FROM Polls INNER JOIN Answers ON (Polls.poll_ID=Answers.poll_ID) WHERE Polls.poll_id=$pollID";
    //print $voteQuery;
    $voteResult = $dbconnection->query($voteQuery);
    $voteRowCount = $voteResult->rowCount();
    //print $voteRowCount;
    $row = $voteResult->fetch();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - Vote</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
    </head>
    <body class="overallContainer">
        <div class="top">
            <div class="headerLeft">
                <div class="headerTopTwoLeft">
                    Vote
                </div>
            </div>
            <div class="headerRight right">
                <img class="headerImage" src="../images/Icon1.png" alt="Survey Icon" />
            </div>
            <div class="headerBottom">Vote on a poll</div>
        </div>
        <div class="center">
            <form class="voteContainer" method="POST" action="results.php">
                <div class="voteQuestion">
                    <div class="voteQuestionHead">Question:&nbsp;</div>
                    <div class="voteQuestionBox">
                        <?php
                            echo $row['question'];?>
                    </div>
                </div>
                <div class="voteAnswer">
                    <div class="voteAnswerHead">Answers:&nbsp;<br/></div>
                    <div class="voteAnswerNum">
                        <?php 
                            $i = 1;
                            while($voteRowCount > 0){?>
                                <input type="radio" name="votePolls" class="voteRadio" id="A<?=$i?>"/>
                        <label for="A<?=$i?>">
                            <span class="voteAnswerNumText">
                                <span><?=$i?>.&nbsp;</span>
                            </span>
                            <span class="voteAnswerBox">
                                <span><?php
                                    echo $row['answer'];?></span>
                            </span>
                        </label>
                        <?php
                            $voteRowCount--;
                            $i++;
                            $row = $voteResult->fetch();
                            }?> 
                    </div>
                </div>
                <div class="voteButtons">
                    <div class="voteButtonsLeft left">
                        <a href="results.php">
                        <input type="submit" value="Cast Vote" name="VotePageButton"/></a>
                    </div>
                    <div class="voteButtonsMiddle">
                        <form method="POST" action="results.php">
                            <?php
                                //print $row['poll_ID'];
                                //echo $row['question'];?>
                                    <input type="submit" value="Results" name="ResultsButton"/>
                        </form>
                    </div>
                    <div class="voteButtonsRight right"><?php
                    print($_SESSION["First_Name"]);
                    print($_SESSION["User_id"]);?>
                        <a href="mgmt.php">
                        <input type="button" value="Cancel"/></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign5/pages/vote.ohp">Validate 'vote.php'</a>
        </div>

    </body>
</html>