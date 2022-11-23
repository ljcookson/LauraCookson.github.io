<?php
    session_start();
    if(!isset($_SESSION["First_Name"])){
        header("Location: mainPage.php");
        exit();
    }
    require_once("../php_tasks/db.php");
    $fName = $_SESSION["First_Name"];
    $userID = $_SESSION["User_id"];

    // Connect to database
    try {
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(),(int)$e->getCode(), $e->a);
    }
    
    // PHP for displaying all polls for this user.
    $mgmtPollQuery = "SELECT Polls.poll_ID, Polls.question, Answers.answer, COUNT(Results.answer_ID) as Results_A, Polls.lastVote, Polls.createdDate FROM Polls INNER JOIN Answers ON (Polls.poll_ID=Answers.poll_ID) LEFT JOIN Results ON (Answers.answer_ID=Results.answer_ID) WHERE Polls.user_ID=$userID Group By Answers.answer_ID, Polls.poll_ID";

    $CountQuery = "SELECT SUM(Results_A) As totalVotes FROM ($mgmtPollQuery) as allPolls GROUP BY poll_ID";

    $numAnswerQuery = "SELECT COUNT(Results_A) As numAnswers FROM ($mgmtPollQuery) as allPolls GROUP BY poll_ID";
    //print($CountQuery);
    
    $mgmtPollResult = $mgmtCounterResult = $dbconnection->query($mgmtPollQuery);
    $mgmtPollCount = $mgmtPollResult->rowCount();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - My Polls</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
    </head>
    <body class="overallContainer">
        <div class="top">
            <div class="headerLeft">
                <div class="headerTopTwoLeft">
                    My Polls
                </div>
            </div>
            <div class="headerRight right">
                Hi <?PHP
                    echo $fName?>!
                <a href="../php_tasks/Logout.php"><button>Logout</button></a>
            </div>
            <div class="headerBottom">Create new or View, Vote on, or see the results of your existing polls</div>
        </div>
        <div class="center">
            <form class="mgmtContainer" id="myPolls" method="get" action="vote.php">
                <div class="mgmtPolls">
                    <?php
                        if($mgmtPollCount > 0){
                            $i = 1;
                            $mgmtPollResult = $dbconnection->query($mgmtPollQuery);
                            $row = $mgmtPollResult->fetch();// Each row of the results

                            $CountQueryR = $dbconnection->query($CountQuery);
                            $CountQueryRowCount = $CountQueryR->rowCount(); // Number of Questions for the user

                            $numAnswerCount = $dbconnection->query($numAnswerQuery);
                            $numAnswerRowCount = $numAnswerCount->rowCount(); // Number of Questions for the user
                            $numAnswers = $numAnswerCount->fetch();  
                            $counter = $numAnswers['numAnswers']; // Number of answers per question

                            while($numAnswerRowCount > 0){
                                $cDate = date("F d, Y",strtotime($row['createdDate']));
                                $lvDate = date("F d, Y",strtotime($row['lastVote']));
                                $totalVotesArray = $CountQueryR->fetch();
                                $totalVotes = $totalVotesArray['totalVotes'];
                            ?>
                            <input type="radio" name="polls" class="mgmtPollsRadio" value="<?=$row['poll_ID']?>"/>
                            <label for="<?=$row['poll_ID']?>">
                                <span class="mgmtPollsQA">
                                    <span class="mgmtPollsQuestion">Question:</span>
                                    <span class="mgmtPollsAnswer">Answer:</span>
                                    <span class="mgmtPollsQText">
                                        <span><?php
                                            echo $row['question'];?></span>
                                    </span>
                                    <span class="mgmtPollsA"> 
                                    <?php
                                    while($counter > 0){
                                        ?>
                                            <span><?php
                                                echo($i . ". " . $row['answer']);?>
                                            <?php
                                            if($totalVotes > 0){
                                                $percent = ($row['Results_A'] / $totalVotes) * 100;
                                                ?>
                                                <span class="mgmtPollsGraphs">
                                                    <span style="background: linear-gradient(90deg, lightblue 0 <?=$percent?>%, aliceblue <?=$percent?>% 100%);"><?=$row['Results_A']?>/<?=$totalVotes?></span>
                                                </span>
                                            </span>
                                                <br/><?php
                                            } else{
                                                ?>
                                                <span class="mgmtPollsGraphs">
                                                    <span style="background-color: aliceblue">No Votes Cast</span>
                                                </span>
                                            </span>
                                                <br/>
                                                <?php
                                            }
                                        $row = $mgmtPollResult->fetch();
                                        $counter--;
                                        $i++;
                                    }?>
                                    
                                </span>
                                </span>
                                <span class="mgmtPollsCreateVote">
                                    <span class="mgmtPollsCreate">
                                        <span>Date Created: <?php print "\n<br/>"?><span class="mgmtPollsCreateVoteBoxes"><?=$cDate?></span></span>
                                    </span>
                                    <span class="mgmtPollsVote">
                                        <span>Date of Most Recent Vote: <?php print "\n<br/>";
                                        if($totalVotes > 0){?>
                                            <span class="mgmtPollsCreateVoteBoxes"><?=$lvDate?></span><?php
                                        } else {?>
                                            <span class="mgmtPollsCreateVoteBoxes">No Votes Cast</span>
                                            <?php
                                        }?>
                                        </span>
                                    </span>
                                </span>
                                </label>
                                <?php
                                    $numAnswerRowCount--;
                                    $i = 1;
                                    if($numAnswerRowCount > 0){
                                        $numAnswers = $numAnswerCount->fetch();
                                        $counter = $numAnswers['numAnswers'];
                                    }
                            }
                        } else{?>
                            <p class="italic combine">
                                Create some polls and they will appear here!
                            </p>
                            <?php
                        } ?>
                </div>
                <div class="mgmtPollsButtons">
                    <div class="mgmtPollsButtonsLeft">
                        <a href="create.php">
                        <input type="button" value="Create New Poll" name="mgmtCreateButton"/></a>
                    </div>
                    <div class="mgmtPollsButtonsMiddle">
                       <input type="hidden" name="mgmtextra_vote" id="mgmtextra_vote" value="<?=$row['poll_ID']?>" ></input>
                        <input type="submit" value="Vote" name="mgmtextra_vote"/>
                    </div>
                    <div class="mgmtPollsButtonsRight">
                        <input type="hidden" name="extra_ResultmgmtButton" id="extra_ResultmgmtButton" value="<?=$row['poll_ID']?>" ></input>
                        <input type="submit" formaction="results.php" value="Results" name="mgmtResultsButton"/></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign6/pages/mgmt.php">Validate 'mgmt.php'</a>
        </div>

    </body>
</html>