<?php
include("../config.php");
$id=$_REQUEST['id'];
$f=$_REQUEST['f'];
	$sql="UPDATE `menu` SET  `fa_icon` = '$f' WHERE `menu`.`menu_id` = $id;";
	mysqli_query($con,$sql);

header("location: naveditor.php");
?>