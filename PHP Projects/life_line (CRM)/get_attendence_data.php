<?php

include("preloader.php");
$ip=$_REQUEST['ip'];
include "zklibrary.php";
include("config.php");
include("allFunctions.php");
$zk = new ZKLibrary($ip, 4370, 'UDP');
$zk->connect();
$zk->disableDevice();
$attendace = $zk->getAttendance();
sleep(1);
?>
<!--

<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
<thead>
  <tr>
    <td>Army No</td>
    <td>Date</td>
    <td>Time</td>
  </tr>
</thead>

<tbody>
-->
<?php
foreach($attendace as $key=>$at)
{
?>

<!--
  <tr>
    <td><?php $status="";
	$emp_no= $at[1];  ?></td>
    
	  
                <td><?php  $attdate=date( "Y-m-d", strtotime( $at[3] ) );
					echo $attdate;
					?></td>
                <td><?php $atttime= date( "H:i:s", strtotime( $at[3] ) );
					echo $atttime;
					?></td>
  </tr>
-->

<?php 
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
 
}
?>

</tbody>
</table>
<?php

//$zk->deleteUser(2);

//$zk->clearAttendance();
//setUser($uid, $userid, $name, $password, $role)
//Reading fingerprint data
//for($i=0;$i<=9;$i++){
//$f = $zk->getUserTemplate(1,6); echo '</br>-----'; print_r($f); echo '</br>';
/*
echo 'FP length: '.$f[0].'</br>';
echo 'UID: '.$f[1].'</br>';
echo 'Finger ID: '.$f[2].'</br>';
echo 'Valid: '.$f[3].'</br>';
echo 'template: '.$f[4].'</br>';
*/

$zk->enableDevice();
$zk->disconnect();
echo "<script>window.close();</script>";
?>

