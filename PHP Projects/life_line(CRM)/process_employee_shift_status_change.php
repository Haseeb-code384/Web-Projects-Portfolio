<?php session_start();
$current_user=$_SESSION['email'];
include("config.php");
include("allFunctions.php");
$shift_name=$_REQUEST['shift_name'];
$strat_date=$_REQUEST['strat_date'];
$end_date=$_REQUEST['end_date'];
$emp=$_REQUEST['emp'];
$count_emp=count($emp);
$dates = getDatesFromRange($strat_date,$end_date);
$count_dates=count($dates);
for($d=0;$d<$count_dates;$d++)
{	for($i=0;$i<$count_emp;$i++)
	{
		executeQuery("UPDATE `employee_shift_allocation` SET status='$shift_name', edited_by='$current_user' WHERE employee='$emp[$i]' AND date='$dates[$d]'");
	}
}
alertredirect("Status Changed Successfully of $count_emp Employees","change_employee_shift_status.php");


?>