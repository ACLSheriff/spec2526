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
        $epoch_time = date('Y-m-d', time());//converting to epoc time this passing of the veribale is best practice and minimises issues
        if (add_house(dbconnect_insert(), $epoch_time)) {
            $house_id = get_house_id(dbconnect_insert());
            echo "house id ".$house_id."<br>";
            //$userid = $_SESSION['userid'];
            if (add_house_reg(dbconnect_insert(), $_SESSION['userid'] , $house_id)) {//trys to commit the house
                $_SESSION["usermessage"] = "SUCCESS: your house has been added";// will send user a message confirming
                header("Location: veiw_house.php");//sends user to see there bookings
                exit;
            } else {
                $_SESSION["usermessage"] = "ERROR: something went wrong";//error message if the booking cant commit
            }
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

echo "<title> add house </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> add house </h2>";//heading
echo "<p>  </p>";//paragh of text to instruct


echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='address' placeholder='address' </input>";
echo "<br>";
echo "<input type='text' name='street' placeholder='street' </input>";//allows intput into form
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
