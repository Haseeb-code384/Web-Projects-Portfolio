<?php
include("config.php");
include("allFunctions.php");
$emp=$_REQUEST['emp'];
$c=$_REQUEST['c'];
if($c=="green")
{
executeQuery("UPDATE `employee` SET `active` = '0' WHERE `employee`.`id` = $emp;");
}
else
{
	
executeQuery("UPDATE `employee` SET `active` = '1' WHERE `employee`.`id` = $emp;");
}
header("Location: manage_employee.php");
?>