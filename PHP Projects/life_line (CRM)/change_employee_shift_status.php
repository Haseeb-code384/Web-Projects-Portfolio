<?php
include("config.php");
include("allFunctions.php");
include("filter_php.php");

?>
<!DOCTYPE html>
<html>
<head>
	<script src="js/selectall.js"></script>
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
				<div class="row" style="">
			
		
		<?php breadcrumb(); ?>
					<?php include("filter_employee_form.php"); ?>
			<form action="process_employee_shift_status_change.php">
			<div class="border col-lg-12">
				<div class="form-group vAlign">
					<label><strong>Status: </strong><select class="form-select" required name="shift_name">
									<?php populateDD("status_list","status_name","status_name") ?>
								</select> </label>
					
					<br/>
					
					<label class=""><strong>Start Date:</strong> <input class="form-control input-lg" type="date" required name="strat_date"></label>
					<br/>
					<label class=""><strong>End Date: </strong><input class="form-control input-lg" type="date" required name="end_date" value=""></label>
					<br>
					<br>
					<input type="submit" formaction="reports/shift_allocation.php" value="View Allocation" formtarget="_new">
					<input type="submit" name="submit" class="btn-sm btn-primary">
				</div>
			</div>
		</div>
	
				<div class="table-responsive" >
					<table class="table table-striped table-hover" id="" onload="alert('done');">
						<thead>
							
							<tr>
							<th align="center" colspan="6"><?php 
		echo mysqli_num_rows($queryview); ?> Employees Found</th>
							</tr>
								<tr>
								<th><input type="checkbox" id="select-all" onClick="selall(this,'emp[]');">Army No</th>
								<th>Name</th>
								<th>Rank</th>
								<th>Branch</th>
								<th>Type</th>
								<th>Profession</th>
								<th>Current Shift</th>
								</tr>

						</thead>
						<tbody>
							<?php
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								
								<td><input type="checkbox" value="<?php echo $rowview['id']; ?>" name="emp[]"><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo  showQuery("SELECT subhead_name FROM `account_subhead` WHERE id='$rowview[3]'") ; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php if(isset($_REQUEST['shift_name']))
							{
								if($_REQUEST['shift_name']=="shift_name")
								{
									echo showQuery("SELECT shift_name FROM `employee_shift_allocation` WHERE employee='$rowview[6]' AND date='$date'");
								}
								else
								{
									
								echo $rowview[7];
								}
								
							}
								else
								{
									echo showQuery("SELECT shift_name FROM `employee_shift_allocation` WHERE employee='$rowview[6]' AND date='$date'");
								}
									?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
	</div>
	</form>
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