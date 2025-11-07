<?php
session_start();

require_once("assests/dbconnect.php");//gets file access
require_once("assests/common.php");


if ($_SERVER["REQUEST_METHOD"] == "POST"){//checking a super globle to see if the request methord is post to call the page
    try{
        new_console(dbconnect_insert(), $_POST);//calls the code funtion
        auditor(dbconnect_insert(),$_SESSION['user'],"log", "console successfully registered");
        $_SESSION['usermessage'] = "SUCESS; Console created!";//formats the result of the code to outputif it works
    }catch (PDOException $e){//catches an error if its not correct
        $_SESSION['usermessage'] = $e->getMessage();//will formatt and print error message
    }
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> games console </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive allows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/nav.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Console register </h2>";//heading
echo "<p> welcome we are so glad your joining us, please fill in the form below </p>";//paragh of text to instruct


echo "<br>";
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='manufacturer' placeholder='manufaturer' </input>";// allows inputs into form
echo "<br>";
echo "<input type='text' name='c_name' placeholder='c_name' <input/>";
echo "<br>";
echo "<input type='text' name='relse_date' placeholder='relse_date' </input>";
echo "<br>";
echo "<input type='number' name='controller_no' placeholder='controller_no' <input/>";
echo "<br>";
echo "<input type='text' name='bit' placeholder='bit' </input>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//button to submit form

echo "</form>";

echo "<br>";


echo "<br>";
echo user_message();//calls the function
echo "<br>";


echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
