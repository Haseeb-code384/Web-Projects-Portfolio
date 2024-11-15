<?php

echo $image_id = $_GET['image_id'];
include("../config.php");

if (isset($_POST['update'])) {
	
	/*foreach ($_FILES['upload']['name'] as $key => $name){*/


	  /*  echo $size = $_FILES['upload']['size'];
	    echo $na = $_FILES["upload"]["name"];
	    $ex = pathinfo($na,PATHINFO_EXTENSION);
	    $dt = date("Y-m-d h-i-s");
	    $img = 'upload/' .$na;
	    move_uploaded_file($_FILES['upload']['tmp_name'],'upload/' .$img);*/
	    

		$name = $_FILES['upload']['name'];
		$newFilename = time() . "_" . $name;
		move_uploaded_file($_FILES['upload']['tmp_name'], 'upload/' . $newFilename);
		$location = 'upload/' . $newFilename;
		$date = date("Y-m-d H:i:s");



		 $sql = "UPDATE files_table SET file= '$location',date_created='$date' WHERE file_id = '$image_id'";

	    $query = mysqli_query($con,$sql) or die(mysqli_error($con));
	    if ($query){
	       
	       echo "<script> 


	       alert('image successfully updated !!');
	       window.location.href = 'index.php';

	       </script>";
	    }
	  
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

</body>
</html><!DOCTYPE html>
<html>
<head>
	<title>Update Images</title>
</head>
<body>
	<div style="height:50px;"></div>
	<div style="margin:auto; padding:auto; width:80%;">
		<span style="font-size:25px; color:blue"><center><strong>Updating Multiple Files</strong></center></span>
		<hr>	
		<?php
        
        $sql = "SELECT * FROM `files_table` WHERE file_id = $image_id";
        $query = mysqli_query($con,$sql) or die(mysqli_error($con));
        $row = mysqli_fetch_array($query);
        ?>	
		<div style="height:20px;"></div>
		<form method="POST" action="" enctype="multipart/form-data">
			
			<?php  echo $row['file'];?>

			<input type="file" value="<?php echo $row['file'];?>" name="upload"> <img src="<?php echo $row['file'];?>" height="150px;" width="150px;" alt="Nothing to show"><br><br>
		<br>
		<input type="submit" name="update" value="Update"> 
		</form>
	</div>
</body>
</html>