<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function

    $surname = htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');

    try {
        if (profile_update(dbconnect_insert(), $_POST, $surname, $address)) {
            auditor(dbconnect_insert(), $_SESSION['userid'], "log", "user has changed deatials" . $_SESSION['userid']);//this logs that a user has registerd and stores in database
            $_SESSION['usermessage'] = "USER details change";//gives and formats the resutle of the check from common username_check
        } else {
            $_SESSION['usermessage'] = "ERROR details not changed ";//if its not aviblibe it prints this error message
        }


    } catch (PDOException $e) {
        $_SESSION['usermessage'] = "ERROR details not changed " . $e->getMessage();
    } catch (Exception $e) {
        $_SESSION['usermessage'] = " ERROR details not changed " . $e->getMessage();
    }

}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> profile </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Your profile </h2>";//heading

$details = profile_featch(dbconnect_insert(), $_SESSION["userid"]);

echo "<p> change your details </p>";
echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<layble for='surname'> surname:</lable>";
echo "<input type='text' name='surname'  value='".$details['surname']."' required>";//pulled in data from database and showing user what they have picked
echo "<br>";

echo "<layble for='address'> address:</lable>";
echo "<input type='text' name='address'  value='".$details['address']."' required>";//pulled in data from database and showing user what they have picked
echo "<br>";
echo "<input type='submit' name='submit' value='update details' />";//submit button for form

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code