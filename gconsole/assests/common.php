<?php

function new_console($conn, $post)//creates fuction
{
    try{// doing a prepared stament
        $sql = "INSERT INTO console (manufacturer, c_name, relse_date, controller_no, bit) VALUES(?,?,?,?,?)";//easy to sql attack
        $stmt = $conn->prepare($sql);//prepare sql

        $stmt->bindValue(1, $post['manufacturer']);
        $stmt->bindValue(2, $post['c_name']);
        $stmt->bindValue(3, $post['relse_date']);
        $stmt->bindValue(4, $post['controller_no']);
        $stmt->bindValue(5, $post['bit']);// binding the data from form to SQL statment this makes it more secure from a SQL injection attack less likly to hijk

        $stmt->execute();// run the query to insert
        $conn = null;// gets rid of connection to make sure no open connection which is secrity breach
    }catch (PDOException $e){
        error_log(" Audit database error:" . $e->getMessage());
        throw new Exception( "Audit database error: " . $e);

    }catch (Exception $e){//catching errors to make robust and giving error messages
        error_log(" Audit  error:" . $e->getMessage());
        throw new Exception( "Audit  error: " . $e);
    }
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
    try{
        $sql = "SELECT username FROM user where username= ?";//sql stament getting usernames from database
        $stmt = $conn->prepare($sql);//prepare sql
        $stmt->bindValue(1, $username);//subbmits paramitter so its secure
        $stmt->execute();//run sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);//brings back results
        $conn = null;// stops the connection so more secure
        if ($result){//checks if got anything back
            return true;
        }else {
            return false;
        }

    }catch (Exception $e){//catching errors to make robust and giving error messages
        error_log(" Audit  error:" . $e->getMessage());//logs error
        throw  $e;//throw the exception
    }


}
function reg_user($conn, $post)
{
        try{
            $sql = "INSERT INTO user (username, password, sign_up_date, d_o_b, country) VALUES(?,?,?,?,?)";//prepare for sqp quary
            $stmt = $conn->prepare($sql);//prepare sql

            $stmt->bindValue(1, $post['username']);//bind paramiters for security
            $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);//built in libray to incrypt to hash the password
            //we have to use the defult algrythem as there is no other built in encryption
            //so if this was a production we may use PASSWORd_BCRYPT or PASSWORD_ARGON2I to make encryption more secure
            $stmt->bindValue(2, $hpswd);
            $stmt->bindValue(3, $post['sign_up_date']);
            $stmt->bindValue(4, $post['d_o_b']);
            $stmt->bindValue(5, $post['country']);

            $stmt->execute();//run quary to insert
            $conn = null;// closes connection for security
            return true;// reg succsessful
        }catch (Exception $e){// handle database error
            error_log(" user database error:" . $e->getMessage());//log the error
            throw new Exception( "user database error: " . $e);//throw exception

        }catch (Exception $e){//handle validation or other errors
            error_log(" user reg error:" . $e->getMessage());//log error
            throw new Exception( "user reg error: " . $e->getMessage());//throw exception
        }

}

function login($conn, $post)
{
    try {// try this code
        $conn = dbconnect_insert();//gets database
        $sql = "SELECT * FROM user WHERE username= ?";//set up sql statments
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
    } catch (PDOException $e) {
        $_SESSION['usermessage'] = "User login".$e->getMessage();//returns error mesage to output
        header("Location: login.php");//send back to long in page
        exit();//exits code
    }
}

function auditor($conn, $userid, $code, $long)
{
    $sql = "INSERT INTO audit (date,user_id,code,longdesc) VALUES(?,?,?,?)";//is an SQL quary that will insert the data into each coloum of the table
    $stmt = $conn->prepare($sql);  //prepare the SQL
    $date = date("Y-m-d"); //this is the the structer a my sQl feild works and accespts
    $stmt->bindValue(1, $date);  //bind paramiters for security
    $stmt->bindValue(2, $userid);
    $stmt->bindValue(3, $code);
    $stmt->bindValue(4, $long);

    $stmt->execute(); //run the query to insert
    $conn = null;  // close the connection so cant be abused
    return true;  // registration successful

}

function getnewuserid($conn, $username){
    $sql = "SELECT user_id FROM user WHERE username= ?";
    $stmt = $conn->prepare($sql); //prepares SQL
    $stmt->bindValue(1, $username);   //binds paramiters for security
    $stmt->execute(); //run quary to insert
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings array back from database
    $conn = null; //closes connection
    return $result["user_id"];  //returns result
}