
	<script type="text/javascript">

		
function nopersons(x)
		{
			x=parseInt(x);
			
  var table = document.getElementById("tabody");
			document.getElementById("tabody").innerHTML="";
			for(var i=1;i<=x;i++)
				{
			
  var row = table.insertRow(-1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
					
				
					
  cell1.innerHTML = "<input type='text' class='form-control' name='person_name[]' placeholder='Person "+i+" Name' required> ";
  cell2.innerHTML = "<input type='text' class='form-control' name='person_army_no[]' placeholder='Person "+i+" Army No'>";
  cell3.innerHTML = "<input type='text' class='form-control' name='person_cnic[]' placeholder='Person "+i+" CNIC xxxxx-xxxxxxx-x' pattern='[0-9]{5}-[0-9]{7}-[0-9]{1}' title='format is xxxxx-xxxxxxx-x '>";
					
				}
		}
</script>
<?php 
include( "config.php" );
include( "allFunctions.php" );
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
				<form method="post" action="process_vehicle_insert.php">
					<div class="border col-lg-12">

						<div class="row">
							<div class="col-6">

								<label><strong  class="text-danger">Vehicle Type:</strong></label>
								<select class="form-select" required name="vehicle_type">
									<option value="">Select</option>
									<option>Car</option>
									<option>Bus</option>
									<option>Truck</option>
									<option>Van</option>
									<option>Motorcycle</option>
									<option>Other</option>
								</select>
							</div>
							<div class="col-6">
								<label><strong>Driver Army Number / Per No: </strong></label><input class="form-control" type="text" name="army_no" title="Enter Army No"  placeholder="Enter Army No / Per No">
							</div>
						</div>

						<div class="row">


							<div class="col-6">
								<label><strong class="text-danger">Vehicle Number: </strong></label>
								<input type="text" name="vehicle_no" required placeholder="LEB 1234" class="form-control">
							</div>
							<div class="col-6">
								<label><strong  class="text-danger">Driver Name: </strong></label><input class="form-control" type="text" name="name" required placeholder="Enter Vehicle Name">
							</div>

						</div>
						<div class="row">


							<div class="col-6">
								<label><strong  class="text-danger">Visit Purpose: </strong></label><input class="form-control" type="text" name="purpose" required placeholder="Enter Visit Purpose">
							</div>
<div class="col-6">
							
								<label><strong  class="text-danger">Gate:</strong></label>
								<select class="form-select" required name="gate">
									<?php populateDD("gate","gate_name","gate_name") ?>
								</select>
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
								<label><strong  class="text-danger">Number of Persons: </strong></label><input class="form-control" type="number" name="persons" required placeholder="Enter Number of persons" value="0" onKeyUp="nopersons(this.value);">
							</div>
							<div class="col-6">
								<label><strong >Remarks: </strong></label><input class="form-control" type="text" name="description"  placeholder="Enter Remarks">
							</div>
						</div>
						<br>
						<div class="table">
						<table class="table table-striped table-bordered" id="myTable">
							
<!--
							<tr align="center">
							<th colspan="3">Persons Details</th>
							</tr>
							<tr align="center">
							
							<th>Person Name</th>
							<th>Person Army No</th>
							<th>CNIC</th>
							</tr>
							
-->
							<tbody id="tabody">
							
								</tbody>
				</table>
		
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