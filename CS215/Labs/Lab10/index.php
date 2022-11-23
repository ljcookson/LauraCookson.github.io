<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
   <head>
      <title>Cookson Index page with SignUp and Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <script type="" src="https://kit.fontawesome.com/27c00b2d48.js" crossorigin="anonymous"></script> <!--This is for the caret on my navigation bar.  We were permitted to use Font Awesome in previous sessions.-->
      <script type="text/javascript" src="../Lab09/validate.js"></script>
      <link rel="stylesheet" type="text/css" href="../../CSS/CooksonLabs.css"/>
   </head>
   <body>
      <header>
         <img class="left" src="../../Images/Pepper.jpg" alt="My dog Pepper sitting pretty in a chair"/>
         <h1 class="middle">
               CS 215 - Summer 2022 <br />
               Lab 10: PHP and MySQL - PDO Style <br/>
               Created by Laura Cookson
         </h1>
         <img class="right" src="../../Images/Radar.jpg" alt="My dog Radar looking back while keeping watch out the window"/>
         <nav>
               <div class="navbar">
                  <a href="../../">Home Page</a>
                  <div class="dropdown">
                     <button class="dropButton">Lab 10 Links&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                     <div class="dropdownContent">
                            <a href="./CreateTable.php">CreateTable.php</a>
                            <a href="./db.php">db.php</a>
                           <a href="./index.php">index.php</a>
                           <a href="./Login.js">Login.js</a>
                           <a href="./Login.php">Login.php</a>
                           <a href="./LoginR.js">LoginR.js</a>
                           <a href="./Logout.php">Logout.php</a>
                           <a href="./Signup.js">Signup.js</a>
                           <a href="./Signup.php">Signup.php</a>
                           <a href="./SignupR.js">SignupR.js</a>
                     </div>
                  </div>
                  <div class="dropdown">
                     <button class="dropButton">Labs&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                     <div class="dropdownContent">
                           <a href="../Lab01/">Lab 1</a>
                           <a href="../Lab02/">Lab 2</a>
                           <a href="../Lab03/">Lab 3</a>
                           <a href="../Lab04/">Lab 4</a>
                           <a href="../Lab04/signup.html">Lab 4 JS</a>
                           <a href="../Lab05/">Lab 5</a>
                           <a href="../Lab05/signup.html">Lab 5 DOM</a>
                           <a href="../Lab06/">Lab 6</a>
                           <a href="../Lab06/signup.html">Lab 6 DOM2</a>
                           <a href="../Lab07/">Lab 7</a>
                           <a href="../Lab07/200388154-ERD.pdf">Lab 7 ERD</a>
                           <a href="../Lab08/">Lab 8</a>
                           <a href="../Lab08/ljc806.txt">Lab 8 SQL Log</a>
                           <a href="../Lab09/">Lab 9</a>
                           <a href="../Lab09/Signup.html">Lab 9 PHP</a>
                           <a href="./">Lab 10</a>
                           <a href="./index.php">Lab 10 PHP</a>
                           <a href="../Lab11/">Lab 11</a>
                     </div>
                  </div>
                  <div class="dropdown">
                     <button class="dropButton">Assignments&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                     <div class="dropdownContent">
                           <a href="../../Assignments/Assign1/200388154-Assignment1.pdf">Assignment 1</a>
                           <a href="../../Assignments/Assign2/basic_html_pages/mainPage.html">Assignment 2</a>
                           <a href="../../Assignments/Assign3/basic_html_pages/mainPage.html">Assignment 3</a>
                           <a href="../../Assignments/Assign4/basic_html_pages/mainPage.html">Assignment 4</a>
                           <a href="../../Assignments/Assign5/pages/mainPage.php">Assignment 5</a>
                           <a href="../../Assignments/Assign6/">Assignment 6</a>
                     </div>
                  </div>
                  <div class="dropdown">
                     <button class="dropButton">Validations&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                     <div class="dropdownContent">
                        <!--These validations are for the files that are connected to this page-->
                        <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab10/">index.html</a>
                        <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab10/index.php">index.php</a>
                        <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab10/Login.php">Login.php</a>
                        <a href="https://validator.w3.org/check?uri=http://www.webdev.cs.uregina.ca/~ljc806/Labs/Lab10/Signup.php">Signup.php</a>
                     </div>
                  </div>
               </div>
         </nav>
      </header>
      <?php
      //If somebody is logged in, display a welcome message
      if(isset($_SESSION["email"])) {
      ?>

         <h3>Welcome, logged in as: <?=$_SESSION['email']?></h3>	
         <a href='./Logout.php'>Logout</a>

      <?php 
      //If nobody is logged in, display login and signup page.
      } else {	
      ?>

         <h1>Please Login or Sign up</h1>
         
         <p class="buttons">
            <input type="button" onclick="document.location.href='./Login.php'" value="Login"/>
            &nbsp;&nbsp;&nbsp;
            <input type="button" onclick="document.location.href='./Signup.php'" value="Signup"/> 
         </p>

      <?php
      }
      ?>

   </body>
</html>
