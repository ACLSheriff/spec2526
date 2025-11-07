<?php

    echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> enter title </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topBar.php";// gets and displays the top bar
require_once "assests/nav_bar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Welcome Back! </h2>";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){  #selection statement to ensure POST has been used (submit button on a form)
    echo "enter your email: "  . $_POST['email'];  # uses the full stop to concatenate the text and the post value from the form
    echo "<br>";
    echo "enter your password: "  . $_POST['pwd'];
    echo "<br>";
    echo "confirm password: "  . $_POST['pwd2'];
}

echo "<br>";
echo "<form method='post' action=''>";//creates the form
echo "<input type='email' name='email' placeholder='Email' />";// allows users to enter the seten type of data asked for
echo "<br>";//breaks to make it more readable
echo "<input type='password' name='pwd' placeholder='Password' />";
echo "<br>";
echo "<input type='password' name='pwd2' placeholder='Confirm Password' />";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//button to submit form

echo "</form>";//end of form


echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
