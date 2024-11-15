<?php
include("../config.php");
$id=$_REQUEST['id'];

	$sql="DELETE FROM `menu` WHERE `menu`.`menu_id` = '$id'";
echo $sql;
	mysqli_query($con,$sql);


header("location: naveditor.php");
?>