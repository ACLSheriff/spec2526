<?php

function new_user($conn, $post)//creates fuction
{

    $sql = "INSERT INTO users (firstname, surname, username, password, d_o_b) VALUES(?,?,?,?,?)";//easy to sql attack
    $stmt = $conn->prepare($sql);//prepare sql

    $stmt->bindValue(1, $post['firstname']);//binds values
    $stmt->bindValue(2, $post['surname']);
    $stmt->bindValue(3, $post['username']);
    $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);//built in libray to incrypt
    $stmt->bindValue(4, $hpswd);
    $stmt->bindValue(5, $post['d_o_b']);

    $stmt->execute();// run the query to insert
    $conn = null;// gets rid of connection to make sure no open connection which is secrity breach
    return true;
}

function user_message()
{
    if(isset($_SESSION['usermessage'])){//check if message set
        $message = "<p>". $_SESSION['usermessage']."</p>";//assinges the massage and styles
        unset($_SESSION['usermessage']);//unsets message
        return $message;//return message
    }else{//if not met
        $message = "";//set to blank
        return $message;//returns message
    }

}

function username_check($conn, $username)
{

    $sql = "SELECT username FROM users where username= ?";//sql stament getting usernames from database
    $stmt = $conn->prepare($sql);//prepare sql
    $stmt->bindValue(1, $username);//subbmits paramitter so its secure
    $stmt->execute();//run sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);//brings back results
    $conn = null;// stops the connection so more secure
    if ($result) {//checks if got anything back
        return true;
    } else {
        return false;
    }


}

function login($conn, $post)
{
    $conn = dbconnect_insert();//gets database
    $sql = "SELECT * FROM users WHERE username= ?";//set up sql statments
    $stmt = $conn->prepare($sql);//prepares sql quary
    $stmt->bindValue(1, $post['username']);//binds paramiter to execute
    $stmt->execute();//run from sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);//brings back resuts
    $conn = null;//stops connection

    if ($result) {//if there is a result returned
        return $result;//returns result
    } else {
        $_SESSION['usermessage'] = "User not found";//send message from error to be printed
        header("Location: login.php");//send back to login page
        exit();//exits code
    }
}


function ticket_getter($conn){

    $sql = "SELECT ticket_id, type, quantity, price FROM ticket ";//sets up SQL stament
    //gets the staff details from the table in decsding order

    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;  // close the connection so cant be abused
    return $result;  // registration successful

}

function ticket_discount($conn, $input){
    $dis_return = false;
    if ($input == ''){
        $dis_return = 5;
    }else{
        $sql = "SELECT * FROM discount ";//sets up SQL stament
        //gets the staff details from the table in decsding order

        $stmt = $conn->prepare($sql);//prepares SQL statment

        $stmt->execute(); //run the query to insert
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;  // close the connection so cant be abused

        foreach ($result as $discount){
         if ($discount['discount_code'] == $input){
             $dis_return = $discount['discount_id'];
         }
        }
    }
    return $dis_return;

}

function commit_booking($conn, $epoch, $ticket_id, $user_id, $disc_code, $amount){
    $sql = "INSERT INTO booking (user_id, ticket_id, date, discount_id, amount) VALUES(?,?,?,?,?)";//inserts the bookinf details into the booking table
    $stmt = $conn->prepare($sql);//prepares sql statment
    $stmt->bindValue(1, $user_id);//binds values
    $stmt->bindValue(2, $ticket_id);
    $stmt->bindValue(3, $epoch);//puts in epoch time
    $stmt->bindValue(4, $disc_code);
    $stmt->bindValue(5, $amount);

    $stmt->execute();//exicutes sql statment
    $conn = null;//cutts off connection to prevent ecurity breaches
    return true;
}


function bookings_getter($conn)
{
    $sql = "SELECT b.booking_id, b.date, b.amount, t.type, t.price, d.discount_amount FROM booking b JOIN ticket t ON b.ticket_id = t.ticket_id JOIN discount d ON b.discount_id = d.discount_id WHERE b.user_id = ? ORDER BY b.date ASC";
    // selects the feils from the diffrent tables, it gets them from the bookings table which we have labled b and joins the docters table with have labled s
    // and use staff id to link together from each table, where it has the user id that that is being used and this will be pulled and orderd by the appiment date in asending order
    $stmt = $conn->prepare($sql);//prepares the SQL stament

    $stmt->bindValue(1,$_SESSION['userid']);//binds value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//featches all the results
    $conn = null;  // close the connection so cant be abused
    if($result){//will check if there is a result
        return $result;//returns result
    } else{
        return false;//otherwise we can return false
    }

}

function check_avalible($conn, $amount, $epoch_date, $ticket_id)
{


    $sql = "SELECT quantity FROM ticket WHERE ticket_id = ?";

    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->bindValue(1,$ticket_id);//binds value

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);;
    $available = $result;


    $avalible_return = false;


    $sql = "SELECT * FROM booking WHERE ticket_id = ? AND date = ?";//sets up SQL stament

        //gets the staff details from the table in decsding order

        $stmt = $conn->prepare($sql);//prepares SQL statment

        $stmt->bindValue(1,$ticket_id);//binds value
        $stmt->bindValue(2,$epoch_date);//binds value

        $stmt->execute(); //run the query to insert
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;  // close the connection so cant be abused

        if(!$result){
            if($available >= $amount){
                $avalible_return = true;
            } elseif($available < $amount){
                $avalible_return = false;
            }

        } else {
            $totalsold = $amount;
            foreach ($result as $sold){
                $totalsold= $totalsold+$sold['amount'];
            }
            if($totalsold <= $available){
                $avalible_return = true;
            } elseif($totalsold > $available){
                $avalible_return = false;
            }

        }

    return $avalible_return;

}

function cancel_booking($conn, $bookid)
{
    $sql = "DELETE FROM booking WHERE booking_id = ?";//this deltes the booking the user selected from the database
    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->bindValue(1,$bookid);// finds the user id and binds to value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//
    $conn = null;  // close the connection so cant be abused
    return true;

}

function fetch_ticket($conn, $booking_id)
{
    $sql = "SELECT * FROM booking WHERE booking_id = ?";//gets the bookings infomation
    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->bindValue(1, $booking_id);// finds the booking id and binds to value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetch(PDO::FETCH_ASSOC);//featches all results
    $conn = null;  // close the connection so cant be abused
    return $result;//returns the booking info result
}

function ticket_update($conn, $ticket_id, $date, $amount)
{
    $sql = "UPDATE booking SET ticket_id = ?, date = ?, amount = ? WHERE booking_id = ?";//update bookings and resets the staff and appoimnet date
    $stmt = $conn->prepare($sql);//prepares stament
    $stmt->bindParam(1, $ticket_id);//binds paramiters that have been changed by user
    $stmt->bindParam(2, $date);
    $stmt->bindParam(3, $amount);
    $stmt->execute();//exitutes and runs query
    $conn = null;// closes connection
    return true;

}


function password_streagth($pwd){

    $checker = 0;//sets checker to 0
    $results = array();//creates an array

//each section of code here is getting the value from the subroutine and adding to the checker if it has passed or not
    $tmp = len_checker($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){//if it is correct can return messages
        $results["len"] = "SUCCESS: Length Check Passed";
    } else {
        $results["len"] = "FAILED: Length Check FAILED";
    }

    $tmp = check_upper($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: uppercase Check Passed";
    } else {
        $results["len"] = "FAILED: uppercase Check FAILED";
    }

    $tmp = check_lower($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: lowercase Check Passed";
    } else {
        $results["len"] = "FAILED: lowercase Check FAILED";
    }

    $tmp = char_special($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: special charecter Check Passed";
    } else {
        $results["len"] = "FAILED: special charecter Check FAILED";
    }

    $tmp = password_check($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: password word Check Passed";
    } else {
        $results["len"] = "FAILED: password word Check FAILED";
    }

    $tmp = digit_check($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: digit Check Passed";
    } else {
        $results["len"] = "FAILED: digit Check FAILED";
    }

    $tmp =  last_special_char($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: last letter special charecter Check Passed";
    } else {
        $results["len"] = "FAILED: last letter special charecter Check FAILED";
    }

    $tmp = check_first_special($pwd);//calles function
    $checker+=$tmp;//adds value returned to checker
    if ($tmp==1){
        $results["len"] = "SUCCESS: first letter special charecter Check Passed";
    } else {
        $results["len"] = "FAILED: first letter special charecter Check FAILED";
    }

    if ($checker > 7) {//checks all the checks have passed
        return true;//if so it will return true
    }else{
        $_SESSION['usermessage'] = "your password has failed 1 or more complexity tests ";//if its failed the checks if will produce this message to user
        return false;
    }


}


function digit_check($pwd)//names the fuction and brings in input to work with
{
    if (preg_match('/[0-9]/', $pwd)) {//this checks if these are any digits 0-9 in the input
        return 1; //respose depding on the password input
    } else {
        return 0;
    }
}


function check_first_special($pwd)//names the fuction and brings in input to work with
{
    if (preg_match( "/^[^a-zA-Z0-9_]/", $pwd) ) {//this will check if the first letter is a special charter
        return 0;//respose depding on the password input
    }else{
        return 1;
    }

}

function len_checker($pwd){//creates a function

    $length = strlen($pwd);// this gets the lngth of the string

    if ($length < 8 ){// checks if the length is 8 or more
        return 0;//respose depding on the password input
    } else {
        return 1;
    }


}


function check_lower($pwd){//names the fuction and brings in input to work with
    if (preg_match("/[a-z]/", $pwd)){//this checks to see if there r lowercase atters in the password
        return 1;//respose depding on the password input
    } else {
        return 0;
    }
}


function password_check($pwd){//names the fuction and brings in input to work with
    if (str_contains($pwd,"password")){// checks if the string password is in the input
        return 0;//respose depding on the password input
    } else {
        return 1;
    }

}


function char_special($pwd)//names the fuction and brings in input to work with
{
    if (preg_match("/[^a-zA-Z0-9_]/", $pwd)){// checks that the input inclueds a special charter
        return 1;//respose depding on the password input
    } else {
        return 0;
    }
}


function check_upper($pwd){//names the fuction and brings in input to work with

    if(preg_match("/[A-Z]/", $pwd)){// checks to see if capital letters are included in the input
        return 1;//respose depding on the password input
    }else{
        return 0;
    }

}


function last_special_char($pwd) {//names the fuction and brings in input to work with
    if (preg_match('/[^a-zA-Z0-9_]$/', $pwd)) {// checks if the last letter of the input is a special charter
        return 0;//respose depding on the password input
    } else {
        return 1;
    }
}