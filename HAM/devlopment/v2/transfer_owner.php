<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";



if ($_SERVER["REQUEST_METHOD"] === "POST"){
//this should be here so if there is a use of headers it can be done so the rest of teh code dosnt load so teh headers will work and change page without errors becuse the header has loaded

    try {
        if(owner_update(dbconnect_insert(),$_SESSION['user_id'])){//trys to update appoiment and change in database
            $_SESSION["usermessage"] = "SUCCESS: your booking has been confirmed";//user message telling them
            header("Location: veiw_house.php");// sends back to booking page
            exit;
        }else{
            $_SESSION["usermessage"] = "ERROR: something went wrong";// error message if it cant be changed
            header("Location: veiw_house.php");//sends back to booking page
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION["usermessage"] = "Error: " . $e->getMessage();//catches any other errors
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

echo "<h2> Change owner </h2>";//heading

echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form
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
echo "<br>";

echo "<td><input type='submit' name='transfer_owner' value='transfer'</td>";
echo "<br>";



echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code
