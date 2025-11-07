<?php
    echo "<html>";
        echo "<head>";

            echo "<title> this is M&S </title>";// title of page
            echo "<link rel='stylesheet' type='text/css' href='css/page_2.css' />";// links to style sheet

        echo "</head>";
        echo "<body>";

            echo "<img id='mns' src='M&S.jfif'>";// this si an image
            echo "<hr>";// thsi shows a line to break up the page
            echo "<b> hello we are M&S and we are ava and ellies favrouite </b>";// text that is in bold
            echo "<a href='page3.php'> here is our competior </a>";// this links to the next page

            echo "<hr>";// break page with a line
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){// this create a form
                echo "Your name: " . $_POST['name'];// alows a user to enter there name
                echo "<br>";// break in the code
                echo "Your Address: "  . $_POST['address'];
                echo "<br>";
                echo "Whats are you ordering : "  . $_POST['order'];
            }
            echo "<form method='post' action=''>";// thsi allows the form to be displayed and submitted

            echo "<input type='text' name='name' placeholder='Name' />";// dispays what they have enters
            echo "<br>";
            echo "<input type='text' name='address' placeholder='Adress' />";
            echo "<br>";
            echo "<input type='text' name='order' placeholder='order' />";
            echo "<br>";
            echo "<input type='submit' name='submit' value='submit' />";// submit button


            echo "<hr>";
            echo "<p> hello we are the best for all sorts of things we are quality and have tasty food </p>";
            //paragha of text
            echo "<ul>";// make a list with bullet points
                echo "<li> We sell: </li>";//items in the list
                echo "<li> ready meals </li>";
                echo "<li> collin the caltiplier  </li>";
                echo "<li> amazing bakery </li>";
                echo "<li> clothes </li>";
                echo "<li> and much more </li>";
            echo "</ul>";


        echo "</body>";
        echo "</html>";

?>