<?php 
// Connect to any existing PHP Session
session_start();

// Destroy the PHP session
// $_SESSION = array();
// unset($_SESSION);
session_unset();
session_destroy();
	
// redirect the user back to the login page
header("Location: ../pages/mainPage.php");
exit();

?>
