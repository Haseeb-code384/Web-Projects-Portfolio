<?php
include('config.php');
$tablecol="employee_profession";
$returnpage="employee_profession.php";
$page_name="Employee Profession";
if($_REQUEST['val'])
{
	$val=$_REQUEST['val'];
	$sql="select * from $tablecol where $tablecol='$val' ";
		$query=mysqli_query($con,$sql);
		
if(isset($_REQUEST['submit']))
{
	$name=$_REQUEST['name'];
	$oldname=$_REQUEST['oldname'];
	$sql="UPDATE $tablecol SET $tablecol='$name' WHERE $tablecol='$oldname'";
	$query=mysqli_query($con,$sql);
header('location: '.$returnpage);
	
?>
<script> window.close();</script>

<?php 
}

}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($project_name); ?></title>
</head>


<body>
<?php include('start.php'); ?>
<center>
<form method="post">
	<h1>Edit <?php echo ucfirst($page_name); ?></h1>
	<br><strong>
		<label >Enter <?php echo ucfirst($page_name); ?> Name</label></strong>
	<br>
	<input type="text" required name="name" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Name"  value="<?php $row=mysqli_fetch_array($query); echo $row[0]; ?>" >
	<input type="hidden" required name="oldname" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Sort"  value="<?php  echo $row[0]; ?>" >
	<br>
	<input type="submit" name="submit" value="Update Now" class="btn-sm btn-lg form-group btn-primary col-2">

	<br>
</form>
</body>
</html>
