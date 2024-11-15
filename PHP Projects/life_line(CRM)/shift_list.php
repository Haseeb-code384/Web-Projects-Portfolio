<?php

include("config.php");
include("allFunctions.php");
if(isset($_REQUEST['submit']))
{
	$shift_name=$_REQUEST['shift_name'];
	$early_start=$_REQUEST['early_start'];
	$start_time=$_REQUEST['start_time'];
	$end_time=$_REQUEST['end_time'];
	$late_finish=$_REQUEST['late_finish'];

	$sql="INSERT INTO `shift` (`shift_name`, `start_time`, `end_time`, `early_start`, `late_finish`, `active`) VALUES ('$shift_name', '$start_time', '$end_time', '$early_start', '$late_finish', '1')";
	$query=mysqli_query($con,$sql);
	
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
		<div class="row" style="">
			
		
			<?php breadcrumb(); ?>
			<form>
			<div class="col-lg-12">
				<div class="form-group vAlign">
					<label><strong>Shift Name: </strong><input class="form-control input-lg" type="text" name="shift_name" required> </label>
					<br/>
					<br/>
					
					<label class=""><strong>Early Start: </strong><input class="form-control input-lg" type="time" required name="early_start" value=""></label>
					<br/>
					<br/>
					<label class=""><strong>Start Time: </strong><input class="form-control input-lg" type="time" required name="start_time" value=""></label>
					<br/>
					<br/>
					
					<label class=""><strong>End Time: </strong><input class="form-control input-lg" type="time" required name="end_time" value=""></label>
					<br/>
					<br/>
					<label class=""><strong>Late Finish: </strong><input class="form-control input-lg" type="time" required name="late_finish" value=""></label>
					<br/>
					<br/>
					<br>
					<br>
					<input type="submit" name="submit" class="btn-sm btn-primary">
				</div>
			</div>
		</div>
			</form>
		<div class="col-lg-12">
				<table class="table table-striped table-hover">
						<thead>
							
							<tr>
								<th>Shift Name</th>
								<th>Early Start</th>
								
								<th>Start Time</th>
								<th>End Time</th>
								<th>Late Finish</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							$sqlview="SELECT * FROM `shift`";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
							
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td>
									
									<a href="shift_list_edit.php?shift=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-success">Edit</button></a>
									<a href="del.php?shift=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-danger">Delete</button></a>
							</td>
								
							</tr>
							
							<?php } ?>
							</tbody>
					</table>
			</div>
	</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>