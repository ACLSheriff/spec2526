<?php

session_start();

require_once("assests/dbconnect.php");//gets file access
require_once("assests/common.php");//gets acess to common

if ($_SERVER["REQUEST_METHOD"] == "POST") {//checking a super globle to see if the request methord is post to call the page

    $_POST['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');//fitters any deatilse enterd so no maluses input of SQL
    $_POST['firstname'] = htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8');
    $_POST['surname'] = htmlspecialchars($_POST['surname'], ENT_QUOTES, 'UTF-8');
    $_POST['password'] = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');


    try {
        if (password_streagth($_POST['password'])) {//checks they have set a strong password

            if (!username_check(dbconnect_insert(), $_POST['username'])) {//checks the value returned to see if username id avalible
                if (new_user(dbconnect_insert(), $_POST)) {//commits new user to database
                    auditor(dbconnect_insert(), getnewuserid(dbconnect_insert(), $_POST['username']), "reg", "new user registered");//this logs that a user has registerd and stores in database
                    $_SESSION['usermessage'] = "USER REG SUCCESSFUL";//gives and formats the resutle of the check from common username_check
                } else {
                    $_SESSION['usermessage'] = "ERROR USER REG FAILED ";//if its not aviblibe it prints this error message
                }
            }
        } else {
            $_SESSION['usermessage'] = "ERROR USER REG FAILED ";//catches any other errors that occer and formatt and  outputs them
        }
    } catch (PDOException $e) {
        $_SESSION['usermessage'] = "ERROR USER REG FAILED ". $e->getMessage();
    }

    catch (Exception $e) {
        $_SESSION['usermessage'] = "ERROR USER REG FAILED ". $e->getMessage();
    }
}


echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> booking system </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> User register </h2>";//heading
echo "<p> welcome we are so glad your joining us, please fill in the form below </p>";//paragh of text to instruct


echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='username' placeholder='username' </input>";
echo "<br>";
echo "<input type='text' name='firstname' placeholder='firstname' </input>";//allows intput into form
echo "<br>";
echo "<input type='text' name='surname' placeholder='surname' <input/>";
echo "<br>";
echo "<input type='text' name='password' placeholder='password' </input>";
echo "<br>";
echo "<input type='date' name='d_o_b' placeholder='d_o_b' <input/>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//submit button for form

echo "</form>";//end form

echo "<br>";
echo "<br>";

echo "<h3>We use the details you provide to create and manage your account, verify your identity, and give you secure access to our 
services. </h3>";
echo "<table>";//starts a table
echo "<ul>";//bullit points the list
//these are all items in the list
echo "<li> Username & Password: For secure login. </li>";//items in list
echo "<li> Name: To personalise communication. </li>";
echo "<li> Date of Birth: To confirm eligibility and protect account security. </li>";
echo "<ul>";// end of list
echo "</table>";//end of table
echo "<p> Your information is stored securely and only used to support your experience with our services. </p>";
echo "<br>";

echo "<br>";
echo user_message();//calls the function to show messages to user
echo "<br>";

echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code