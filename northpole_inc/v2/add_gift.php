<?php


session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if (!isset($_SESSION['userid'])) {//if the user id is not set stops them accessing page for security
    $_SESSION['usermessage'] = "you are not logged in";///checks if user is already logged in and will return message if so
    unset($_SESSION['appid']);// usets the appoimnet id
    header("location:index.php");//returns to home page
    exit;//stop further exicution
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
//this should be here so if there is a use of headers it can be done so the rest of teh code dosnt load so teh headers will work and change page without errors becuse the header has loaded

    try {
        $tmp = $_POST["apt_date"] . ' ' . $_POST["apt_time"];//cobines it into a single string with a sigle dat and time
        $epoch_time = strtotime($tmp);//converting to epoc time this passing of the veribale is best practice and minimises issues
        if (appt_update(dbconnect_insert(), $_SESSION['apptid'], $epoch_time)) {//trys to update appoiment and change in database
            $_SESSION["usermessage"] = "SUCCESS: your booking has been confirmed";//user message telling them that the appoimnet was changed
            auditor(dbconnect_insert(), $_SESSION['userid'], "log", "user has changed an appointment" . $_SESSION['userid']);//audits that the user has changed an appoimnet
            header("Location: bookings.php");// sends back to booking page
            exit;
        } else {
            $_SESSION["usermessage"] = "ERROR: something went wrong";// error message if it cant be changed
            header("Location: bookings.php");//sends back to booking page
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();//catches any other errors
    } catch (Exception $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();
    }
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> change booking </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Change booking </h2>";//heading

echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form


echo "<br>";

echo "<input type='submit' name='submit' value='Update Appointment'>";//allows user to update appoimnet

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code