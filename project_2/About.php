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

            echo "<br>";// breaks in the lines to make it more readable
            echo "<h2> About GibJohn Tutoring </h2>";//heading of page
            echo "<br>";
            // here is paragh text in the content box
            echo "<p class='content'> At GibJohn Tutoring, we believe that every student deserves a personalized and engaging learning experience.</p>";
            echo "<p class='content'> With a team of dedicated tutors and innovative technology,<br> we offer a seamless blend of face-to-face sessions and digital resources designed to make learning enjoyable and effective.</p>";
            echo "<p class='content'> Our platform focuses on helping students understand key concepts across a variety of subjects,</p>";
            echo "<p class='content'> while supporting their progress with interactive tools and resources that cater to different learning styles.</p>";
            echo "<br>";// breaks for readablity

            echo "<p class='content'> We are committed to providing not just academic support, but also a platform that encourages curiosity and growth. </p>";
            echo "<p class='content'> Our aim is to make learning accessible and enjoyable for all students, regardless of their background or learning needs. </p>";
            echo "<br>";

            echo "<img src='images/smiling_student.jpeg'>";//shows an image to be displayed

            echo "<br>";
            echo "<h2> What We Offer:</h2>";//another heading
            echo "<table>";//starts a table
            echo "<ul>";//bullit points the list
            //these are all items in the list
            echo "<li> Interactive Tutoring Sessions: Personalized face-to-face tutoring in a range of subjects, from math to languages, to ensure deeper understanding. </li>";
            echo "<li> Digital Learning Resources: Access to a wide array of materials, including videos, quizzes, and exercises to enhance learning. </li>";
            echo "<li> Collaborative Learning Tools: Features that allow students to interact with peers and tutors, encouraging teamwork and shared learning experiences.</li>";
            echo "<li> Progress Monitoring: Tools to track your progress and identify areas for improvement, helping you stay on top of your academic goals.</li>";
            echo "<li> Accessibility Features: A platform designed to be user-friendly, with accessibility options to support all learners.<li>";
            echo "<ul>";
            echo "</table>";//end of table

            echo "</div>";//closes the classes
            echo "</div>";
        echo "</body>";//closes body of code
    echo "</html>";//end of html
?>
