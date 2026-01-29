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
    if (isset($_POST['delete'])) {//if they are deleteing an appoitment
        try {
            if (cancel_booking(dbconnect_insert(), $_POST['bookingid'])) {//it will call function to cancel appoinmet
                $_SESSION['message'] = "appointment has been cancelled.";// send message to print saying its been cancelled
            } else {
                $_SESSION['message'] = "appointment could not be cancelled.";//prints that the appoiment could not be cancled if there is an issue
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();//catches an other errors that occur
        } catch (Exception $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
        }
    }elseif(isset($_POST['change'])){//if they want to change the appoimnet
        $_SESSION['bookingid'] = $_POST['bookingid'];//puts the appointment id in post
        header("location:change_ticket.php");//sends the user to the change booking page
        exit;//exits page
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

echo "<h2> Your Bookings </h2>";//heading

echo "<br>";
echo user_message();//calls the function
echo "<br>";

$tickets = bookings_getter(dbconnect_insert());//getting appoiments from database
if(!$tickets){//if there are no appoiments it will tell the user
    echo "no bookings found";
}else{

    echo "<table id='bookings'>";//starts a table for bookings

    foreach($tickets as $ticket) {// split each appiment to show sepratly and formmat the appoimnet details together
        $price = ($ticket['price'] * $ticket['discount_amount']) * $ticket['amount'];

        echo "<form action='' method='post'>";// creating a form per row of the table for each appinment

        echo "<tr>";
        echo "<td> Date:" . date('M d, Y ', $ticket['date']) . "</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt is
        echo "<td> type: " . $ticket['type'] . "</td>";//will show the docters surname
        echo "<td> overall price: £" . $price . "</td>";
        echo "<td> amount: " . $ticket['amount'] . "</td>";
        echo "<td><input type='hidden' name='bookingid' value='" . $ticket['booking_id'] . "'>
        <input type='submit' name='delete' value='cancel ticket' />
        <input type='submit' name='change' value='change ticket'/></td>";//set the value without needed to input, allows user to submit and change

        echo "</tr>";
        echo "</form>";//closes form and table

    }
}

echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code