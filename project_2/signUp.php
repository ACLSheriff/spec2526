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

echo "<h2> Sign Up! </h2>";//heading
echo "<p class='content'> welcome we are so glad your joining us, please fill in the form below </p>";//paragh of text to instruct

if ($_SERVER['REQUEST_METHOD'] === 'POST'){  #selection statement to ensure POST has been used (submit button on a form)
    echo "Your name: " . $_POST['name'];  # uses the full stop to concatenate the text and the post value from the form
    echo "<br>";
    echo "Your email: "  . $_POST['email'];
    echo "<br>";
    echo "Your password: "  . $_POST['pwd'];
    echo "<br>";
    echo "Your date of birth: "  . $_POST['date'];
    echo "<br>";
    echo "Your subject choice: "  . $_POST['subject'];
    echo "<br>";
    echo "Level of study: "  . $_POST['level'];
}

echo "<br>";
echo "<form method='post' action=''>"; //this creates the form
echo "<table>";// creates a table to lay out the input boxes
echo "<tr><input type='text' name='name' placeholder='Name' /><input type='email' name='email' placeholder='Email' /></tr>";
//these are put into a table and allows the user to input a type of data of whats required
echo "<tr><input type='date' name='date' placeholder='Date of birth'  /> <input type='password' name='pwd' placeholder='Password'/></tr>";

echo "<tr><input type='text' name='subject' placeholder='Subject' /><input type='text' name='level' placeholder='Level' /></tr>";

echo "<tr><input type='submit' name='submit' value='submit' /></tr>";// this allows the user to submit the form

echo "</table>";//end of table and form
echo "</form>";


echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
