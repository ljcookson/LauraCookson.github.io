<?php

   require_once("./db.php");
   /* TODO 1 */
   try {
      $dbconnection = new PDO($attr, $db_user, $db_pwd, $options);
      $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
      die ("PDO Error >> " . $e->getMessage() . "\n<br/>");
   }
   
   /* TODO 2 */
   $q = $_GET['q'];
   if($q != ""){
      $userQuery = "SELECT email, password, DOB FROM User WHERE email LIKE '$q%'";
      $countQuery = "SELECT COUNT(*) FROM ($userQuery) as count";
      $countResult = $dbconnection->query($countQuery, PDO::FETCH_ASSOC);
      $countResult->execute();
      $pdoResult = $dbconnection->query($userQuery, PDO::FETCH_ASSOC);
      $pdoResult->execute();
      $countRows = $countResult->fetchColumn();

      /* TODO 3 */
      if($countRows == 0){
         echo ("No records start with $q");
      } else {
         /* TODO 4 */
         $a = [];//Empty array - can also use $a = Array();
         while($countRows > 0){
            $row = $pdoResult->fetch(PDO::FETCH_ASSOC);
            $a[] = $row;
            $countRows--;
         }
         /* TODO 5 */
         echo json_encode($a);
      }
   }
   
   $dbconnection = null;

?>
