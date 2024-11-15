
<?php
include("preloader.php");
//include "zklibrary.php";
include "zklib/zklib.php";
include("config.php");
include("allFunctions.php");

	$ip=$_REQUEST['ip'];
$zk = new ZKLib($ip, 4370);
$zk->connect();
$zk->disableDevice();
$attendace = $zk->getAttendance();
$emp_no="";
?>
<table border="1">
<?php
foreach($attendace as $key=>$at)
{ 
	echo "<tr>";
	$status="";
	$emp_no= $at[1]; 
	echo "<td>".$emp_no."</td>";
	$attdate=date( "Y-m-d", strtotime( $at[3] ) );
	$atttime= date( "H:i:s", strtotime( $at[3] ) );
	
	echo "<td>".$attdate."</td>";
		$sql_shift="SELECT employee_shift_allocation.shift_name,start_time,end_time,early_start,late_finish,employee_shift_allocation.status FROM employee_shift_allocation,shift WHERE shift.shift_name=employee_shift_allocation.shift_name AND date='$attdate' AND employee='$emp_no' AND '$atttime' BETWEEN early_start AND late_finish";			
//echo $sql_shift."<br>";
	$query_shift=mysqli_query($con,$sql_shift);
	$row_shift=mysqli_fetch_array($query_shift);
	$current_shift=$row_shift[0];
	$current_shift_status=$row_shift[5];
	if($current_shift_status=="")
	{
		$current_shift_status="Invalid Shift";
	}
	$last_inout=showQuery("SELECT inOrOut FROM `attendence` WHERE date='$attdate' AND emp_no='$emp_no' ORDER BY attendence.time DESC LIMIT 1");
	if($last_inout=="")
	{
			$inOrOut="IN";
	}
	elseif($last_inout=="IN")
	{
		$inOrOut="OUT";
	}
	elseif($last_inout=="OUT")
	{
		$inOrOut="IN";
		
	}
	else
	{
		$inOrOut="Invalid";
	}
	$gate=showQuery("SELECT gate_name FROM `gate` WHERE device_ip='$ip'");
	
	
 executeQuery("INSERT INTO `attendence` (`emp_no`, `date`, `time`, `ip`, `gate`, `state`, `shift_name`, `shift_status`, `inOrOut`) VALUES ('$emp_no', '$attdate', '$atttime', '$ip', '$gate', '$status', '$current_shift', '$current_shift_status', '$inOrOut')");
echo "</tr>";
}

$zk->enableDevice();
$zk->disconnect();
	?>
	</table>
	<php
//echo "<script>window.close();</script>";
?>
</body>