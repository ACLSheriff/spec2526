<?php

function digit_check($pwd)//names the fuction and brings in input to work with
{
    if (preg_match('/[0-9]/', $pwd)) {//this checks if these are any digits 0-9 in the input
        return " well done, including numbers ";//respose depding on the password input
    } else {
        return " your password should contain numbers.";
    }
}

function check_first_num($pwd) {//names the fuction and brings in input to work with
    if (is_numeric($pwd[0])) {//this checks if the first charter of the input is a number
        return "Your password should not start with a number.";//respose depding on the password input
    } else {
        return "Good, it doesn’t start with a number.";
    }
}



function check_first_special($pwd)//names the fuction and brings in input to work with
{
    if (preg_match( "/^[^a-zA-Z0-9_]/", $pwd) ) {//this will check if the first letter is a special charter
        return " your password should not start with a special character ";//respose depding on the password input
    }else{
        return " good, dont put a special character first ";
    }

}

function len_checker($pwd){//creates a function

    $length = strlen($pwd);// this gets the lngth of the string

    if ($length < 8 ){// checks if the length is 8 or more
        return "password is too short it should be 8 characters or longer.";//respose depding on the password input
    } else {
        return " good length of a password ";
    }


}


function check_lower($pwd){//names the fuction and brings in input to work with
    if (preg_match("/[a-z]/", $pwd)){//this checks to see if there r lowercase atters in the password
        return " well done for including lower case ";//respose depding on the password input
    } else {
        return "you need to include lower case letters";
    }
}


function password_check($pwd){//names the fuction and brings in input to work with
    if (str_contains($pwd,"password")){// checks if the string password is in the input
        return " the word 'Password' should not be used in your password ";//respose depding on the password input
    } else {
        return " good, dont include password in your password ";
    }

}


function char_special($pwd)//names the fuction and brings in input to work with
{
    if (preg_match("/[^a-zA-Z0-9_]/", $pwd)){// checks that the input inclueds a special charter
        return " well done for including a special character";//respose depding on the password input
    } else {
        return " your password should have a special character";
    }
}


function check_upper($pwd){//names the fuction and brings in input to work with

    if(preg_match("/[A-Z]/", $pwd)){// checks to see if capital letters are included in the input
        return " well done for including upper case";//respose depding on the password input
    }else{
        return "password should contain uppercase letters.";
    }

}


function last_special_char($pwd) {//names the fuction and brings in input to work with
    if (preg_match('/[^a-zA-Z0-9_]$/', $pwd)) {// checks if the last letter of the input is a special charter
        return "Your password should not end with a special character.";//respose depding on the password input
    } else {
        return "Well done, it doesn’t end with a special character.";
    }
}
