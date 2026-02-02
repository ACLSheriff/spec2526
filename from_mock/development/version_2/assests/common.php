<?php

function new_user($conn, $post)//creates fuction
{

        $sql = "INSERT INTO users (firstname, surname, username,password, d_o_b, address) VALUES(?,?,?,?,?,?)";//easy to sql attack
        $stmt = $conn->prepare($sql);//prepare sql

    $stmt->bindValue(1, $post['firstname']);//binds values
    $stmt->bindValue(2, $post['surname']);
    $stmt->bindValue(3, $post['username']);
    $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);//built in libray to incrypt
    $stmt->bindValue(4, $hpswd);
    $stmt->bindValue(5, $post['d_o_b']);
    $stmt->bindValue(6, $post['address']);// binding the data from form to SQL statment this makes it more secure from a SQL injection attack less likly to hijk

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


function staff_getter($conn){

    $sql = "SELECT staff_id, role, surname FROM staff WHERE role != ? ORDER BY role DESC";//sets up SQL stament
    //gets the staff details from the table in decsding order

    $stmt = $conn->prepare($sql);//prepares SQL statment
    $exclude_role = "adm";//exclueds and dosnt get any admin staff from the table

    $stmt->bindValue(1,$exclude_role);//binds value to make sure role is excluded

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;  // close the connection so cant be abused
    return $result;  // registration successful

}


function commit_booking($conn, $epoch){
    $sql = "INSERT INTO bookings (user_id, staff_id, aptdate, bookedon) VALUES(?,?,?,?)";//inserts the bookinf details into the booking table
    $stmt = $conn->prepare($sql);//prepares sql statment
    $stmt->bindValue(1, $_SESSION['userid']);//binds values
    $stmt->bindValue(2, $_POST['staff']);
    $stmt->bindValue(3, $epoch);//puts in epoch time
    $stmt->bindValue(4, time());

    $stmt->execute();//exicutes sql statment
    $conn = null;//cutts off connection to prevent ecurity breaches
    return true;
}


function appt_getter($conn)
{
    $sql = "SELECT b.booking_id, b.aptdate, b.bookedon, s.role, s.surname FROM bookings b JOIN staff s ON b.staff_id = s.staff_id WHERE b.user_id = ? ORDER BY b.aptdate ASC";
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


function cancel_appt($conn, $aptid)
{
    $sql = "DELETE FROM bookings WHERE booking_id = ?";//this deltes the booking the user selected from the database
    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->bindValue(1,$aptid);// finds the user id and binds to value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//
    $conn = null;  // close the connection so cant be abused
    return true;

}



