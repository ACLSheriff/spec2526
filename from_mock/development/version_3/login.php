<?php

session_start();

require_once "assests/dbconnect.php";
require_once "assests/common.php";

if (isset($_SESSION['userid'])) {//checks if the user id is not set already if it is they are already logged in
    $_SESSION['usermessage'] = "you are already logged in";///checks if user is already logged in and will return message if so
    header("location:index.php");//returns to home page
    exit;//stop further exicution
}

elseif ($_SERVER["REQUEST_METHOD"] === "POST") {//verifys the function

    $fusername = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');//fitered veriable to make sure its not going to cause an error and that its secure
    $fpassword = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    try{
        $usr = login(dbconnect_insert(),$_POST);//calls login fuction

        if($usr && password_verify($fpassword,$usr['password'])){// checking the username and password match and is present
            $_SESSION['userid'] = $usr["user_id"];//sets and store user id
            $_SESSION['usermessage'] = "SUCCESSFULLY LOGGED IN";//success message
            auditor(dbconnect_insert(),$_SESSION['userid'],"log", "user has successfully logged in". $_SESSION['userid']);
            header("location:index.php");//send back to home page
            exit;//exits page ends code
        }elseif (!$usr){
            $_SESSION['usermessage'] = "ERROR:user not found";
            header("location:login.php");
            exit;
        }else{//if username isnt valid
            $_SESSION["usermessage"] = "INVALID USERNAME OR PASSWORD";//send error mesasge to be printed
            header("location:login.php");//gose back to login page
            exit;//ends code
        }
    } catch (PDOException $e) {
        $_SESSION['usermessage'] = "ERROR USER LOG IN FAILED ". $e->getMessage();
    }

    catch (Exception $e) {
        $_SESSION['usermessage'] = "ERROR USER LOG IN FAILED ". $e->getMessage();
    }
}

echo "<!DOCTYPE html>";//required tag
echo "<html>";//opens page content
echo "<head>";//opens the head of the code

echo "<title> login page </title>";//titles the page
echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

echo "</head>";// closes the head of the page
echo "<body>";//opens the body of the page

echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

require_once "assests/topbar.php";// gets and displays the top bar
require_once "assests/navbar.php";// gets and displays nav bar

echo "<div class='content'>";// this class is a box that i can put content for my page into

echo "<h2> Login </h2>";//heading
echo "<p> welcome back! </p>";//paragh of text to instruct


echo "<br>";// breaks for readability
echo "<form method='post' action=''>"; //this creates the form

echo "<input type='text' name='username' placeholder='username' </input>";//allows intput into form
echo "<br>";
echo "<input type='text' name='password' placeholder='password' </input>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit' />";//submit button for form

echo "</form>";//end form

echo "<br>";
echo user_message();//calls the function
echo "<br>";
echo "<br>";

echo "</div>";//closes each class
echo "</div>";
echo "<body>";// closes the body of code
echo "<html>";// end of html code