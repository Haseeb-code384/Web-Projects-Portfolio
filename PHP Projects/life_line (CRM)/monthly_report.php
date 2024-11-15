<?php
include("config.php");

?><!DOCTYPE html>
<html lang="en">

<head>
    
	
</head>

<body>
    <div class="breadcrumb h1"><i class="fa fa-street-view"></i> Employee Month Report</div>


    <!-- Navigation -->
<?php include('start.php'); ?>    
    
    <!doctype html>
<?php
	$date=$month; 
	
?>
<html>


<body style="margin-top: 20px;">
	<div class="content-wrapper">
	
	<div class="clearfix"></div>
<center>
	<form method="post" class="">
		<input type="month" name="date" class="form-control col-2" />
		<input type="submit" name="submit"  class="btn-sm btn-lg form-group btn-primary col-2"/>
	</form></center>
 <div align="center">
  
<br>
</div>
<?php 
	if(isset($_REQUEST['submit']))
	{
		$date=$_REQUEST['date'];
	}
	
	$sql="SELECT * from employee,attendence where date like '$date-__' and employee.id=attendence.emp_id";
	echo $sql;
	$query=mysqli_query($con,$sql);
	
$rows=mysqli_fetch_array($query);
	if($rows[0]!=NULL)
	{
	?>

<div align="center">
	<h3>Selected Month<?php  echo(' '.$date); ?></h3>
<table border="1|0" class="table table-striped table-hover text-center" >

	<thead style="background-color: antiquewhite;">
		<tr class="h2">
<th height="23">Sn</th>
<th width="180" >Name</th>
<th align="center" colspan="2" >Status</th>
<th align="center" >Details</th>

		</tr></thead>
<?php $i=1;
	$sql="SELECT * from employee,employee_attendence where date like '$date-__' and employee.id=employee_attendence.emp_id";
	$query=mysqli_query($con,$sql);
	
 while($rows=mysqli_fetch_array($query)){ 
	
	?>
<tr class="h2">
<td align="center"><?php  echo($i); ?></td>

<td align="center"><?php  echo($rows[1]); ?>

</td>
<td >
	
	<?php
	$sql_att_total="select COUNT(status) from employee_attendence WHERE emp_id='$rows[0]'  and  date like '$date-__'";
	$query_att_total=mysqli_query($con,$sql_att_total);
	$row_att_total=mysqli_fetch_array($query_att_total);
	$sql_att="select COUNT(status) from employee_attendence WHERE status='Present' and  emp_id='$rows[0]' and  date like '$date-__'";
	$query_att=mysqli_query($con,$sql_att);
	$row_att=mysqli_fetch_array($query_att);
	
	?>
	<h3>Classes Attended = <?php echo $pres=$row_att[0]; ?> Out of <?php echo $tot=$row_att_total[0]; ?> Classes</h3>
	<td><?php echo(round(($pres*100)/$tot,1)."%"); ?></h3></td>
	
	</td>
	
<td align="center"><button class="btn-sm btn-primary" onClick="window.open('employee_attendence_history.php?emp_id=<?php echo($rows[0]); ?>','','width=auto,height=auto');">View Details</button></td>

</tr>
<?php $i++;} ?>
</table>
<?php }
	else
	{
	?><center><h1><?php echo("No Results Found For "); echo(' '.$date); ?></h1></center><?php
	}
	
	?>
</div>
	</div>
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
