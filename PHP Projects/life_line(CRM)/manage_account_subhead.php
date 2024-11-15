<?php
include('config.php');
include('allFunctions.php');
$page_head="Account Head";
$page_name="Account Sub Head";
if(isset($_REQUEST['submit']))
{
	$board=ucfirst($_REQUEST['board']);
	$class_name=strtoupper($_REQUEST['class_name']);

	$description=$_REQUEST['description'];
	$sql="INSERT INTO `account_subhead` (`subhead_name`, `head_name`, `description`) VALUES ('$class_name','$board','$description');";
	$query=mysqli_query($con,$sql);
	if($query)
    {
        alertredirect("Subhead Inserted Successfully","manage_account_subhead.php");
    }
    else
    {
        alertredirect("Something Went Wrong!!!","manage_account_subhead.php");
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($project_name); ?></title>
</head>
<?php include('start.php'); ?>
<body>
	<div class="content-wrapper">
	
<?php breadcrumb(); ?>

<center>
<form method="post">
	
	<label class="h3">Select <?php echo $page_head; ?> </label>
	<select name="board" class="form-control col-2" required>
	<?php 	populateDDdistinct("head_name","account_head")?>
	</select>
	
	<br>
	<label class="h2">Enter <?php echo(ucfirst($page_name)); ?> Name</label>
	<br><input type="text" required placeholder="Enter <?php echo(ucfirst($page_name)); ?> Name" name="class_name"  class="form-control col-2">
	<br>
	<label class="h2">Enter <?php echo(ucfirst($page_name)); ?> Description</label>
	<br><input type="text"  placeholder="Enter <?php echo(ucfirst($page_name)); ?> Description" name="description"  class="form-control col-2">
	<br>
	
	<input type="submit" name="submit"  class="btn-sm btn-lg form-group btn-primary col-2">
</form>
<?php include("fix_header.php"); ?>
		<tr>
			<th><?php echo $page_name ?> ID</th>
			<th><?php echo $page_head; ?> Name</th>
			<th><?php echo $page_name; ?> Name</th>
			<th>Description</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql="select * from account_subhead";
		$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query))
		{	
		?>   <tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"  >
    
			<td><?php echo($row[0]); ?></td>
			<td><?php echo($row[1]); ?></td>
			<td><?php echo($row[2]); ?></td>
			<td><?php echo($row[3]); ?></td>
			<td>
			
                
                <a  href="edit_account_subheads.php?subhead=<?php echo $row[0] ?>"><button class="btn-sm btn-success"><i class="fa fa-edit"></i></button></a>
			<button class="btn-sm btn-danger btn-lg" onDblClick="window.location.href='del.php?delsubhead=<?php echo $row[0] ?>';" title="Double Click To Delete"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
		<?php } ?>
	</tbody>
	
</table>
	</div>
		<br>
		<br>
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
