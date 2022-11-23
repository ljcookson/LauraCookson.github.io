<?php
    session_start();
    require_once("../php_tasks/db.php");

    //print_r($_GET);
    $pollID = $_GET["pID"];
    $answerID = $_GET["ansID"];
    
    try {
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $voteQuery = "INSERT INTO Results (answer_ID, resultDate) VALUES ($answerID, NOW())";
    $voteResultsQuery = "UPDATE Polls SET lastVote = NOW() WHERE poll_ID=$pollID";
    $voteQueryResult = $dbconnection->query($voteQuery);
    $voteResultsResult = $dbconnection->query($voteResultsQuery);

    if($voteQueryResult){
        $qResults = "SELECT Polls.question, Answers.answer, COUNT(Results.answer_ID) AS Results_A, Answers.answer_ID FROM Polls LEFT JOIN Answers ON (Polls.poll_ID=Answers.poll_ID) LEFT JOIN Results ON (Answers.answer_ID=Results.answer_ID) WHERE Polls.poll_ID=$pollID GROUP BY Answers.answer_ID";
        $totalQResults = "SELECT COUNT(Results_A) AS totals FROM ($qResults) as Results";

        $countResult = $dbconnection->query($totalQResults);
        $countResult->execute();

        $result = $totalResult = $dbconnection->query($qResults);
        $result->execute();
        $countRows = $result->rowCount();
        $results = array("Results"=>array());
        while($countRows > 0){
           $row = $result->fetch();
           $results["Results"][] = $row;
           $countRows--;
        }
        //print_r($results);
        echo json_encode($results);
     } 
     $dbconnection = null;
?>