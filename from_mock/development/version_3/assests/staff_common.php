<?php

function s_new_user($conn, $post)
{//creates fuction
// doing a prepared stament
        $sql = "INSERT INTO staff (role,surname,username,password,firstname) VALUES(?,?,?,?,?)";//easy to sql attack
        $stmt = $conn->prepare($sql);//prepare sql

        $stmt->bindValue(1, $post['role']);
        $stmt->bindValue(2, $post['surname']);
        $stmt->bindValue(3, $post['username']);
        $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);//built in libray to incrypt
        $stmt->bindValue(4, $hpswd);
        $stmt->bindValue(5, $post['firstname']);

        $stmt->execute();// run the query to insert
        $conn = null;// gets rid of connection to make sure no open connection which is secrity breach
        return true;
}

function s_usermessage()
{
    if(isset($_SESSION['s_usermessage'])){//check if message set
        $message = "<p>". $_SESSION['s_usermessage']."</p>";//assinges the massage and styles
        unset($_SESSION['s_usermessage']);//unsets message
        return $message;//return message
    }else{//if not met
        $message = "";//set to blank
        return $message;//returns message
    }

}

function s_username_check($conn, $username)
{
    try {
        $sql = "SELECT username FROM staff where username= ?";//sql stament getting usernames from database
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

    } catch (Exception $e) {//catching errors to make robust and giving error messages
        error_log(" Audit  error:" . $e->getMessage());//logs error
        throw  $e;//throw the exception
    }


}




function s_login($conn, $post){

        $conn = dbconnect_insert();//gets database
        $sql = "SELECT * FROM staff WHERE username= ?";//set up sql statments
        $stmt = $conn->prepare($sql);//prepares sql quary
        $stmt->bindValue(1, $post['username']);//binds paramiter to execute
        $stmt->execute();//run from sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);//brings back resuts
        $conn = null;//stops connection

        if ($result) {//if there is a result returned
            return $result;//returns result
        } else {
            $_SESSION['s_user_message'] = "User not found";//send message from error to be printed
            header("Location: staff_login.php");//send back to login page
            exit();//exits code
        }

}


function appt_getter($conn)
{
    $sql = "SELECT b.booking_id, b.aptdate, b.bookedon, s.role, s.surname FROM bookings b JOIN staff s ON b.staff_id = s.staff_id WHERE b.staff_id = ? ORDER BY b.aptdate ASC";
    // selects the feils from the diffrent tables, it gets them from the bookings table which we have labled b and joins the docters table with have labled s
    // and use staff id to link together from each table, where it has the user id that that is being used and this will be pulled and orderd by the appiment date in asending order
    $stmt = $conn->prepare($sql);//prepares the SQL stament

    $stmt->bindValue(1,$_SESSION['staff_id']);//binds value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//featches all the results
    $conn = null;  // close the connection so cant be abused
    if($result){//will check if there is a result
        return $result;//returns result
    } else{
        return false;//otherwise we can return false
    }

}


function s_cancel_appt($conn, $aptid)
{
    $sql = "DELETE FROM bookings WHERE booking_id = ?";//this deltes the booking the user selected from the database
    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->bindValue(1,$aptid);// finds the user id and binds to value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//
    $conn = null;  // close the connection so cant be abused
    return true;

}


function s_auditor($conn, $staff_id, $code, $longdesc)
{
    $sql = "INSERT INTO staff_audit (date,staff_id,code,longdesc) VALUES(?,?,?,?)";//is an SQL quary that will insert the data into each coloum of the table
    $stmt = $conn->prepare($sql);  //prepare the SQL
    $date = date("Y-m-d"); //this is the structer a my sQl feild works and accespts
    $stmt->bindValue(1, $date);  //bind paramiters for security
    $stmt->bindValue(2, $staff_id);
    $stmt->bindValue(3, $code);
    $stmt->bindValue(4, $longdesc);

    $stmt->execute(); //run the query to insert
    $conn = null;  // close the connection so cant be abused
    return true;  // registration successful

}


function getnewstaffid($conn, $username)
{//gets the id of the new user to be able to enter into audit

    $sql = "SELECT staff_id FROM staff WHERE username= ?";//sets up SQL stament getting the user a id
    $stmt = $conn->prepare($sql); //prepares SQL
    $stmt->bindValue(1, $username);   //binds paramiters for security
    $stmt->execute(); //run quary to insert
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings array back from database
    $conn = null; //closes connection
    return $result["staff_id"];  //returns result
}



function fetch_appt($conn, $booking_id)
{
    $sql = "SELECT * FROM bookings WHERE booking_id = ?";//gets the bookings infomation
    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->bindValue(1, $booking_id);// finds the booking id and binds to value

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetch(PDO::FETCH_ASSOC);//featches all results
    $conn = null;  // close the connection so cant be abused
    return $result;//returns the booking info result
}

function appt_update($conn, $booking_id, $apt_time)
{
    $sql = "UPDATE bookings SET staff_id = ?, aptdate = ? WHERE booking_id = ?";//update bookings and resets the staff and appoimnet date
    $stmt = $conn->prepare($sql);//prepares stament
    $stmt->bindParam(1, $_POST['staff']);//binds paramiters that have been changed by user
    $stmt->bindParam(2, $apt_time);
    $stmt->bindParam(3, $booking_id);
    $stmt->execute();//exitutes and runs query
    $conn = null;// closes connection
    return true;

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