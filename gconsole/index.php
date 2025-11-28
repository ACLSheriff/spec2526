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
require_once "assests/nav.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Games Consoles </h2>";

echo "<br>";
//paragh text
echo "<p> Looking for the ultimate gaming experience? Game consoles offer powerful performance, exclusive games, and easy plug-and-play fun for all ages. </p>";
echo "<p> Whether you're into solo adventures, online battles, or family game nights, a console is your all-in-one entertainment hub. </p>";

echo "<br>";

echo "<table>";//starts a table
echo "<ul>";//bullit points the list
//these are all items in the list
echo "<h3> We offer:  </h3>";//head of list
echo "<br>";
echo "<li> nintendos switch </li>";//items in list
echo "<li> switch 2 </li>";
echo "<li> Xbox 2 </li>";
echo "<li> Xbox serise X </li>";
echo "<li> playstation 1&2 </li>";
echo "<ul>";
echo "</table>";//end of table

echo "<br>";
echo "<br>";//breaks for readablity

//echo "<img id='text' src='images/text.jfif' alt='text' />";  #sets a logo up

echo "<br>";

if (!$message) {//checks message
    echo user_message();//print out message from subroutine
}else {
    echo $message;//prints message
}


try{//error handle
    $conn = dbconnect_insert();
        echo "succsess";//if it works prints succsess message
} catch (PDOException $e) {//catches any other error
    echo $e->getMessage();
}

echo "</div>";//closes each class
echo "</div>";
echo "</body>";// closes the body of code
echo "</html>";// end of html code
?>