<?php
require "data_base.php";
// Create a table with PHP & SQL


// This is the syntax for the table

// $sql = "CREATE TABLE table_name(
//     column1 datatype,
//     column2 datatype,
//     column3 datatype,
//     column4 datatype
//     )";

$sql = "CREATE TABLE users(
    -- AUTO INCREMENT will increase one value in case of not puttin the value
    -- PRIMARY KEY Will make this column unique . it means the value will not repeat
    -- UNSIGNED will make the values in this column in positive
    user_id INT(6) AUTO_INCREMENT PRIMARY KEY ,
    user_name VARCHAR(30) NOT NULL, 
    -- NOT NULL will only pass the value when user put some value
    user_email VARCHAR(30) NOT NULL, 
    user_password VARCHAR(30) NOT NULL, 
    user_country VARCHAR(20) NOT NULL DEFAULT 'N/A',
    -- DEFAULT will pass the value in case user did not put the value
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($connection ->query($sql) ===TRUE){
echo "DATABASE TABLE CREATED SUCCESSFULLY";
}else{
    echo "Error creating table" . $connection ->error;
}


?>