<?php
include("config.php");

$user_id = $_GET['user_id'];

if (isset($_POST['update'])) {


    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $date = date("Y-m-d H:i:s");


    $sql="UPDATE `user` SET `email`= '$email',`name`= '$full_name',`country`= '$country',`created_at`= '$date' WHERE id = $user_id";
    $query=mysqli_query($con,$sql) or die(mysqli_error($con));
    if ($query){
        header("location:usermanager_viewusers.php");
    }
    else{

        echo "<script>alert('Something went wrong')</script>";
    }

}



 
?>