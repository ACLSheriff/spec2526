<?php


if (!isset($_GET['message'])) {//checks if message is set
    session_start();//will allow session to start
    $message = false;//and send a message
} else {//error handle
    $message = htmlspecialchars(urldecode($_GET["message"]));//will decode message into string
}

require_once "assests/dbconnect.php";//gets file dbconnect
require_once "assests/common.php";

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> home page </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h1> north pole inc </h1>";

echo "<br>";
echo "<br>";

//paragh text
echo "<p> santas system to make sure you get your wishes, </p>";
echo "<p> tell us what you want and mange your account, </p>";
echo "<p> the elfs will have it made and santa will deliver for christmas </p>";

echo "<br>";//breaks for readablity

//echo "<img id='text' src='images/text.jfif' alt='text' />";

echo "<br>";


if (!$message) {//checks message
    echo user_message();//print out message from subroutine
} else {
    echo $message;//prints message
}


try {//error handle
    $conn = dbconnect_insert();
    echo "succsess";//if it works prints succsess message
} catch (PDOException $e) {//catches any other error
    echo $e->getMessage();
}

echo "</div>";//closes each class
echo "</div>";
echo "</body>";// closes the body of code
echo "</html>";// end of html code
