<?php
include("config.php");
include("allFunctions.php");
$emp=$_REQUEST['emp'];
$stat=$_REQUEST['status'];
$unit=$_REQUEST['unit'];
$farm=$_REQUEST['farm'];
$i=0;
foreach($stat as $status)
{
	echo $emp[$i]; 
	echo $status; 
executeQuery("INSERT INTO `attendence` (`id`, `eid`, `unit`, `farm`, `status`, `date`) VALUES (NULL, '$emp[$i]', '$unit', '$farm', '$status', '$date')");
	$i++;
}
alertredirect("Attendence Taken successfully","attendence_units.php");