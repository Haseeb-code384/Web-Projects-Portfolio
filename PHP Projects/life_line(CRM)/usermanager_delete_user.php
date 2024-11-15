<?php
include("config.php");
if(isset($_REQUEST['enable']))
{
	$enable=$_REQUEST['enable'];
$sql = "UPDATE `user` SET `active` = '1' WHERE `user`.`id` = '$enable'";	
$query = mysqli_query($con,$sql) or die(mysqli_error($con));
if ($query) {
    header("location: usermanager_viewusers.php");
}else{
    echo "<script>alert('Something went Wrong')</script>";
}

}

if(isset($_REQUEST['disable']))
{

	$disable=$_REQUEST['disable'];

$sql = "UPDATE `user` SET `active` = '0' WHERE `user`.`id` = '$disable'";
$query = mysqli_query($con,$sql) or die(mysqli_error($con));
     $sql = "UPDATE `inquiry` SET allocated_to='' WHERE allocated_to=(SELECT email FROM `user` WHERE id='$disable')";
$query = mysqli_query($con,$sql) or die(mysqli_error($con));
if ($query) {
    header("location: usermanager_viewusers.php");
}else{
    echo "<script>alert('Something went Wrong')</script>";
}
	
}
if(isset($_GET['user_id']))
{
$user_id = $_GET['user_id'];

$sql = "DELETE FROM `user`  WHERE id = $user_id";
$query = mysqli_query($con,$sql) or die(mysqli_error($con));
   
if ($query) {
    header("location: usermanager_viewusers.php");
}else{
    echo "<script>alert('Something went Wrong')</script>";
}	
}


 
?>