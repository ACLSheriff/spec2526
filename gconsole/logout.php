<?php

session_start();//starts the session
require_once "assests/dbconnect.php";
require_once "assests/common.php";

auditor(dbconnect_insert(),$_SESSION['user'],"log", "user has successfully logged out");

session_destroy();//stops and gets rid of the session


header("location:index.php?message=You have been logged out");//sends back to index page and sends message to be printed