<?php
    session_start();
    /* if(isset($_SESSION["email"])){
        header("Location: mgmt.php");
        exit();
    } Not necessary since anyone can vote on a poll */

    require_once("../php_tasks/db.php");
    try{
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
    }
    catch (PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    print_r($_GET);
    //if(isset($_GET[""]))
    $pollID = 5;
    $resultQuery = "SELECT Polls.question, Answers.answer, COUNT(Results.answer_ID) AS Results_A FROM Polls LEFT JOIN Answers ON (Polls.poll_ID=Answers.poll_ID) LEFT JOIN Results ON (Answers.answer_ID=Results.answer_ID) WHERE Polls.poll_ID=$pollID GROUP BY Answers.answer_id";
    $numAnswerQuery = "SELECT COUNT(*) As numAnswers FROM ($resultQuery) as allPolls";
    //print $numAnswerQuery;
    $Result = $countResult = $dbconnection->query($resultQuery);
    $resultRowCount = $Result->rowCount();
    //print $resultRowCount;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - Results</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
    </head>
    <body class="overallContainer">
        <div class="top">
            <div class="headerLeft">
                <div class="headerTopTwoLeft">
                    Results
                </div>
            </div>
            <div class="headerRight right">
                <img class="headerImage" src="../images/Icon1.png" alt="Survey Icon" />
            </div>
            <div class="headerBottom">Results of a poll</div>
        </div>
        <div class="center">
            <div class="ResultsContainer">
                <div class="ResultsQuestion">
                    <?php
                    $Result = $dbconnection->query($resultQuery);
                    $row = $Result->fetch();
                    $numAnswerCount = $dbconnection->query($numAnswerQuery);
                    $numAnswerRowCount = $numAnswerCount->rowCount();
                    $counterRow = $countResult->fetch();
                    $counter = $countResult->rowCount();
                    $numAnswers = $numAnswerCount->fetch();
                    $numAns = $numAnswers['numAnswers'];?>
                    <div class="ResultsQuestionHead">Question:&nbsp;</div>
                    <div class="ResultsQuestionBox">
                        <?php
                            echo $row['question'];?>
                    </div>
                </div>
                <div class="ResultsAnswer">
                    <div class="ResultsAnswerHead">Answers:&nbsp;<br/></div>
                    <div class="ResultsAnswerNum">
                        <span class="ResultsAnswerNumText">
                        <?php 
                    //print_r($row['Results_A']);
                            $i = 1;
                            $totalVotes = 0;
                            while ($counter > 0){
                                $totalVotes += $counterRow['Results_A'];
                                $counterRow = $countResult->fetch();
                                $counter--;
                            }

                            while($numAns > 0){?>
                            <span>
                                <?php
                                    echo ($i . ". " . $row['answer']);
                                    if($totalVotes > 0){
                                        $percent = ($row['Results_A'] / $totalVotes) * 100;?>
                                        <span class="resultsGraphs">
                                            <span style="background: linear-gradient(90deg, lightblue 0 <?=$percent?>%, aliceblue <?=$percent?>% 100%);"><?=$row['Results_A']?>/<?=$totalVotes?></span>
                                        </span>
                            </span>
                                            <br/><?php
                                    } else {
                                        ?>
                                        <span class="resultsGraphs">
                                            <span style="background-color: aliceblue">No Votes Cast</span>
                                        </span>
                                    </span>
                                            <br/>
                        <?php
                                    }
                            $numAns--;
                            $i++;
                            if($numAns > 0){
                                $row = $Result->fetch();
                            }
                            }?>
                    </div>
                </div>
                <div class="ResultsButtons">
                    <div class="ResultsButtonsLeft">
                        <a href="vote.php">
                        <input type="button" value="Return to Vote"/></a>
                    </div>
                    <div class="ResultsButtonsMiddle">
                        <a href="mainPage.php">
                        <input type="button" value="Return to Home"/></a>
                    </div>
                    <div class="ResultsButtonsRight">
                        <a href="mgmt.php">
                        <input type="button" value="Return to Management"/></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign5/pages/results.php">Validate 'results.php'</a>
        </div>

    </body>
</html>