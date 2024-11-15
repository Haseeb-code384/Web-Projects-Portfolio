<?php
include('config.php');
include('allFunctions.php');

if(isset($_REQUEST['submit']))
{
	$name=strtoupper($_REQUEST['name']);
	$num=$_REQUEST['num'];
	$salary=$_REQUEST['salary'];
	$farm=$_REQUEST['farm'];
	$sql="INSERT INTO `employee` (`id`, `name`, `number`, `farm_id`, `salary`, `joining_date`, `active`) VALUES (NULL, '$name', '$num', '$farm', '$salary', '$currentDateTime', '1')";
	$query=mysqli_query($con,$sql) or die(mysqli_error($con));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo($project_name); ?></title>
	
   <script src="semesters.js"></script>
</head>
<?php include('start.php'); ?>
<body>
	<div class="content-wrapper">
	<div class="col-lg-12">
<div class="breadcrumb h1"><i class="fa fa-user"></i> Manage Employee</div>

<form method="post">
	<div class="row">
	<div class="form-group col-sm-6">
	<label >Enter Employee Name</label>
	<br>
	<input type="text" required name="name" class="form-group form-control" placeholder="Please Enter Employee Name">
	
	</div>
	
	<div class="form-group col-sm-6">
	<label >Enter Employee Number</label>
	<br>
	<input type="text" name="num" class="form-group form-control" placeholder="Enter Employee Number"  required pattern="923([0-9])[0-9]{8}">
	</div>
		</div>
	<div class="row">
	<div class="form-group col-sm-4">
	<label >Enter Employee Salary</label>
	<br>
	<input type="number" required name="salary" class="form-group form-control" placeholder="Please Enter Salary">
	</div>
	<br><div class="form-group col-sm-4">
                                <label class="label_start">Select Unit</label>
                                <select id="programdd" onchange="change_semester()" class="form-control" name="board" required>
                                      <option value="">Select Unit</option>
                                       <?php populateDDdistinct("board_name","units") ?>
                                   </select>
                                
                            </div><div class="form-group col-sm-4">
                                <label class="label_start">Select Farm</label>
                                <div id="semester">
                                     <select class='form-control' >
                                           <option value="">Select Farm</option>
                                        
									</select></div></div>
   
	</div>
	
	                         <center>
								 
	<input type="submit" name="submit" class="btn-sm btn-lg form-group btn-primary col-6">
	</center>
</form>
</div>
<table border="1|0" class="table table-striped table-hover text-center" >
	<thead style="background-color: antiquewhite;">
		<tr>
			<th>Employee ID</th>
			<th>Employee Name</th>
			<th>Number</th>
			<th>Unit / Farm </th>
			<th>Salary</th>
			
			<th>Joining Date</th>
			<th>Active</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql="select * from employee";
		$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query))
		{	
		?>
		<tr>
			<td><?php echo($row[0]); ?></td>
			<td><?php echo($row[1]); ?></td>
			<td><?php echo($row[2]); ?></td>
			<td><?php echo showQuery("SELECT concat('Unit: ',board,' Farm:',c_name) FROM `farms` WHERE id='$row[3]'"); ?></td>
			<td><?php echo($row[4]); ?></td>
			<td><?php echo($row[5]); ?></td>
			<?php
			$color="green";
			$toggle="";
			if($row[6]==0)
			{
				$color="grey";
				$toggle=" fa-rotate-180";
			}
			?>
			<td>
			<a href="setempactive.php?emp=<?php echo($row[0]); ?>&c=<?php echo $color; ?>"><i style='color: <?php echo $color; ?>;' class='fa fa-2x fa-toggle-on<?php echo $toggle ?>'></i></a></td>
			<td>
			<a href="update_employee.php?emp=<?php echo($row[0]); ?>"><button class="btn-sm btn-success btn-lg">Update</button></a>
			<a href="del.php?delemp=<?php echo($row[0]); ?>"><button class="btn-sm btn-danger btn-lg">Delete</button></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
	
</table>
	</div>
	<br>
	<br>
	<br>
</body>
</html>
