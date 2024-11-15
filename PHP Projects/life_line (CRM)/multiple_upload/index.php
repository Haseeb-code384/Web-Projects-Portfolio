<!DOCTYPE html>
<html>
<head>
	<title>Uploading Multiple Files using PHP</title>
</head>
<body>
	<div style="height:50px;"></div>
	<div style="margin:auto; padding:auto; width:80%;">
		<span style="font-size:25px; color:blue"><center><strong>Uploading Multiple Files</strong></center></span>
		<hr>		
		<div style="height:20px;"></div>
		<form method="POST" action="upload.php" enctype="multipart/form-data">
		<?php
		for ($i=0; $i < 10; $i++){?>


			<input type="file" name="upload[]" alt="Nothing to show" multiple ><br><br>


		<?php } ?>
		<br>
		<input type="submit" value="Upload"> 
		</form>
	</div>
	<div style="margin:auto; padding:auto; width:80%;">
		<h2>Output:</h2>
		<table>
			<tbody>
				<tr>
				<th>Picture</th>
				<th>Action</th>

				</tr>
				
					<?php
				include('../config.php');
				$query=mysqli_query($con,"select * from files_table");
				while($row=mysqli_fetch_array($query)){
					?>
					<tr>
					<td>
					<img src="<?php echo $row['file']; ?>" height="150px;" width="150px;">
					</td>

					<td>
						<a href="edit_image.php?image_id=<?php echo $row['file_id']?>">Edit</a>
					</td>


						<?php
					} ?>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>