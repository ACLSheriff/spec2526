<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function

    if (isset($_POST['add_user'])) {//if they are deleteing an appoitment
        try {
            if (add_user(dbconnect_insert(), $_POST['house_id'], $_POST['role'], $_POST['longdesc'], $user['user_id'])) {//it will call function to cancel appoinmet
                $_SESSION['message'] = "appointment has been cancelled.";// send message to print saying its been cancelled
            } else {
                $_SESSION['message'] = "appointment could not be cancelled.";//prints that the appoiment could not be cancled if there is an issue
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();//catches an other errors that occur
        } catch (Exception $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
        }
    }elseif(isset($_POST['add_room'])){//if they want to change the appoimnet
       header("location: add_room.php");
       exit;
       }
    }elseif (isset($_POST['veiw_rooms'])) {
        header("location:veiw_rooms.php");
        exit;

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
        echo "<p> users role: ".$role." description: ". $detail["longdesc"]."</p>";
    }


echo "<tr>";
echo "<td> Date added:" . $detail['reg_date'] . "</td>";//showing users when the house was registered with a premade format ( if epoch time i would formatt this but not formatting as stored as date
echo "<td> your previlages: " . $role . " </td>";//will show the users role for that house
echo "<td> address: " . $detail['address'] . "</td>";//show house address
echo "<td><input type='hidden' name='appid' value='" . $detail['house_id'] . "'>;

    <input type='submit' name='add_room' value='add room' />
    <input type='submit' name='veiw_rooms' value='veiw rooms'</td>";

if ($detail['role'] == "owner") {
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
