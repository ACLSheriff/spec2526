<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if (!isset($_SESSION['user_id'])) {//if the user id is not set
    $_SESSION['usermessage'] = "you are not logged in";///checks if user is already logged in and will return message if so
    unset($_SESSION['appid']);//unsets the appitmnet id
    header("location:index.php");//returns to home page
    exit;//stop further exicution

} elseif($_SERVER["REQUEST_METHOD"] == "POST") {//when form is submitted
//this should be here so if there is a use of headers it can be done so the rest of teh code dosnt load so teh headers will work and change page without errors becuse the header has loaded
    if (isset($_POST['remove_house'])) {//if they are deleteing an appoitment
        try {
            if (remove_house(dbconnect_insert(), $_SESSION['house_id'])) {//it will call function to cancel appoinmet
                $_SESSION['message'] = "house has been removed.";// send message to print saying its been cancelled
                header("location:veiw_houses.php");
                exit;
            } else {
                $_SESSION['message'] = "house could not be removed.";//prints that the appoiment could not be cancled if there is an issue
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();//catches an other errors that occur
        } catch (Exception $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
        }
    }elseif(isset($_POST['transfer_house'])){//if they want to change the appoimnet
        header("location:transfer_owner.php");//sends the user to the change booking page
        exit;//exits page
    }elseif (isset($_POST['mange_house'])) {
        $_SESSION['house_id'] = $_POST['house_id'];
        header("location:mange_house.php");
        exit;
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

$houses = house_getter(dbconnect_insert(),$_SESSION['user_id']);//getting appoiments from databas
if(!$houses){//if there are no appoiments it will tell the user
    echo "no houses found";
}else{

    echo "<table id='houses'>";//starts a table for bookings

    foreach($houses as $house) {// split each appiment to show sepratly and formmat the appoimnet details together
        if ($house['role'] = "owner") {//adulet ticket, child ticket, family ticket, educational ticket
            $role = "owner";
        } else if ($house['role'] = "edit") {
            $role = "editing";
        } else if ($house['role'] = "veiw") {
            $role = "veiwer";
        }

        echo "<form action='' method='post'>";// creating a form per row of the table for each appinment

        echo "<tr>";
        echo "<td> Date added:" . $house['reg_date'] . "</td>";//showing users when the house was registered with a premade format ive already stored the date as a date so its not need to be formatted
        echo "<br>";
        echo "<td> your previlages: " . $role . "</td>";//will show the users role for that house
        echo "<br>";
        echo "<td> address: " . $house['address'] . "</td>";//show house address
        echo "<br>";
        echo "<td><input type='hidden' name='house_id' value='" . $house['house_id'] . "'></td>";
        if ($house['role'] == "owner"){
        echo "<tr>";
        echo "<td><input type='submit' name='remove_house' value='remove house' />
        <input type='submit' name='transfer_house' value='transfer house'/>
        <input type='submit' name='mange_house' value='mange house'</td>";
        } else if ($house['role'] == "editing"){
            echo "<tr>";
            echo "<td><input type='submit' name='mange_house' value='mange house' </td>";
        }
        //set the value without needed to input, allows user to submit and change

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