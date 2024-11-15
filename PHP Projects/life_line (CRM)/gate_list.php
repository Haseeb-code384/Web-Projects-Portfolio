<?php

include("config.php");
include("allFunctions.php");
if(isset($_REQUEST['submit']))
{
	$gate_name=$_REQUEST['gate_name'];
	$gate_ip=$_REQUEST['gate_ip'];

	$sql="INSERT INTO `gate` (`gate_name`, `device_ip`, `department`) VALUES ('$gate_name', '$gate_ip', '1')";
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
					<label><strong>Gate Name:</strong> <input class="form-control input-lg" placeholder="Enter Gate Name" type="text" name="gate_name" required> </label>
					<br/>
					<br/>
					<label class=""><strong>Device IP:</strong> <input class="form-control input-lg"  placeholder="Enter IP" type="text" required name="gate_ip" value=""></label>
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
								<th>Gate Name</th>
								<th>Device IP</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							$sqlview="SELECT * FROM `gate`";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td>
									
									<a href="gate_list_edit.php?gate=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-success">Edit</button></a>
									<a href="del.php?gate=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-danger">Delete</button></a>
									<a target="new" href="biometric_device_info.php?gate=<?php echo $rowview[0]; ?>&ip=<?php echo $rowview[1]; ?>"><button class="btn-sm btn-info">Device Info</button></a>
									<button class="btn-sm btn-warning" onclick="window.open('get_attendence_data.php?ip=<?php echo $rowview[1]; ?>');">Sync</button>
																
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