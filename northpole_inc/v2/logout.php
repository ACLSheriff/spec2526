<?php

session_start();//starts the session
require_once "assests/dbconnect.php";
require_once "assests/common.php";

try {
    auditor(dbconnect_insert(), $_SESSION["userid"], "LGO", "User has successfully logged out");
} catch (Exception $e){
    $_SESSION['usermessage'] = $e->getMessage();
    header("Location: index.php");
    exit;
}


session_destroy();//stops and gets rid of the session

header("location:index.php?message=You have been logged out");//sends back to index page and sends message to be printed