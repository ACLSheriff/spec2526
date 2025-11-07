<?php


echo "<div class='nav'>";//opens a class called nav
echo "<nav>";  //used to layout my hyperlinks

echo "<ul>";  // opens the list

echo "<li> <a href='index.php'> Home </a> </li>";//links of each page that can be displayed to click through

if(!isset($_SESSION['user'])) {
    echo "<li> <a href='login.php'> Login </a> </li>";
    echo "<li> <a href='register.php'> User register </a> </li>";
}else {
    echo "<li> <a href='logout.php'> Logout </a></li>";
    echo "<li> <a href='booking.php'> Bookings </a> </li>";
    echo "<li> <a href='book.php'> Book </a> </li>";
}

echo "</ul>";  // closes the row of the list.

echo "</nav>";  // closes off the naviagtion links

echo "</div>";// ends the class so you know what is inside