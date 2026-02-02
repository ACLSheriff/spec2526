<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if (!isset($_SESSION['userid'])) {//if the user id is not set
    $_SESSION['usermessage'] = "you are not logged in";///checks if user is already logged in and will return message if so
    header("location:index.php");//returns to home page
    exit;//stop further exicution
}

elseif($_SERVER["REQUEST_METHOD"] == "POST"){
//this should be here so if there is a use of headers it can be done so the rest of teh code dosnt load so teh headers will work and change page without errors becuse the header has loaded

    try {
        $tmp = $_POST["appt_date"] . ' ' . $_POST["appt_time"];//cobines it into a single string with a sigle dat and time
        $epoch_time = strtotime($tmp);//converting to epoc time this passing of the veribale is best practice and minimises issues
        if(commit_booking(dbconnect_insert(), $epoch_time)){//trys to commit the booking
            $_SESSION["usermessage"] = "SUCCESS: your booking has been confirmed";// will send user a message confirming
            auditor(dbconnect_insert(),$_SESSION['userid'],"log", "user has booked an appointment". $_SESSION['userid']);//audits that the user has done in the system
            header("Location: bookings.php");//sends user to see there bookings
            exit;
        }else{
            $_SESSION["usermessage"] = "ERROR: something went wrong";//error message if the booking cant commit
        }

    } catch (PDOException $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();//catches any other errors that happen in the prosses
    } catch(Exception $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();
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

echo "<h2> Book appiments </h2>";//heading
echo "<p>  </p>";//paragh of text to instruct


echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

$staff = staff_getter(dbconnect_insert());//gets the staff from the database


echo "<layble for='appt_time'> Appointment time:</lable>";//allows user to input a appointment time
echo "<input type='time' name='appt_time' required>";
echo "<br>";


echo "<layble for='appt_date'> Appointment date:</lable>";//allows user to input the appointment date
echo "<input type='date' name='appt_date' required>";
echo "<br>";
echo "<select name='staff'>";

foreach ($staff as $staf){//will go through each staff member assining them the correct tag if they are a docter or nurse
    if($staf["role"] == "con"){
        $role = "consultant";
    }else if ($staf["role"] == "inst"){
        $role = "installer";
    }
    echo "<option value='".$staf["staff_id"]."'>".$role. " ".$staf["surname"]. " </option>";// allows a menu to show each staff and there details like room number
}
echo "</select>";//lets user select

echo "<br>";

echo "<input type='submit' name='submit' value='Book Appointment'>";//allows them to submit and book appoinment

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function to output messages
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code