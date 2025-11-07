<?php

function new_user($conn, $post)//creates fuction
{
    try{// doing a prepared stament
        $sql = "INSERT INTO user (first_name, surname, username,password, d_o_b, adress) VALUES(?,?,?,?,?,?)";//easy to sql attack
        $stmt = $conn->prepare($sql);//prepare sql

        $stmt->bindValue(1, $post['first_name']);
        $stmt->bindValue(2, $post['surname']);
        $stmt->bindValue(3, $post['username']);
        $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);//built in libray to incrypt
        $stmt->bindValue(5, $post['d_o_b']);
        $stmt->bindValue(5, $post['adress']);// binding the data from form to SQL statment this makes it more secure from a SQL injection attack less likly to hijk

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
    try {
        $sql = "SELECT username FROM user where username= ?";//sql stament getting usernames from database
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