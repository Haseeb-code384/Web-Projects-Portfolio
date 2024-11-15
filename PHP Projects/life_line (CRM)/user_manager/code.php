<?php
session_start();

include '../config.php';


if(isset($_POST['btn'])){

    $user_id = $_REQUEST['user_id'];
    $brandlist = $_REQUEST['brandslist'];

    foreach($brandlist as $branditems)
    {
        
             // echo $branditems."<br>";
        $query = "INSERT INTO `menu_user_permissions`(`user_id`,`menu_id`) VALUES ($user_id ,$branditems)";
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            
            header("location:edit_checkbox.php");
           
            }
            else{
                echo "Something went wrong";
            }

    }
}

?>