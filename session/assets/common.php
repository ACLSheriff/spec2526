<?php



Function user_msg(){//creates a function

    if(isset($_SESSION['msg'])){// checks if session messge have been sset

        if (str_contains($_SESSION['msg'],"error")) {
            $msg = "<div id='error'> USER MESSAGE".$_SESSION['msg']."</div>";

        } else {
            $msg = "<div id='umsg'> USER MESSAGE".$_SESSION['msg']."</div>";
        }

        $_SESSION['msg'] = '';
        unset($_SESSION['msg']);//unset so it dosnt display else where
        return $msg;//returns

    }
    else {
        return "";
    }

}
