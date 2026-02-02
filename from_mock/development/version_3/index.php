<?php

require_once "assests/dbconnect.php";//gets file dbconnect
require_once "assests/common.php";


if (!isset($_GET['message'])) {//checks if message is set
    session_start();//will allow session to start
    $message = false;//and send a message
} else {//error handle
    $message = htmlspecialchars(urldecode($_GET["message"]));//will decode message into string
}


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



echo "<br>";

echo "<h1> brand  </h1>";

if (!$message) {//checks message
    echo user_message();//print out message from subroutine
}else {
    echo $message;//prints message
}

echo "<br>";
echo "<br>";

//paragh text
echo "<p>text </p>";
echo "<p> text </p>";
echo "<p> text </p>";
echo "<p> text </p>";

echo "<br>";

echo "<h3> Here are a few simple ways: </h3>";
echo "<table>";//starts a table
echo "<ul>";//bullit points the list
//these are all items in the list
echo "<li> 1 </li>";//items in list
echo "<li> 2 </li>";
echo "<li> 3 </li>";
echo "<li> 4 </li>";
echo "<li> 5 </li>";
echo "<ul>";// end of list
echo "</table>";//end of table

echo "<br>";

echo "<p> hi </p>";
echo "<h3> link: </h3>";
$url = "https://mackaycarboncalculator.energysecurity.gov.uk/overview/emissions-and-primary-energy-consumption/?levers=111111111111122211111111111111111111111111111aaabaaabaaabaaaaaaaaaaaabbabbbcbbaabcaabbaaaagggggggggggggeggggggggggiggiiiqgdgggggggggkgg";
echo "<a href='$url'> link name </a>";


//echo "<img id='text' src='images/.webp' alt='text' />";

echo "<br>";


echo "</div>";//closes each class
echo "</div>";
echo "</body>";// closes the body of code
echo "</html>";// end of html code
?>