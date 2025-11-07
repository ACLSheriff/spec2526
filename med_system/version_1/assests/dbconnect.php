<?php
// this is very insecure the veriables should not be stored in the code as plain text
//set teh credetails as a enviroment veriable in the websever software
// they should be stored in a file outside of connectivity, a user cant access but this can, outside the websevers folder structure
function dbconnect_insert()// creates fuction
{
    $servername = "localhost"; //sets sever name
//you should not use root to access the database as its full access tempry
    $dbusername = "root";//gets the user name we need to access the database in the correct way

    $dbpassword = "";//password for database useraccont

    $dbname = "med_system";// database name to connect to

    try{//attempt this block of code, catching an error
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $dbusername, $dbpassword);//establishing a pdo will connect to any type of data source from one commeand set, we could use my SQLi as well but not as common
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//sets error modes
        return $conn;// return connection
    } catch(PDOException $e){// catch statment if fails into e
        error_log("Database error in super_checker: ". $e->getMessage());// throw the exeption

        throw $e;// outputs the error
    }
}