<?php
 
session_start();
if(!isset($_SESSION['email']))
{
    header("location:login.php");
}
include("config.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php 
	$sql="SELECT areaname FROM `arealist`";
	$query=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($query))
	{
		
	?>
	<input type="checkbox"><?php echo $row[0]; ?> <br>
	<?php } ?>
	<button>Show Report</button>
</body>
</html>
