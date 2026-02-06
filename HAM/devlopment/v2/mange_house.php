<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function

    if (isset($_POST['add_user'])) {//if they are deleteing an appoitment
        try {
            if (add_user(dbconnect_insert(), $_POST['house_id'], $_POST['role'], $_POST['longdesc'], $_POST['user_select'])) {//it will call function to cancel appoinmet
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
    }elseif (isset($_POST['remove_room'])) {
        try{
            if(remove_room(dbconnect_insert(), $_POST['room_id'])) {
                $_SESSION['message'] = "room has been cancelled.";
            }else{
                $_SESSION['message'] = "room could not be cancelled.";
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
        } catch (Exception $e) {
            $_SESSION['message'] = "ERROR: " . $e->getMessage();
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

echo "<h2> mange houses </h2>";//heading

try {
    $details = house_for_user_getter(dbconnect_insert(), $_SESSION['house_id'], $_SESSION['user_id']);
} catch (PDOException $e) {
    $_SESSION['message'] = "ERROR: " . $e->getMessage();//catches an other errors that occur
} catch (Exception $e) {
    $_SESSION['message'] = "ERROR: " . $e->getMessage();
}

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

echo "<br>";

echo "<tr>";
echo "<td> Date added:" . $detail['reg_date'] . "</td>";//showing users when the house was registered with a premade format ( if epoch time i would formatt this but not formatting as stored as date
echo "<br>";
echo "<td> your previlages: " . $role . " </td>";//will show the users role for that house
echo "<br>";
echo "<td> address: " . $detail['address'] . "</td>";//show house address
echo "<br>";
echo "<td><input type='hidden' name='house_id' value='" . $_SESSION['house_id'] . "'</td>";

echo "<br>";
echo "<br>";

if ($detail['role'] == "owner") {
    echo "<tr>";
    $users = get_users(dbconnect_insert());
        if(!$users){
            echo "no users available!";
        } else {
            echo "<select name='user_select'>";
            foreach ($users as $user) {
                echo "<option value=" . $user['user_id'] . ">" . $user['firstname'] . "  " . $user['surname'] . "</option>";
            }
            echo "</select>";
        }
        echo "<br>";
        echo "<input type='text' name='role' placeholder='role' <input/>";
        echo "<br>";
        echo "<input type='text' name='longdesc' placeholder='longdesc' />";//submit button for form
        echo "<br>";

        echo "<td><input type='submit' name='add_user' value='add a user'</td>";
        echo "<br>";

}

try {
    echo "<tr>";
    $rooms = room_getter(dbconnect_insert(), $_SESSION['house_id']);
    if(!$rooms){
        echo "no rooms available!";
    } else {
        foreach ($rooms as $room) {
            echo "<option value=" . $room['room_id'] . ">". "room name:" . $room['room_name'] . "  floor:" . $room['floor'] . "</option>";
            echo "<td><input type='submit' name='remove_room' value='remove room'</td>";
        }
    }
    echo "<br>";

    echo "<td><input type='submit' name='add_room' value='add a room'</td>";
    echo "<br>";

}catch (PDOException $e) {
    $_SESSION['message'] = "ERROR: " . $e->getMessage();
}catch (Exception $e) {
    $_SESSION['message'] = "ERROR: " . $e->getMessage();
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
