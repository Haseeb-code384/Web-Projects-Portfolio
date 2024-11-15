<?php
include('config.php');
include('allFunctions.php');
$page_name="Account Head";
if(isset($_REQUEST['submit']))
{
	$sort=getNextId('sort','account_head');
	$board=strtoupper($_REQUEST['board']);
	$sql="INSERT INTO `account_head` (`head_name`,`sort`) VALUES ('$board','$sort');";
	$query=mysqli_query($con,$sql);
	if($query)
    {
        alertredirect("Head Inserted Successfully","manage_account_heads.php");
    }
    else
    {
        alertredirect("Something Went Wrong!!!","manage_account_heads.php");
    }
	
}

 include('start.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($project_name); ?></title>
</head>
<body>
	<div class="content-wrapper">
	
<?php breadcrumb(); ?>
<center>
<form method="post">
	<label class=" h3">Enter <?php echo ucfirst($page_name); ?> Name</label>
	<br>
	<input type="text" required name="board" class="form-group form-control col-2" placeholder="Please Enter <?php echo ucfirst($page_name); ?> Name">
	<br>
	<input type="submit" name="submit" class="btn-sm btn-lg form-group btn-primary col-2">
</form>

<?php include("fix_header.php"); ?>
		<tr>
			<th><?php echo ucfirst($page_name); ?> Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql="select * from  account_head order by sort";
		$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query))
		{	
		?>
			<tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
			<td><?php echo($row[0]); ?></td>
			<td><a  href="edit_account_heads.php?name=<?php echo($row[0]); ?>"><button class="btn-sm btn-success"><i class="fa fa-edit"></i></button></a>
			<button class="btn-sm btn-danger btn-lg" onDblClick="window.location.href='del.php?delbrd=<?php echo($row[0]); ?>';" title="Double Click To Delete"><i class="fa fa-trash"></i></button>
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
