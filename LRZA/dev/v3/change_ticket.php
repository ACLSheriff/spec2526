<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if (!isset($_SESSION['userid'])) {//if the user id is not set stops them accessing page for security
    $_SESSION['usermessage'] = "you are not logged in";///checks if user is already logged in and will return message if so
    unset($_SESSION['appid']);// usets the appoimnet id
    header("location:index.php");//returns to home page
    exit;//stop further exicution
}

elseif($_SERVER["REQUEST_METHOD"] == "POST"){
//this should be here so if there is a use of headers it can be done so the rest of teh code dosnt load so teh headers will work and change page without errors becuse the header has loaded

    $_POST['amount'] = htmlspecialchars($_POST['amount'], ENT_QUOTES, 'UTF-8');
    $_POST['discount_code'] = htmlspecialchars($_POST['discount_code'], ENT_QUOTES, 'UTF-8');

    try {
        $tmp = $_POST["date"];//cobines it into a single string with a sigle dat and time
        $epoch_date = strtotime($tmp);//converting to epoc time this passing of the veribale is best practice and minimises issues
        $avaliblity = check_avalible(dbconnect_insert(), $_POST['amount'], $epoch_date, $_POST['ticket_id']);
        if (!$avaliblity) {
            $_SESSION["usermessage"] = "ERROR: avaliblity not valid";
            header("Location: book.php");
        } else {
            if (ticket_update(dbconnect_insert(), $epoch_date, $_POST['ticket_select'], $_POST['amount'])) {//trys to commit the booking
                $_SESSION["usermessage"] = "SUCCESS: your booking has been confirmed";// will send user a message confirming
                auditor(dbconnect_insert(),$_SESSION['userid'],"log", "user has changed a ticket". $_SESSION['userid']);//audits that the user has changed a
                header("Location: bookings.php");//sends user to see there bookings
                exit;
            } else {
                $_SESSION["usermessage"] = "ERROR: something went wrong";//error message if the booking cant commit
            }
        }
    }catch
    (PDOException $e) {
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

echo "<h2> Change booking </h2>";//heading

try {
    $booking = fetch_ticket(dbconnect_insert(), $_SESSION["booking_id"]);//gets the appoimnet id and stores in veriable
}catch (Exception $e){
    $_SESSION["usermessage"] = "Error: " . $e->getMessage();
    header("Location: change_bookings.php");
    exit;
}catch (PDOException $e){
    $_SESSION["usermessage"] = "Error: " . $e->getMessage();
    header("Location: change_bookings.php");
    exit;
}

echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

try {
    $ticket = ticket_getter(dbconnect_insert());//gets the staff from the database
}catch (PDOException $e){
    $_SESSION["usermessage"] = "ERROR: something went wrong";
}


if(!$ticket){
    echo "no tickets available!";
} else {

    echo "<select name='ticket_select'>";
    foreach ($ticket as $tickets) {
        echo "<option value=" . $tickets['ticket_id'] . ">". "type: " . $tickets['type'] . "   price: £" . $tickets['price'] . "</option>";
        echo $tickets['ticket_id'];
    }

    echo "</select>";
}

echo "<br>";


echo "<layble for='amount'> amount:</lable>";//shows appoimnet date
echo "<input type='number' name='amount' value='".$booking["amount"]."' required>";

echo "<br>";


$date = date('Y-m-d', $booking['date']);//formatts the epoc date they had


echo "<layble for='date'> date:</lable>";//shows appoimnet date
echo "<input type='date' name='date' value='".$date."' required>";//pulls from database showing the user what date they picked
echo "<br>";


echo "<input type='submit' name='submit' value='Update ticket'>";//allows user to update appoimnet

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
