<?php
include("../config.php");
	$sql="INSERT INTO `menu` (`menu_id`, `menu_name`, `parent_id`, `link`, `status`, `fa_icon`) VALUES (NULL, '', '0', '', '0', '')";
	mysqli_query($con,$sql);


header("location: naveditor.php");
?>