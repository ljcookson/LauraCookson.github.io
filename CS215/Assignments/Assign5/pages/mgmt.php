<?php
    session_start();
    //print_r ($_SESSION);
    if(isset($_SESSION["email"])){
        header("Location: mainPage.php");
        exit();
    }
    //print_r($_SESSION);
    require_once("../php_tasks/db.php");
    $fName = $_SESSION["First_Name"];
    $userID = $_SESSION["User_id"];

    // Connect to database
    try {
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(),(int)$e->getCode());
    }
    
    // PHP for displaying all polls for this user.
    $mgmtPollQuery = "SELECT Polls.poll_ID, Polls.question, Answers.answer, COUNT(Results.answer_ID) as Results_A, Polls.lastVote, Polls.createdDate FROM Polls INNER JOIN Answers ON (Polls.poll_ID=Answers.poll_ID) LEFT JOIN Results ON (Answers.answer_ID=Results.answer_ID) WHERE Polls.user_ID=$userID Group By Answers.answer_ID, Polls.poll_ID";
    $numAnswerQuery = "SELECT COUNT(*) As numAnswers FROM ($mgmtPollQuery) as allPolls GROUP BY poll_ID";
    
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
            <div class="mgmtContainer">
                <div class="mgmtPolls">
                    <?php
                        $i = 1;
                        $mgmtPollResult = $dbconnection->query($mgmtPollQuery);
                        $row = $mgmtPollResult->fetch();
                        $numAnswerCount = $dbconnection->query($numAnswerQuery);
                        $numAnswerRowCount = $numAnswerCount->rowCount();
                        $counterRow = $mgmtCounterResult->fetch();
                        $counter = $mgmtCounterResult->rowCount();
                        $numAnswers = $numAnswerCount->fetch();
                        $numAns = $numAnswers['numAnswers'];

                        while($numAnswerRowCount > 0){
                            //print_r($row);
                            $cDate = date("F d, Y",strtotime($row['createdDate']));
                            $lvDate = date("F d, Y",strtotime($row['lastVote']));
                            $totalVotes = 0;
                            while ($counter > 0){
                                $totalVotes += $counterRow['Results_A'];
                                $counterRow = $mgmtCounterResult->fetch();
                                $counter--;
                            }
                        ?>
                        <input type="radio" name="myPolls" class="mgmtPollsRadio" id=<?=$row['poll_ID']?>/>
                        <label for=<?=$row['poll_ID']?>>
                            <span class="mgmtPollsQA">
                                <span class="mgmtPollsQuestion">Question:</span>
                                <span class="mgmtPollsAnswer">Answer:</span>
                                <span class="mgmtPollsQText">
                                    <span><?php
                                        echo $row['question'];?></span>
                                </span>
                                <span class="mgmtPollsA"> 
                                <?php
                                while($numAns > 0){
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
                                    $numAns--;
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
                                    $numAns = $numAnswers['numAnswers'];
                                }
                        }?>
                </div>
                <div class="mgmtPollsButtons">
                    <div class="mgmtPollsButtonsLeft">
                        <a href="create.php">
                        <input type="button" value="Create New Poll" name="mgmtCreateButton"/></a>
                    </div>
                    <div class="mgmtPollsButtonsMiddle">
                        <a href="vote.php">
                        <input type="button" value="Vote" name="mgmtVoteButton"/></a>
                    </div>
                    <div class="mgmtPollsButtonsRight">
                        <a href="results.php">
                        <input type="button" value="Results" name="mgmtResultsButton"/></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign5/pages/mgmt.php">Validate 'mgmt.php'</a>
        </div>

    </body>
</html>