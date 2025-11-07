<?php
echo "<!DOCTYPE html>";//required tag
    echo "<html>";//opens page content
        echo "<head>";//opens the head of the code

            echo "<title> enter title </title>";//titles the page
            echo "<link rel='stylesheet' type='text/css' href='css/stylesheet.css'/>";//links to style sheet

        echo "</head>";// closes the head of the page
        echo "<body>";//opens the body of the page

            echo "<div class='container'>";//dive alows you to split your page up and class allows you to style that div

                require_once "assests/topBar.php";// gets and displays the top bar
                require_once "assests/nav_bar.php";// gets and displays nav bar

            echo "<div class='content'>";// this class is a box that i can put content for my page into

             echo "<br>";//break in the page to make more readable
                echo "<h2> GibJohn Tutoring </h2>";//heading

                echo "<p class='content'> Welcome to GibJohn Tutoring – your personalized learning experience! </p> ";//shows text on page in content box
                echo "<br>";//breaks for readability
                echo "<p class='content'> We offer interactive tutoring sessions and a wide range of educational resources to help students thrive.</p>";
                echo "<br>";
                echo "<p class='content'> Our platform supports collaborative learning, provides real-time progress tracking, <br> and integrates rewarding gamified features to make learning engaging and fun.</p>";
                echo "<br>";

                echo "<img src='images/peopleTutoring.jfif'>";//image that is displayed

            echo "</div>";//end of classes
            echo "</div>";
        echo "</body>";//close body
    echo "</html>";//end of html
?>
