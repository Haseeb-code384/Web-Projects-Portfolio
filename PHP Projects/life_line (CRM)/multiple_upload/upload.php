<?php
	include('../config.php');
	
	foreach ($_FILES['upload']['name'] as $key => $name){
		
		$newFilename = time() . "_" . $name;
		move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
		$location = 'upload/' . $newFilename;
		$date = date("Y-m-d H:i:s");
		
		mysqli_query($con,"INSERT INTO `files_table`(`file`, `date_created`) values ('$location','$date')");
	}
	header('location:index.php');
?>

