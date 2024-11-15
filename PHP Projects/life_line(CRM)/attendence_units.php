<?php
include("config.php");
include('allFunctions.php');
include('start.php');

?><!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    
	<style>
		a {
		text-decoration: underline;}
		td > a {
  display: block;
}</style>
	
	
</head>

<body>

    <!doctype html>
<?php
	$_REQUEST['submit']=Null;

function  ins_result($roll,$status)
{
	include("config.php");
	$s_name=$_SESSION['subject'];
	$class=$_SESSION['class'];
	$semester=$_SESSION['semester'];
	$user=$_SESSION['login_user'];
//$sql="INSERT INTO `attendence` (`id`, `roll_no`, `subject_name`, `class`, `status`, `entry_date`,`semester`) VALUES (NULL, '$roll', '$s_name', '$class', '$status', '$currentDateTime','$semester');";
	$sql="INSERT INTO `attendence` (`id`, `roll_no`, `subject_name`, `class`, `semester`, `status`, `entry_date`, `date`, `time`, `lecture_number`,`taken_by`) VALUES (NULL, '$roll', '$s_name', '$class', '$semester', '$status', '$currentDateTime', now(), now(), '','$user')";
		
	$rs=mysqli_query($con,$sql) or die(mysqli_error($con));
if(!$rs)
{echo("data not inserted"); }

}
?>
<html>
<head>
<script src="semester.js"></script>

<meta charset="utf-8">
</head>

<body>
	<div class="content-wrapper">
	
<div class="breadcrumb h1"><i class="fa fa-calendar-check-o"></i>Take Attendence</div>

 <?php
	$sql="SELECT board,c_name,id FROM `farms`";
	
	$query=mysqli_query($con,$sql);
	
	
	?>
 <div align="center">
 <br><br>
<h1>Choose Farm For Attendence</h1>
 		
<table border="1|0" class="table table-striped table-hover text-center" >

	<thead style="background-color: antiquewhite;">
		<tr class=>
			

		<th>Unit Name</th>
 		<th>Farm Name</th>
			<th>Status</th>
		</tr></thead> 
	<?php $i=1; while($row=mysqli_fetch_array($query)){
	 ?>
	<tr>
		<?php 
	$sql_done="select distinct unit,farm from attendence WHERE date='$date' and farm='$row[2]'";
	//echo $sql_done;

		$row_done=mysqli_fetch_array(mysqli_query($con,$sql_done));
		if($row_done[0]!='')
		{	
			
		?><td><?php echo($row[0]);  ?></td><td><?php echo($row[1]);  ?></td><?php   }else{?>
		<td><a href="attendence.php?unit=<?php echo($row[1]);  ?>&section=<?php echo($row[0]);  ?>&farm=<?php echo $row[2]; ?>"><?php echo($row[0]);  ?></a></td>
		<td><a href="attendence.php?class=<?php echo($row[1]);  ?>&section=<?php echo($row[0]);  ?>&farm=<?php echo $row[2]; ?>"><?php echo($row[1]);  ?></a></td>
		<td><a href="monthly_report.php?farm=<?php echo $row[1]; ?>"><button>Show History</button></a><?php  }
			if($row_done[0]=='')
		{	
			
		?><i class="fa fa-calendar-check-o" style="color: green;"></i></td><?php   } else{ ?><td><i class="fa fa-calendar-times-o " style="color: red;"></i><?php }  ?></td>
		
	</tr>
	<?php $i++;} ?>
	
</table>
<br>
<br>
</div></div>
</body>
</html>

<!-- jQuery Version 3.1.1 -->
    <script src="lib/jquery/jquery.js"></script>
	<script type="text/javascript">
		                    
	
	</script>
    <!-- Tether -->
    <script src="lib/tether/tether.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>

    <!-- Chart.js -->
    <script src="lib/chart.js/Chart.min.js"></script>

    <!-- SB Admin JavaScript -->
    <script src="js/sb-admin.min.js"></script>

</body>

</html>
