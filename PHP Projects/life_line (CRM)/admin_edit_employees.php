<?php
include("config.php");
include("allFunctions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<?php include("preloader.php"); ?>
	
	<?php 
include "start.php"; ?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="col-lg-12">
			<?php breadcrumb("admin_edit_employees.php"); ?>
				<div class="table-responsive" >
					<table class="table" id="employee_data" onload="alert('done');">
						<thead>
							<tr>
								<th>Action</th>
								<th>ID</th>
								<th>Army No</th>
								<th>Name</th>
								<th>Rank</th>
								<th>Blood Group</th>
								<th>Branch</th>
								<th>Employee Type</th>
								<th>Profession</th>
								<th>Gate</th>
								<th>Mobile</th>
								<th>CNIC</th>
								<th>Created At</th>
								<th>Created By</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$sqlview="SELECT * FROM `employee`";
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview))
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								
								<td>
									<?php if($rowview[10]=="0")
							{
									?>
								<a href="enroll_employee.php?gate=<?php echo $rowview[7]; ?>&emp=<?php echo $rowview[0]; ?>"><button>Enroll</button></a>
									<?php }
									else { echo ""; } ?>
								<button onclick="window.open('add_user_in_device.php?emp=<?php echo $rowview['id']; ?>&name=<?php echo $rowview[1]; ?>&gate=<?php echo $rowview[7]; ?>')"><i class="fa fa-hand-pointer-o"></i></button>
								
								<a href="chart_of_account_edit.php?emp=<?php echo $rowview[0]; ?>"><button>Edit</button></a>
									
								<a href="chart_of_account_delete.php?chart_of_account_id=<?php echo $rowview[0]; ?>"><button>Delete</button></a>
									
								</td>
								<td><?php echo $rowview['id']; ?></td>
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td><td><?php echo  showQuery("SELECT subhead_name FROM `account_subhead` WHERE id='$rowview[4]'") ; ?></td>
								
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td><?php echo $rowview[7]; ?></td>
								<td><?php echo $rowview[8]; ?></td>
								<td><?php echo $rowview[9]; ?></td>
								<td><?php echo $rowview[11]; ?></td>
								<td><?php echo $rowview[12]; ?></td>
								
								
								

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
<!--

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
-->
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