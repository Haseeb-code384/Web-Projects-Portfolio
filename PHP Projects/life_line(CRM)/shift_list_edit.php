<?php
include("config.php");
include("allFunctions.php");

	$shift_name=$_REQUEST['shift'];
$sqlview="SELECT * FROM `shift` WHERE shift_name='$shift_name'";
							$queryview=mysqli_query($con,$sqlview);
$rowview=mysqli_fetch_array($queryview);
							
if(isset($_REQUEST['submit']))
{
	
	$old_name=$_REQUEST['old_name'];
	$shift_name=$_REQUEST['shift_name'];
	$start_time=$_REQUEST['start_time'];
	$end_time=$_REQUEST['end_time'];
	
	$early_start=$_REQUEST['early_start'];
	$late_finish=$_REQUEST['late_finish'];
	$active=$_REQUEST['active'];
	
	$sql="UPDATE `shift` SET `shift_name`='$shift_name',`start_time`='$start_time',`end_time`='$end_time',`early_start`='$early_start',`late_finish`='$late_finish',`active`='$active' WHERE `shift_name`='$old_name'";
	
	$query=mysqli_query($con,$sql);
header("Location: shift_list.php");	
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
							<label>Shift Name: <input class="form-control input-lg" type="text" name="shift_name" required value="<?php echo $rowview[0] ?>"><input class="form-control input-lg" type="hidden" name="old_name" required value="<?php echo $rowview[0] ?>"> </label>
					<br/>
					<br/>
					<label class="">Early Start: <input class="form-control input-lg" type="time" required name="early_start" value="<?php echo $rowview[3] ?>"></label>
					<br/>
					<br/>
					
					<label class="">Start Time: <input class="form-control input-lg" type="time" required name="start_time"  value="<?php echo $rowview[1] ?>"></label>
					<br/>
					<br/>
					<label class="">End Time: <input class="form-control input-lg" type="time" required name="end_time"  value="<?php echo $rowview[2]; ?>"></label>
					<br/>
					<br/>
					<label class="">Late Finish: <input class="form-control input-lg" type="time" required name="late_finish" value="<?php echo $rowview[4] ?>"></label>
					<br/>
					<br/>
					<label class="">Active: <select class="form-select" name="active" required>
						<option value="1" <?php if($rowview[5]==1) echo 'selected'; ?> >Active</option>
						<option value="0" <?php if($rowview[5]==0) echo 'selected'; ?>>Inactive</option>
						</select></label>
					<br/>
					<br/>
					<br>
					<br>
					<input type="submit" name="submit" value="Update" class="btn-sm btn-success">
			
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