<?php 
require "templates/header.php";
require "data_base.php";

if(isset($_GET["id"]) && $_GET["id"] != ""){
    $user_id = intval($_GET["id"]);
    $confirm = $_GET["confirm"];
    echo "Are You Sure: " . '<a href="delete_user.php?id='.$user_id.'&confirm=true"'.'a>Yes</a>';
    if($confirm == "true"){
        $sql= "DELETE FROM users WHERE user_id= $user_id";
    
        if($connection -> query($sql)=== TRUE){
            echo "Record has been deleted Successfully!";
        }else{
            echo "There was an error! " . $connection -> error;
        }
    }
}else{
    die("NO valid User Found!  ". '<a href="http://localhost/blaze_web/user.php">Go Back</a>');
}

?>