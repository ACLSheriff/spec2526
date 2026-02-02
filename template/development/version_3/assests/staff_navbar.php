<?php

echo "<div class='nav'>";//opens a class called nav
echo "<nav>";  //used to layout my hyperlinks

echo "<ul>";  // opens the list



if(!isset($_SESSION['staff_id'])) {
    echo "<li> <a href='staff_login.php'> Login </a> </li>";//only lets the user see when not logged in
    echo "<li> <a href='staff_register.php'> Staff register </a> </li>";
} else {
    echo "<li> <a href='staff_bookings.php'> Bookings </a> </li>";
    echo "<li> <a href='staff_logout.php'> logout </a> </li>";
}

echo "</ul>";  // closes the row of the list.

echo "</nav>";  // closes off the naviagtion links

echo "</div>";// ends the class so you know what is inside