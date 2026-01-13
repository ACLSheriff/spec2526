<?php

function new_user($conn, $post)//creates fuction
{

    $sql = "INSERT INTO users (firstname, surname, username,password, address) VALUES(?,?,?,?,?)";//easy to sql attack
    $stmt = $conn->prepare($sql);//prepare sql

    $stmt->bindValue(1, $post['firstname']);//binds values
    $stmt->bindValue(2, $post['surname']);
    $stmt->bindValue(3, $post['username']);
    $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);//built in libray to incrypt
    $stmt->bindValue(4, $hpswd);
    $stmt->bindValue(5, $post['address']);// binding the data from form to SQL statment this makes it more secure from a SQL injection attack less likly to hijk

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


function add_house($conn, $epoch){
    $sql = "INSERT INTO house (reg_date, address, street) VALUES(?,?,?)";//inserts the bookinf details into the booking table
    $stmt = $conn->prepare($sql);//prepares sql statment
    $stmt->bindValue(1, $epoch);//binds values
    $stmt->bindValue(2, $_POST['address']);
    $stmt->bindValue(3, $_POST['street']);//puts in epoch time

    $stmt->execute();//exicutes sql statment
    $conn = null;//cutts off connection to prevent ecurity breaches
    return true;
}

function add_house_reg($conn, $userid)
{
    $sql = "INSERT INTO veiws (longdesc, role, user_id) VALUES(?,?,?)";
    $stmt = $conn->prepare($sql);
    $longdesc = "owner of the house";
    $stmt->bindValue(1, $longdesc );
    $role = "owner";
    $stmt->bindValue(2, $role);
    $stmt->bindValue(3, $userid);

    $stmt->execute();
    $conn = null;
    return true;

}

