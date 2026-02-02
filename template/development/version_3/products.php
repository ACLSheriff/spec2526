<?php

session_start();

require_once "assests/dbconnect.php";//gets file dbconnect
require_once "assests/common.php";


if (!isset($_SESSION['userid'])) {//if the user id is not set
    $_SESSION['usermessage'] = "you are not logged in";///checks if user is already logged in and will return message if so
    header("location:index.php");//returns to home page
    exit;//stop further exicution
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> products </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> brand </h2>";

echo "<br>";
//paragh text
echo "<p> We believe small changes can make a big difference. Green technology helps us live more sustainably </p>";

echo "<br>";

echo "<table id='item1'>";//starts a table for bookings

echo "<tr>";
echo "<td> "."item 1"."</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt is
echo "<td> price : " ." item 1 price". "</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt was made
echo "<td> description : " ." item 1 " . "</td>";//will show the docters surname

echo "</tr>";
echo "</form>";//closes form and table

echo "<br>";

echo "<table id='item2'>";//starts a table for bookings

echo "<tr>";
echo "<td> "."item 2 "."</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt is
echo "<td> price : " ."item 2 ". "</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt was made
echo "<td> description : " ." item 2 " . "</td>";//will show the docters surname

echo "<br>";

echo "<table id='item3'>";//starts a table for bookings

echo "<tr>";
echo "<td> "." item 3"."</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt is
echo "<td> price : " ." item 3 ". "</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt was made
echo "<td> description : " ." item 3 " . "</td>";//will show the docters surname


echo "</tr>";
echo "</form>";//closes form and table

echo "<br>";


echo "</div>";//closes each class
echo "</div>";
echo "</body>";// closes the body of code
echo "</html>";// end of html code
?>