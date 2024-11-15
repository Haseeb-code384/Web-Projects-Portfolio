<?php
include("config.php");
include("allFunctions.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> All Vouchers </title>
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		
			</form>
		<div class="col-lg-12">
			
<div class="breadcrumb h1"><i class="fa fa-list"></i>Demand List</div>
				<div class="table-responsive" >
					<table class="table" id="employee_data">
						<thead>
							<tr>
								<th>Demand#</th>
								<th>Date</th>
								<th>Remarks</th>
								<th>Salesman ID</th>
								<th>Salesman Name</th>
								<th>Entered At</th>
								<th>Entered BY</th>
<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sqlview="SELECT id,date,demand.remarks,salesman,master_account.account,timestamp,entered_by FROM demand,master_account WHERE salesman=master_account.m_accountid ORDER BY id DESC";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td>
									<button>
									<a title="View Voucher" target="new" href="demand_voucher.php?demand_id=<?php echo $rowview[0];?>">View</button></a></button>
							<button>
									<a title="View Voucher" href="del.php?deldailyvoucher=<?php echo $rowview[0];?>">Delete</button></a></button>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
	</div>
	</div>
<br>
<br>
<br>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
 <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
 <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />            
 
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script> 
</body>
</html>