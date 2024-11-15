<?php
include('config.php');
include('allFunctions.php');
$emp=$_REQUEST['emp'];
		$sqle="select * from employee where id='$emp'";
		$querye=mysqli_query($con,$sqle);
		$rowe=mysqli_fetch_array($querye);
if(isset($_REQUEST['submit']))
{
	$name=strtoupper($_REQUEST['name']);
	$num=$_REQUEST['num'];
	$salary=$_REQUEST['salary'];
	$farm=$_REQUEST['farm'];
	$sql="UPDATE `employee` SET `name` = '$name', `number` = '$num', `farm_id` = '$farm', `salary` = '$salary' WHERE `employee`.`id` = $emp";
	$query=mysqli_query($con,$sql) or die(mysqli_error($con));
	alertredirect("Employee Updated Successfully","manage_employee.php");
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
	<input type="text" required name="name" class="form-group form-control" placeholder="Please Enter Employee Name" value="<?php echo $rowe[1]; ?>">
	
	</div>
	
	<div class="form-group col-sm-6">
	<label >Enter Employee Number</label>
	<br>
	<input type="text" name="num" class="form-group form-control" placeholder="Enter Employee Number"  required pattern="923([0-9])[0-9]{8}"  value="<?php echo $rowe[2]; ?>">
	</div>
		</div>
	<div class="row">
	<div class="form-group col-sm-4">
	<label >Enter Employee Salary</label>
	<br>
	<input type="number" required name="salary" class="form-group form-control" placeholder="Please Enter Salary"  value="<?php echo $rowe[4]; ?>">
	</div>
	<br><div class="form-group col-sm-4">
                                <label class="label_start">Select Unit</label>
                                <select id="programdd" onchange="change_semester()" class="form-control" name="board" required>
                                      <option value="">Select Unit</option>
                                       <?php 
									$un=showQuery("SELECT board FROM `farms`WHERE id='$rowe[3]'");
									populateDDsel("units","board_name","board_name",$un); ?>
                                   </select>
                                
                            </div><div class="form-group col-sm-4">
                                <label class="label_start">Select Farm</label>
                                <div id="semester">
                                     <select class='form-control' >
                                        <?php populateDDsel("farms","c_name","id",$rowe[3]) ?>
									</select></div></div>
   
	</div>
	
	                         <center>
								 
	<input type="submit" value="Update" name="submit" class="btn-sm btn-lg form-group btn-success col-6">
	</center>
</form>
</div>
	</div>
	<br>
	<br>
	<br>
</body>
</html>
