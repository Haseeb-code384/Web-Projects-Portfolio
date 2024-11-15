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
	<?php include("fix_header.php"); ?>
								<th>Voucher #</th>
								<th>Date</th>
								<th>Remarks</th>
								<th>Type</th>
								<th>Total Cr</th>
								<th>Total Dr</th>
<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sqlview="SELECT * FROM `daily_voucher` ORDER by id DESC";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview))
							{
							?>
							<tr>
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td>
									<button>
									<a title="View Voucher" target="new" href="view_dailyvoucher.php?id=<?php echo $rowview[0];?>">View</button></a></button>
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
      $('#employee_data').DataTable();  
 });  
 </script> 
</body>
</html>