<?php

session_start();

require_once__DIR__ . "assests/dbconnect.php";
require_once__DIR__ . "assests/common.php";

if (isset($_SESSION['user'])) {
    $_SESSION['usermessage'] = "you are already logged in";///checks if user is already logged in and will return message if so
    header("location:index.php");//returns to home page
    exit;//stop further exicution
}

elseif ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function
    $usr = login(dbconnect_insert(),$_POST);//calls login fuction

    if($usr && password_verify($_POST["password"],$usr["password"])){// checking the username and password match and is present
        $_SESSION["user"] = true;//sets up the session veriable
        $_SESSION['user_id'] = $usr["user_id"];//sets and store user id
        $_SESSION['usermessage'] = "SUCCESSFULLY LOGGED IN";//success message
        auditor(dbconnect_insert(),$_SESSION['user'],"log", "user has successfully logged in");
        header("location:index.php");//send back to home page
        exit;//exits page ends code
    }else{//if username isnt valid
        $_SESSION["usermessage"] = "INVALID USERNAME OR PASSWORD";//send error mesasge to be printed
        header("location:login.php");//gose back to login page
        exit;//ends code
    }
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> games console </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/nav.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Login </h2>";//heading
echo "<p> welcome we are so glad your joining us, please fill in the form below </p>";//paragh of text to instruct


echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='username' placeholder='username' </input>";//allows intput into form
echo "<br>";
echo "<input type='text' name='password' placeholder='password' </input>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//submit button for form

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
