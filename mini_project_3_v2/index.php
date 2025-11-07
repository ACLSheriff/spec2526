<?php

session_start();

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> password checker </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assets/topbar.php";// gets and displays the top bar
require_once "assets/nav.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> The importance of strong passwords </h2>";// heading of the page

echo "<br>";// bakes the page for readability
// paragh text saying what the page is about
echo "<p> Strong passwords are essential for protecting personal and sensitive information from unauthorized access.</p>";
echo "<p> They act as the first line of defense against cyber attacks, such as hacking, identity theft, and data breaches. A strong password typically includes a mix of uppercase and lowercase letters, numbers, and special characters, making it difficult for attackers to guess or crack using automated tools.</p>";
echo "<p>  Without strong passwords, individuals and organizations risk compromising their accounts, financial information, and private data, leading to potential financial loss, privacy invasion, and damage to reputation. Therefore, creating and maintaining strong, unique passwords for each account is a crucial step in safeguarding digital security</p>";
echo "<br>";

echo "<img id='text' src='images/lock_blue.png' alt='text' />";// showing an image on the page
echo "<br>";
echo "<br>";// breaks in page to seprate content

echo "<h2> What makes a strong password </h2>";// seccond headding

echo "<br>";// breaks in text for readablity below is paragh text
echo "<p> A strong password is one that is long, complex, and unpredictable. Aim for at least 12 characters, mixing uppercase letters, lowercase letters, numbers, and special symbols like !, @, or #. </p>";
echo "<p> Avoid using easily guessable information such as names, birthdays, or common words. Instead, try using a random combination of letters and numbers or create a passphrase made up of several unrelated words.</p>";
echo "<p>  It’s also important to use unique passwords for different accounts to prevent a single breach from compromising multiple services.</p>";
echo "<p>  Lastly, consider using a reputable password manager to generate and store strong passwords securely, so you don’t have to remember them all yourself.</p>";
echo "<br>";

echo "<h3> The password rules you should check for: </h3>";
echo "<table>";//starts a table
echo "<ul>";//bullit points the list
//these are all items in the list
echo "<li> The number of characters is greater than 8 </li>";//items in list
echo "<li> At least one upper case character </li>";
echo "<li> At least one lower case character </li>";
echo "<li> At least one special character </li>";
echo "<li> At least one number is present </li>";
echo "<li> The first character cannot be a special character </li>";
echo "<li> The last character cannot be the special character </li>";
echo "<li> The word “password” cannot be part of the password </li>";
echo "<li> The first character cannot be a number </li>";
echo "<ul>";// end of list
echo "</table>";//end of table

echo "<br>";
echo "<img id='text' src='images/password_strength.png' alt='text' />";// image for page
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "</body>";// closes the body of code
echo "</html>";// end of html code

?>