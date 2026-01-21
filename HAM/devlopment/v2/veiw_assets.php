<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if (!isset($_SESSION['userid'])) {//if the user id is not set
    $_SESSION['usermessage'] = "you are not logged in";///checks if user is already logged in and will return message if so
    unset($_SESSION['appid']);//unsets the appitmnet id
    header("location:index.php");//returns to home page
    exit;//stop further exicution

} elseif($_SERVER["REQUEST_METHOD"] == "POST") {//when form is submitted
//this should be here so if there is a use of headers it can be done so the rest of teh code dosnt load so teh headers will work and change page without errors becuse the header has loaded
    if (isset($_POST['add_assest'])) {//if they are deleteing an appoitment
        try {
            if (add_assets(dbconnect_insert(), $_POST['house_id'])) {//it will call function to cancel appoinmet
                $_SESSION['message'] = "appointment has been cancelled.";// send message to print saying its been cancelled
            } else {
                $_SESSION['message'] = "appointment could not be cancelled.";//prints that the appoiment could not be cancled if there is an issue
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();//catches an other errors that occur
        } catch (Exception $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
        }
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

echo "<h2> Your houses </h2>";//heading

echo "<br>";
echo user_message();//calls the function
echo "<br>";

$rooms = assets_getter(dbconnect_insert(), $_SESSION['room_id']);//getting appoiments from databas
if(!$rooms){//if there are no appoiments it will tell the user
    echo "no houses found";
}else{

    echo "<table id='houses'>";//starts a table for bookings

    foreach($rooms as $room) {// split each appiment to show sepratly and formmat the appoimnet details together

        echo "<form action='' method='post'>";// creating a form per row of the table for each appinment

        echo "<tr>";
        echo "<td> room name:" . $room['room_name'] . "</td>";//showing users when the house was registered with a premade format ive already stored the date as a date so its not need to be formatted
        echo "<br>";
        echo "<td> floor: " . $room['floor'] . "</td>";//show house address
        echo "<br>";
        echo "<td><input type='hidden' name='appid' value='" . $room['room_id'] . "'></td>";

        echo "<td><input type='submit' name='remove_room' value='remove room' />
        <input type='submit' name='veiw_assets' value='veiw and add assets'/>
        <input type='submit' name='mange_house' value='mange house'</td>";
        //set the value without needed to input, allows user to submit and change

        echo "</tr>";
        echo "</form>";//closes form and table

        echo "<td><input type='submit' name='add_room' value='add room' </td>";

    }

}

echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code