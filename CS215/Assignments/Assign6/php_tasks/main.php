<?php
    session_start();
    require_once("../php_tasks/db.php");

    $pollID = $_GET["pID"];
    //print($pollID);
    try {
        $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    
    $recentPollQuery = "SELECT DISTINCT poll_ID, question, createdDate FROM Polls WHERE closeDate >= (SELECT CURRENT_TIMESTAMP) AND poll_ID>$pollID ORDER BY createdDate DESC, poll_ID DESC LIMIT 5";
    //print($recentPollQuery);
    $countQuery = "SELECT COUNT(poll_ID) FROM ($recentPollQuery) as polls";

    $countResult = $dbconnection->query($countQuery, PDO::FETCH_ASSOC);
    $countResult->execute();
    $recentPollResult = $dbconnection->query($recentPollQuery);
    $recentPollResult->execute();
    
    $countRows = $countResult->fetchColumn();

    $recentPollRowCount = $recentPollResult->rowCount();

    if($countRows == 0){
        echo ("No polls have been created.");
     } else {
        $polls = array("polls"=>array());
        while($countRows > 0){
           $row = $recentPollResult->fetch();
           $polls["polls"][] = $row;
           $countRows--;
        }
        //print_r($polls);
        echo json_encode($polls);
     }
     $dbconnection = null;
?>