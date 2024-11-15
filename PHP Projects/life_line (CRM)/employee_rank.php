<?php
include("config.php");
include("allFunctions.php");
include("start.php");

if(isset($_REQUEST['submit']))
{
	$employee_rank=$_REQUEST['employee_rank'];
	$auth=$_REQUEST['auth'];
	$sql="INSERT INTO `employee_rank` (`employee_rank`, `auth`)) VALUES ('$employee_rank','$auth')";
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
			
			<div class="breadcrumb h1"><i class="fa fa-fw fa-user"></i>Manage Employee Rank</div>
			<form>
			<div class="col-lg-12">
				<div class="form-group vAlign">
					<label><strong>Employee Rank: </strong><input class="form-control input-lg" type="text" required placeholder="Enter Employee Rank" name="employee_rank" ></label>
					<br>
					<label><strong>Total Auth: </strong><input class="form-control input-lg" type="text" required placeholder="Enter Employee Auth" name="auth" ></label>
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
								<th>Employee Rank</th>
								<th>Auth</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							$sqlview="SELECT * FROM `employee_rank`";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td>
									
									<a href="edit_employee_rank.php?val=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-info">Edit</button></a>
									<a href="del.php?del_emp_rank=<?php echo $rowview[0]; ?>"><button class="btn-sm btn-danger">Delete</button></a></td>
								
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