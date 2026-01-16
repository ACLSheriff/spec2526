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

function get_house_id($conn)
{
    $sql = "SELECT house_id FROM house ORDER BY house_id DESC LIMIT 1";//sets up SQL stament getting the user a id
    $stmt = $conn->prepare($sql); //prepares SQL
    $stmt->execute(); //run quary to insert
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings array back from database
    $conn = null; //closes connection
    return $result["house_id"];  //returns result
}

function add_house_reg($conn, $userid, $house_id)
{
    $sql = "INSERT INTO veiws (house_id, longdesc, role, user_id) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $house_id);
    $longdesc = "owner of the house";
    $stmt->bindValue(2, $longdesc );
    $role = "owner";
    $stmt->bindValue(3, $role);
    $stmt->bindValue(4, $userid);

    $stmt->execute();
    $conn = null;
    return true;

}


function house_getter($conn, $user_id){
    $sql = "SELECT v.house_id, v.role, v.longdesc, h.reg_date, h.address, h.street FROM veiws v JOIN house h ON v.house_id = h.house_id WHERE v.user_id = ? ORDER BY h.house_id ASC";
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
