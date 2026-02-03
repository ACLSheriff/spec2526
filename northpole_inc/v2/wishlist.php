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
    if(isset($_POST['addgift'])){  // if they have clicked to wish for a gift
        try{
            if(add_wish(dbconnect_insert(), $_POST['gift_select'], $_SESSION["userid"])){  // try to cancel it
                auditor(dbconnect_insert(), $_SESSION['userid'], "WGT", "Wished for a new gift");  // audit the cancellation
                $_SESSION['usermessage'] = "SUCCESS: You have wished for a new gift";  // Sets a user message
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            } else {
                $_SESSION['usermessage'] = "ERROR: Something went wrong!";
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            }

        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        }
    } elseif (isset($_POST['giftaddandwish'])) {  // if the change appointment button was used
        try{
            if(add_gift(dbconnect_insert(),$_POST)){
                $giftid = get_new_gift(dbconnect_insert());
                if(add_wish(dbconnect_insert(), $giftid['giftid'], $_SESSION["userid"])){
                    auditor(dbconnect_insert(),$_SESSION['userid'],"GRG", "Registered a new gift to the system");
                    auditor(dbconnect_insert(), $_SESSION['userid'], "WGT", "Wished for a new gift");  // audit the cancellation
                    $_SESSION['usermessage'] = "SUCCESS: You have wished for a new gift";  // Sets a user message
                    header('Location: wishlist.php');  // redirects them
                    exit;  // ensures no other code executes
                } else {
                    $_SESSION['usermessage'] = "ERROR: Something went wrong!";
                    header('Location: wishlist.php');  // redirects them
                    exit;  // ensures no other code executes
                }
            }
        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        }

    }elseif(isset($_POST['wishdelete'])){
        try{
            if(remove_wish(dbconnect_insert(),$_POST['wishid'])){
                auditor(dbconnect_insert(),$_SESSION['userid'],"removeWish", "removed wished item");
                $_SESSION['usermessage'] = "SUCCESS: You have removed a wished gift";  // Sets a user message
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            } else {
                $_SESSION['usermessage'] = "ERROR: Something went wrong!";
                header('Location: wishlist.php');  // redirects them
                exit;  // ensures no other code executes
            }
        } catch(PDOException $e) {
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
        } catch (Exception $e){
            $_SESSION['message'] = "ERROR: ".$e->getMessage();
            header('Location: wishlist.php');  // redirects them
            exit;  // ensures no other code executes
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

echo "<h2> Your Wishlist </h2>";//heading

echo "<br>";
echo user_message();//calls the function
echo "<br>";

echo "<form method='post' action=''>";
try{
    $gifts = gift_getter(dbconnect_insert());
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
    header("location:wishlist.php");
    exit;
} catch (Exception $e){
    echo "ERROR: " . $e->getMessage();
    header("location:wishlist.php");
    exit;
}

if(!$gifts){
    echo "no gifts available!";
} else {
    echo "<select name='gift_select'>";
    foreach ($gifts as $gift) {
        echo "<option value=" . $gift['giftid'] . "'>" . $gift['brand'] . " - " . $gift['about'] . "</option>";
    }

    echo "</select>";
}


echo"<input type='submit' name='addgift' value='Wish for gift' />";

echo "</form>";
echo "<br>";
echo "<h3> Add a gift and wishlist it:</h3>";  # sets a h2 heading as a welcome
echo "<form action='' method='post'>";
echo "<input type='text' name='brand' placeholder='Gift brand or name' required/>";
echo "<input type='text' name='about' placeholder='Gift Details' required/>";

echo"<input type='submit' name='giftaddandwish' value='add a gift' />";

echo "</form>";


echo "</div>";



echo "<br>";

$wishes = wishlist_getter(dbconnect_insert());//getting appoiments from database


if(!$wishes){//if there are no appoiments it will tell the user
    echo "no wishes found";
}else{

    echo "<table id='bookings'>";//starts a table for bookings


        echo "<form action='' method='post'>";// creating a form per row of the table for each appinment

        echo "<tr>";
        echo "<td> brand:" . ( $wishes['brand']) . "</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt is
        echo "<td> Made on: " . ( $wishes['about']) . "</td>";//using a built in fuction and telling it what format our epoch time should go in for when the apt was made
        echo "<td><input type='hidden' name='wishid' value='".$wishes['wishlist_id']."'>
        <input type='submit' name='giftdelete' value='delete gift' /></td>";//set the value without needed to input, allows user to submit and change

        echo "</tr>";
        echo "</form>";//closes form and table

}



echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code