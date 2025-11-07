<?php

session_start();

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> enter title </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<br>";
echo "<form method='post' action=''>";//creates the form
echo "<input type='text' name='email' placeholder='Email' />";// allows users to enter the seten type of data asked for
echo "<br>";//breaks to make it more readable
echo "<input type='text' name='name' placeholder='name' />";
echo "<br>";
echo "<input type='text' name='url' placeholder='url' />";
echo "<br>";
echo "<input type='number' name='age' placeholder='age' />";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//button to submit form
echo "</form>";
echo "<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){  #selection statement to ensure POST has been used (submit button on a form)
    echo "enter your email: ";  # uses the full stop to concatenate the text and the post value from the form
    echo filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    echo "<br>";
    echo "enter your name: ";
    echo filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    echo "<br>";
    echo " enter your age: ";
    echo filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
    echo "<br>";
    echo " enter your url: ";
    echo filter_var($_POST['url'], FILTER_SANITIZE_URL);
}

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
?>