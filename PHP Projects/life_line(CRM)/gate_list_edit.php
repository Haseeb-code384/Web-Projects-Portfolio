<?php
include("config.php");
include("allFunctions.php");

	$gate_name=$_REQUEST['gate'];
$sqlview="SELECT * FROM `gate` where gate_name='$gate_name'";
							$queryview=mysqli_query($con,$sqlview);
$rowview=mysqli_fetch_array($queryview);
							
if(isset($_REQUEST['submit']))
{
	$gate_name=$_REQUEST['gate_name'];
	$gate_ip=$_REQUEST['gate_ip'];
	$old_name=$_REQUEST['old_name'];

	$sql="UPDATE `gate` SET `gate_name` = '$gate_name', `device_ip` = '$gate_ip' WHERE `gate`.`gate_name` = '$old_name'";
	echo $sql;
	$query=mysqli_query($con,$sql);
header("Location: gate_list.php");	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	<?php include("start.php"); ?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="background-color: grey">
			
		
			<form>
			<div class="border col-lg-12">
				<div class="form-group vAlign">
					<label>Gate Name: <input class="form-control input-lg" type="text" name="gate_name" required  value="<?php echo $rowview[0]; ?>">
					<input class="form-control input-lg" type="hidden" name="old_name" required value="<?php echo $rowview[0]; ?>">
					</label>
					<br/>
					<br/>
					<label class="">Device IP: <input class="form-control input-lg" type="text" required name="gate_ip" value="<?php echo $rowview[1]; ?>"></label>
					<br/>
					<br/>
					<br>
					<br>
					<input type="submit" value="Update" name="submit" class="btn-sm btn-success">
				</div>
			</div>
		</div>
			</form>
	</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>