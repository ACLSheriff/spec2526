<?php

session_start();

require_once "assests/common.php";

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> enter title </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/nav.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Check your password: </h2>";
echo "<form method = 'post' action = ''> <br>";
echo "<input type = 'text' name = 'pwd' placeholder='password:'>";
echo "<input type = 'submit' name = 'submit' value = 'submit'>";
echo "</form>";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){// this create a form
    echo " " . $_POST['pwd'];// alows a user to enter there name
}
//fuction name ($post[input])

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
