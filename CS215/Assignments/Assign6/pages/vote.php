<?php
    session_start();
    if(!isset($_GET["polls"])){
        header("Location: mainPage.php");
        exit();
    }

    require_once("../php_tasks/db.php");
    try{
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
    }
    catch (PDOExceptprintion $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    //print_r($_GET);
    //print_r($_SESSION);
    $pollID = trim($_GET['polls']);
    //print $pollID;

    $voteQuery = "SELECT Polls.question, Answers.answer, Answers.answer_ID, Polls.poll_ID FROM Polls INNER JOIN Answers ON (Polls.poll_ID=Answers.poll_ID) WHERE Polls.poll_id=$pollID";
    
    $voteResult = $dbconnection->query($voteQuery);
    $voteRowCount = $voteResult->rowCount();
    
    $Query = "SELECT question FROM Polls WHERE Polls.poll_id=$pollID";
    $ques = $dbconnection->query($Query)->fetch();

    if(isset($_GET["VotePageButton"])){
        print_r($_GET);
        $pollID = ($_GET['polls']);
        $answerID = ($_GET['votePolls']);
        $voteInQuery = "INSERT INTO Results (answer_ID, resultDate) VALUES ($answerID, NOW())";
        $voteInResult = $dbconnection->exec($voteInQuery);
        /* if($voteInResult){
            header("Location: results.php");
            $dbconnection = null;
            exit();
        } */
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"> <!--We were directed to validate using XHTML1.1, so I am using the headers from Labs 1 & 2-->
    <head>
        <!--<meta charset = "utf-8"> This causes two errors, without it I get two warnings.  I would welcome recommendations-->
        <title>Cooky Polls - Vote</title>
        <link rel="stylesheet" type="text/css" href="../css/cookson.css"/>
        <script type="text/javascript" src="../scripts/validating.js"> </script>  
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
            <form class="voteContainer" method="get" action="results.php">
                <div class="voteQuestion">
                    <div class="voteQuestionHead">Question:&nbsp;</div>
                    <div class="voteQuestionBox">
                        <?php
                            echo $ques['question'];?>
                    </div>
                </div>
                <div class="voteAnswer">
                    <div class="voteAnswerHead">Answers:&nbsp;<br/></div>
                    <div class="voteAnswerNum">
                        <?php 
                            $i = 1;
                            while($voteRowCount > 0){
                            $row = $voteResult->fetch();?>
                                <input type="radio" name="votePolls" class="voteRadio" id="A<?=$i?>" value="<?=$row['answer_ID']?>" />
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
                            //print_r($row);
                            $voteRowCount--;
                            $i++;
                            }?> 
                    </div>
                </div>
                <div class="voteButtons">
                    <div class="voteButtonsLeft left">
                        <input type="hidden" name="polls" id="extra_Vote" value="<?=$row['poll_ID']?>" />
                        <input type="hidden" name="answers" id="extra_aVote" value="<?=$row['answer_ID']?>" />
                        <input type="button" value="Cast Vote" name="VotePageButton"/>
                    </div>
                    <div class="voteButtonsMiddle">
                        <input type="submit" value="Results" name="ResultsButton"/>
                    </div>
                    <div class="voteButtonsRight right">
                        <a href="mgmt.php">
                        <input type="button" value="Cancel"/></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="bottom">
            <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Assignments/Assign6/pages/vote.php?polls=<?=$row['poll_ID']?>">Validate 'vote.php'</a>
        </div>
        <script type = "text/javascript"  src = "../scripts/registrations.js" ></script>

    </body>
</html>