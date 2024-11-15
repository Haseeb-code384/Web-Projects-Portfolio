<?php 
session_start();
$current_user=$_SESSION['email'];
include( "config.php" );
include( "allFunctions.php" );
if(isset($_REQUEST['submit']))
{
	
	$vehicle_type=$_REQUEST['vehicle_type'];
	$army_no=$_REQUEST['army_no'];
	$vehicle_no=strtoupper($_REQUEST['vehicle_no']);
	$name=strtoupper($_REQUEST['name']);
	$purpose=$_REQUEST['purpose'];
	$gate=$_REQUEST['gate'];
	
	$cnic=$_REQUEST['cnic'];
	$mobile=$_REQUEST['mobile'];
	$persons=$_REQUEST['persons'];
	$description=$_REQUEST['description'];
	$person_name=$_REQUEST['person_name'];
	$person_army_no=$_REQUEST['person_army_no'];
	$person_cnic=$_REQUEST['person_cnic'];
	
	$sqlvis="INSERT INTO `vehicle` (`vehicle_id`, `vehicle_type`, `vehicle_no`, `driver_name`, `driver_army_no`, `driver_cnic`, `purpose`, `mobile`, `persons`, `description`, `time_in`, `time_out`, `gate`, `created_at`, `created_by`) VALUES (NULL, '$vehicle_type', '$vehicle_no', '$name', '$army_no', '$cnic', '$purpose', '$mobile', '$persons', '$description', '$currentDateTime', '0000-00-00 00:00:00.000000', '$gate', '$currentDateTime', '$current_user')";
	$queryvis=mysqli_query($con,$sqlvis);
	$vid=mysqli_insert_id($con);
	
	for($i=0;$i<$persons;$i++)
	{
		executeQuery("INSERT INTO `vehicle_persons` (`persons_id`, `vehicle_id`, `person_name`, `person_army_no`, `person_cnic`, `entry_date`) VALUES (NULL, '$vid', '$person_name[$i]', '$person_army_no[$i]', '$person_cnic[$i]', '$currentDateTime')");
	}
	
	if($queryvis)
	{
		echo "<script>alert('Vehicle Added');
		window.location.href='vehicle_form.php';
		</script>";
	}
}
?>
