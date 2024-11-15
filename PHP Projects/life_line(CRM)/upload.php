<?php
	include('config.php');
echo $_REQUEST['date'];
	foreach ($_FILES['drupload']['name'] as $key => $name){
		
		//$newFilename = time() . "_" . $name;
		if($name!='')
		{
		
		move_uploaded_file($_FILES['drupload']['tmp_name'][$key], 'upload/' .$name);
		$location = 'upload/' . $name;
		$date = date("Y-m-d H:i:s");
		mysqli_query($con,"INSERT INTO `files_table`(`file`, `date_created`) values ('$location','$date')");
	
		}	}
?>

