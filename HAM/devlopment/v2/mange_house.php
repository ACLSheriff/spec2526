<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function

    if (isset($_POST['add_room'])) {//if they are deleteing an appoitment
        try {
            if (remove_house(dbconnect_insert(), $_POST['house_id'])) {//it will call function to cancel appoinmet
                $_SESSION['message'] = "appointment has been cancelled.";// send message to print saying its been cancelled
            } else {
                $_SESSION['message'] = "appointment could not be cancelled.";//prints that the appoiment could not be cancled if there is an issue
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();//catches an other errors that occur
        } catch (Exception $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
        }
    }elseif(isset($_POST['transfer_house'])){//if they want to change the appoimnet
        header("location:change_booking.php");//sends the user to the change booking page
        exit;//exits page
    }elseif (isset($_POST['mange_house'])) {
        header("location:mange_house.php");
        exit;
    }
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> profile </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Your profile </h2>";//heading

$details = house_getter(dbconnect_insert(), $_SESSION['userid']);


echo "<p> details </p>";
echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

    foreach($details as $detail) {// split each appiment to show sepratly and formmat the appoimnet details together
        if ($detail['role'] = "owner") {//adulet ticket, child ticket, family ticket, educational ticket
            $role = "owner";
        } else if ($detail['role'] = "edit") {
            $role = "editing";
        } else if ($detail['role'] = "veiw") {
            $role = "veiwer";
        }
        echo "<p> users role: ".$role." description: ". $details["longdesc"]."</p>";
    }


echo "<tr>";
echo "<td> Date added:" . date('M d, Y @ h:i A', $details['reg_date']) . "</td>";//showing users when the house was registered with a premade format
echo "<td> your previlages: " . $role . " " . $details['role'] . "</td>";//will show the users role for that house
echo "<td> address: " . $details['address'] . "</td>";//show house address
echo "<td><input type='hidden' name='appid' value='" . $details['house_id'] . "'>;

    <input type='submit' name='add_room' value='add room' />
    <input type='submit' name='veiw_rooms' value='veiw rooms'</td>";

if ($details['role'] == "owner") {
    echo "<tr>";
    $users = get_users(dbconnect_insert());
        if(!$details){
            echo "no users available!";
        } else {
            echo "<select name='gift_select'>";
            foreach ($users as $user) {
                echo "<option value='" . $user['firstname'] . "'>" . $user['surname'] . "</option>";
            }

            echo "</select>";
        }
        echo "<input type='text' name='role' placeholder='role' <input/>";
        echo "<br>";
        echo "<input type='submit' name='longdesc' placeholder='longdesc' />";//submit button for form

        echo "<td><input type='submit' name='add_user' value='add a user'</td>";
}

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
