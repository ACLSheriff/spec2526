<?php


Function user_msg(){//creates a function

    if(isset($_SESSION['msg'])){// checks if session messge have been sset
        $msg = 'USER MESSAGE: '.$_SESSION['msg'];// creats a messge to echo out
        $_SESSION['msg'] = '';
        unset($_SESSION['msg']);//unset so it dosnt display else where
        return $msg;//returns

    }
    else {
        return "";
    }

}