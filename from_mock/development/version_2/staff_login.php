<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/staff_common.php";


if (isset($_SESSION['staff_id'])) {
    $_SESSION['s_usermessage'] = "you are already logged in";///checks if user is already logged in and will return message if so
    header("location:s_index.php");//returns to home page
    exit;//stop further exicution
}

elseif ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function

    $usr = s_login(dbconnect_insert(),$_POST);//calls login fuction

    if($usr && password_verify($_POST['password'],$usr['password'])){// checking the username and password match and is present
        $_SESSION['staff_id'] = $usr["staff_id"];//sets and store user id
        $_SESSION['s_usermessage'] = "SUCCESSFULLY LOGGED IN";//success message

        header("location:staff_bookings.php");//send back to home page
        exit;//exits page ends code
    }elseif (!$usr){
        $_SESSION['s_usermessage'] = "ERROR:user not found";
        header("location:staff_login.php");
        exit;
    }else{//if username isnt valid
        $_SESSION["s_usermessage"] = "INVALID USERNAME OR PASSWORD";//send error mesasge to be printed
        header("location:staff_login.php");//gose back to login page
        exit;//ends code
    }
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> staff login </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/staff_navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> staff Login </h2>";//heading
echo "<p> welcome back </p>";//paragh of text to instruct

echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='username' placeholder='username' </input>";//allows intput into form
echo "<br>";
echo "<input type='text' name='password' placeholder='password' </input>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//submit button for form

echo "</form>";//end form

echo "<br>";
echo s_usermessage();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code