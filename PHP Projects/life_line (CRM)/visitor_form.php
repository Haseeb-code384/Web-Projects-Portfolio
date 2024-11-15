<?php 
//session_start();
//$current_user=$_SESSION['email'];
include( "config.php" );
include( "allFunctions.php" );
if(isset($_REQUEST['submit']))
{
	
	$name=$_REQUEST['name'];
	$employee_type=$_REQUEST['employee_type'];
	$army_no=$_REQUEST['army_no'];
	$rank=$_REQUEST['rank'];
	$unit=$_REQUEST['unit'];
	$cnic=$_REQUEST['cnic'];
	$purpose=$_REQUEST['purpose'];
	$cor=$_REQUEST['cor'];
	$mobile=$_REQUEST['mobile'];
	$address=$_REQUEST['address'];
	$card_id=$_REQUEST['card_id'];
	$gate=$_REQUEST['gate'];
	
	$sqlvis="INSERT INTO `visitor` (`id`, `name`, `type`, `army_no`, `rank`, `unit`, `cnic`, `purpose`, `cor`, `mobile`, `address`, `card_id`, `time_in`, `time_out`, `created_at`, `created_by`, `visit_date`, `gate`) VALUES (NULL, '$name', '$employee_type', '$army_no', '$rank', '$unit', '$cnic', '$purpose', '$cor', '$mobile', '$address', '$card_id', '$currentDateTime', '0000-00-00 00:00:00.000000', '$currentDateTime', '','$date','$gate')";
	//echo $sqlvis;
	$queryvis=mysqli_query($con,$sqlvis);
	if($queryvis)
	{
		echo "<script>alert('Visitor Added');</script>";
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

	<?php 
include "start.php"; ?>
	</div>

	<div class="content-wrapper">
		<div class="container-fluid">
			<?php breadcrumb(); ?>
			<div class="row" style="">
				<form method="post">
					<div class="border col-lg-12">

						<div class="row">
							<div class="col-6">

								<label><strong  class="text-danger">Visitor Type:</strong></label>
								<select class="form-select" required name="employee_type">
									<?php populateDD("employee_type","employee_type","employee_type") ?>
								</select>
							</div>
							<div class="col-6">
								<label><strong>Army Number / Per No: </strong></label><input class="form-control" type="text" name="army_no" title="Enter Army No"  placeholder="Enter Army No / Per No">
							</div>
						</div>

						<div class="row">


							<div class="col-6">
								<label><strong>Rank/Trade: </strong></label>
								<input type="text" name="rank" placeholder="Enter Rank" class="form-control">
							</div>
							<div class="col-6">
								<label><strong  class="text-danger">Visitor Name: </strong></label><input class="form-control" type="text" name="name" required placeholder="Enter Visitor Name">
							</div>

						</div>
						<div class="row">


							<div class="col-6">
								<label><strong>Address: </strong></label>
								<input type="text" name="address" placeholder="Enter Address" class="form-control">
							</div>
							<div class="col-6">
								<label><strong  class="text-danger">Visit Purpose: </strong></label><input class="form-control" type="text" name="purpose" required placeholder="Enter Visit Purpose">
							</div>

						</div><div class="row">


							<div class="col-6">
								<label><strong>Unit: </strong></label>
								<input type="text" name="unit" placeholder="Enter Unit" class="form-control">
							</div>
							<div class="col-6">
								<label><strong >Reference By: </strong></label><input class="form-control" type="text" name="cor"  placeholder="Enter Reference By">
							</div>

						</div>
												<div class="row">

							<div class="col-6">


								<label><strong  class="text-danger">CNIC: </strong></label><input class="form-control" type="text" required name="cnic" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" placeholder="xxxxx-xxxxxxx-x" title="format is xxxxx-xxxxxxx-x ">
							</div>

							<div class="col-6">

								<label><strong  class="text-danger">Mobile: </strong></label><input required class="form-control" type="text" name="mobile" placeholder="923xxxxxxxxx" pattern="923([0-9])[0-9]{8}" title="923xxxxxxxxx">
							</div>
						</div>

						<div class="row">

							<div class="col-6">
								<label><strong  class="text-danger">Visitor Card#: </strong></label><input class="form-control" type="text" name="card_id" required >
							</div>
							<div class="col-6">
							
								<label><strong  class="text-danger">Gate:</strong></label>
								<select class="form-select" required name="gate">
									<?php populateDD("gate","gate_name","gate_name") ?>
								</select>
</div>
							
							
						</div>






						<div class="col-12 text-center">
							<br>
							<input type="submit" name="submit" class="btn-sm btn-primary">
							<input type="reset" class="btn-sm btn-secondary" value="Clear All">
						</div>

					</div>
					
			</div>
			</form>
			
		</div>
	</div>
	<br>
	<br>
	<br>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>

	<script>
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>