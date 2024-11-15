<?php
/* =========================
Connectig with the database 
============================*/
// For this three things are required. So we will create the variables for that.

$server_name = "localhost";
$user_name = "root";    // Cpanel username and password is usually the username and password here in case of web hosting
$password_sq = "";
$db_name = "blaze_web";

// Now connect --- There are two methods for connection___ 1... sqli------- 2... PDO
// Sqli further has two methods ------ object oreinted and procedural
// We will use object oriented mehtod
$connection = new mysqli($server_name, $user_name, $password_sq, $db_name);

if($connection -> connect_error){
    die("Cannot connect to this DataBase" . $connection -> connect_error);
}
else {
    // echo "Database Connected! <br>";
}

// For Procedural Method 

// $connection = mysqli_connect($server_name, $user_name, $password);
// if(!$connection){
//     die("Cannot connect to this DataBase" . mysqli_connect_error());
// }
// else {
//     echo "Database Connected!";
// }

?>