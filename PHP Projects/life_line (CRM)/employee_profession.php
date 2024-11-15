<?php

include("config.php");
include("allFunctions.php");
include("start.php");

if(isset($_REQUEST['submit']))
{
	$employee_profession=$_REQUEST['employee_profession'];
	$sql="INSERT INTO `employee_profession` (`employee_profession`) VALUES ('$employee_profession')";
	$query=mysqli_query($con,$sql);
	if($query)
	{
		echo "<script>alert('Record Entered Successfully');</script>";
	}
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
	
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row" style="">
			
			
		
			
			<div class="breadcrumb h1"><i class="fa fa-fw fa-user"></i>Manage Employee Profession</div>
			<form>
			<div class="col-lg-12">
				<div class="form-group vAlign">
					<label><strong>Employee Profession:</strong> <input class="form-control input-lg" type="text" required name="employee_profession" placeholder="Enter Profession" ></label>
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
								<th>Employee Profession</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							$sqlview="SELECT * FROM `employee_profession`";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td>
									
									<a href="edit_employee_profession.php?val=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-info">Edit</button></a>
									<a href="del.php?del_emp_profession=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-danger">Delete</button>
									</a>
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
		<br>
		<br>
</body>
</html>