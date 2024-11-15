<?php
include("../config.php");
 $user_id = $_GET['user_id'];

$sql = "DELETE FROM `user`  WHERE id = $user_id";
$query = mysqli_query($con,$sql) or die(mysqli_error($con));
if ($query) {
    header("location:view_user.php");
}else{
    echo "<script>alert('Something went Wrong')</script>";
}

?>