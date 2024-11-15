<?php
include('config.php');
$page_name="Group / Branch";
if($_REQUEST['name'])
{
	$name=$_REQUEST['name'];
	$sql="select * from account_head where head_name='$name' ";
		$query=mysqli_query($con,$sql);
		
if(isset($_REQUEST['submit']))
{
	$board=$_REQUEST['board'];
	$flock=$_REQUEST['flock'];
	$sql="UPDATE `account_head` SET `head_name` = '$board',`sort` = '$flock' WHERE `account_head`.`head_name` = '$name';";
	$query=mysqli_query($con,$sql);
header('location: manage_account_heads.php');
	
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
	<br>
		<label >Enter <?php echo ucfirst($page_name); ?> Name</label>
	<br>
	<input type="text" required name="board" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Name"  value="<?php $row=mysqli_fetch_array($query); echo $row[0]; ?>" >
	<input type="hidden" required name="flock" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Sort"  value="<?php  echo $row[1]; ?>" >
	<br>
	<input type="submit" name="submit" value="Update Now" class="btn-sm btn-lg form-group btn-primary col-2">

	<br>
</form>
</body>
</html>
