<?php
include("config.php");
include("allFunctions.php");
$gate="gate";

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
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<?php breadcrumb(); ?>
		<div class="col-lg-12">
				 <?php include("fix_header.php"); ?>
							<tr>
								<th>ID</th>
								<th>Type</th>
								<th>Vehicle No</th>
								<th>Driver Name</th>
								<th>Driver Army#</th>
								<th>Driver Cnic</th>
								<th>Purpose</th>
								<th>Mobile</th>
								<th>Persons</th>
								<th>Remarks</th>
								<th>Time In</th>
								<th>Time Out</th>
								<th>Gate</th>
								<th>Created By</th>
								
		
							</tr>
						</thead>
						<tbody>
							<?php
							$sqlview="SELECT * FROM `vehicle` WHERE gate=gate AND date(created_at)='$date' ORDER BY vehicle_id DESC";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								
								<td>
									<?php echo $rowview[0]; ?> <br>
									<?php if($rowview[11]=="0000-00-00 00:00:00")
							{
									?>
								<a href="del.php?vehicle_out=<?php echo $rowview[0]; ?>"><button>Out</button></a>
									<?php } ?>
								
								</td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td><?php echo $rowview[7]; ?></td>
								<td><?php echo $rowview[8]; ?></td>
								<td><?php echo $rowview[9]; ?></td>
								<td><?php echo $rowview[10]; ?></td>
								<td><?php echo $rowview[11]; ?></td>
								<td><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
								
								
								

							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
	</div>
<br>
<br>
<br>

 
 <script src="vendor/jquery/jquery.js"></script>  
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
 <script src="vendor/datatables/jquery.dataTables.js"></script>  
 <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
 <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.js" />            
 
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script> 
</body>
</html>