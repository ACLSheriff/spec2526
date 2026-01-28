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


function auditor($conn, $userid, $code, $long){  # on doing any action, auditor is called and the action recorded
    $sql = "INSERT INTO auditor (userid,code, longdesc, dateon) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
    $stmt = $conn->prepare($sql); //prepare to sql

    $stmt->bindParam(1, $userid);
    $stmt->bindParam(2, $code);
    $stmt->bindParam(3, $long);
    $happenedon = time();
    $stmt->bindParam(4, $happenedon);  //bind parameters for security

    $stmt->execute();  //run the query to insert
    $conn = null;  // closes the connection so cant be abused.
    return true; // Registration successful
}


function getnewuserid($conn, $username){  # upon registering, retrieves the userid from the system to audit.
    $sql = "SELECT user_id FROM users WHERE username = ?"; //set up the sql statement
    $stmt = $conn->prepare($sql); //prepares
    $stmt->bindParam(1, $username);
    $stmt->execute(); //run the sql code
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    return $result["userid"];
}


function gift_getter($conn){

    $sql = "SELECT gift_id, brand, about FROM gifts ORDER BY brand DESC";//sets up SQL stament
    //gets the staff details from the table in decsding order

    $stmt = $conn->prepare($sql);//prepares SQL statment

    $stmt->execute(); //run the query to insert
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;  // close the connection so cant be abused
    return $result;  // registration successful

}


function add_gift($conn, $post){
    $sql = "INSERT INTO gift (brand, about) VALUES(?,?)";//inserts the bookinf details into the booking table
    $stmt = $conn->prepare($sql);//prepares sql statment
    $stmt->bindValue(1, $post['brand']);//binds values
    $stmt->bindValue(2, $post['about']);
    $stmt->execute();//exicutes sql statment
    $conn = null;//cutts off connection to prevent ecurity breaches
    return true;
}


function get_new_gift($conn){//gets the gift that was just added to the database
    $sql = "SELECT * FROM gifts ORDER BY gift_id DESC LIMIT 1";//gets all the coloums from gift and orders it in desceding order so the first item is the most recent add and it only then takes the first row/ last added item

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
    $conn = null;
    if($result){
        return $result;
    } else {
        return false;
    }
}



function add_wish($conn, $giftid, $userid){
    $sql = "INSERT INTO wishlist (gift_id,user_id,date ) VALUES(?,?,?)";//inserts the bookinf details into the booking table
    $stmt = $conn->prepare($sql);//prepares sql statment
    $stmt->bindValue(1,$_SESSION['userid']);//binds value
    $stmt->bindValue(2,$_SESSION['gift_id']);
    $stmt->execute();//exicutes sql statment
    $conn = null;//cutts off connection to prevent ecurity breaches
    return true;
}


function wishlist_getter($conn)
{
    $sql = "SELECT w.wishlist_id, w.date , g.brand, g.about FROM wishlist w JOIN gifts g ON w.gift_id = g.gift_id WHERE w.user_id = ? ORDER BY g.brand ASC";
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


function remove_wish($conn,$wish_id){
    $sql = "DELETE FROM wishlist WHERE wish_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $wish_id);
    $stmt->execute();
    $conn = null;
    return true;
}