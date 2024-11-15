<?php
include("config.php");
include('allFunctions.php');
$farm=$_REQUEST['farm'];

?>
<!DOCTYPE html>
<html lang="en">


<body>

    <?php include('start.php'); ?>
    
    <!doctype html>


<div class="content-wrapper">
<form method="post" action="process_employee_attendence.php">


<table border="1|0" class="table table-striped table-hover text-center "   >
<h2 align="center">
	Employee Attendence <br>
  Unit = <?php echo($_REQUEST['section']); ?>
	<input type="hidden" name="unit" value="<?php echo($_REQUEST['section']) ?>">
	<input type="hidden" name="farm" value="<?php echo $farm; ?>">
  Farm = <?php echo showQuery("SELECT c_name FROM `farms` WHERE id='$farm'") ?> 
   
</h2>
		<thead style="background-color: antiquewhite;">
			<tr class="" align="center">
	<th width="50" height="23">Sn</th>
<th width="180" >Emp ID</th>
<th width="240">Name</th>
<th width="10" align="center" >P</th>
<th  width="10" align="center" >A</th>

</tr>
	</thead>
<?php $i=1;
$sqls="SELECT * FROM `employee` WHERE active='1' AND farm_id='$farm'";
	$querys=mysqli_query($con,$sqls);
 while($rows=mysqli_fetch_array($querys)){ ?>
<tr class="">
<td align="center"><?php  echo($i); ?></td>

<td align="center" class=""><?php  echo($rows[0]); ?>
	
<input type="hidden" name="emp[]" value="<?php echo($rows[0]); ?>"/>

</td>
<td ><?php  echo($rows[1]); ?>
</td>
<td align="center"><input type="radio"  checked  id="present"  value="Present" name="status[<?php echo $i; ?>]" title="<?php  echo($rows[1]); ?>" /></td>
<td align="center"><input type="radio"  value="Absent" title="<?php  echo($rows[1]); ?>" name="status[<?php echo $i; ?>]"  ></td>
</tr>
<?php $i++;} ?>
</table>
<input type="hidden" name="i" value="<?php echo($i); ?>"/>
	<center><input type="submit" required name="result"  value="Submit" class="btn-sm btn-lg form-group btn-primary col-2" style="width: 280px;height: 50px;"></center>

</form>
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
