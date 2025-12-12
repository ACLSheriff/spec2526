<?php

session_start();

require_once("assests/dbconnect.php");//gets file access
require_once("assests/staff_common.php");//gets acess to common

if ($_SERVER["REQUEST_METHOD"] == "POST") {//checking a super globle to see if the request methord is post to call the page

    $_POST['type'] = htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8');
    $_POST['quantity'] = htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'UTF-8');
    $_POST['price'] = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');

    try {

            if (new_ticket(dbconnect_insert(), $_POST)) {//commits new user to database
                $_SESSION['s_usermessage'] = "USER REG SUCCESSFUL";//gives and formats the resutle of the check from common username_check
            } else {
                $_SESSION['s_usermessage'] = "ERROR USER REG FAILED ";//if its not aviblibe it prints this error message
            }


    } catch (PDOException $e) {
        $_SESSION['s_usermessage'] = "ERROR USER REG FAILED ". $e->getMessage();
    }

    catch (Exception $e) {
    $_SESSION['s_usermessage'] = "ERROR USER REG FAILED " . $e->getMessage();
}
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> staff register </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> staff register </h2>";//heading
echo "<p> welcome we are so glad your joining us, please fill in the form below </p>";//paragh of text to instruct


echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='type' placeholder='type' </input>";
echo "<br>";
echo "<input type='text' name='quantity' placeholder='quantity' </input>";//allows intput into form
echo "<br>";
echo "<input type='text' name='price' placeholder='price' <input/>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//submit button for form

echo "</form>";//end form


echo "<br>";
echo s_usermessage();//calls the function to show messages to user
echo "<br>";

echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code