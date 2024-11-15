<?php

date_default_timezone_set('Asia/Karachi');

$currentDateTime = date('Y-m-d H:i:s');

$currentDateTime;

$address="Sillanwali";
$current_time=date("H:i:s");
$day=date('d');
$developer_phone="0300-6029757";
$phone="0321-8604333";	
$month=date('Y-m');
$host = 'localhost';
// $username = 'u322012342_lifeline';
$username = 'root';
$password ='';

// $password = 'u322012342_LIFELINE';
$database = 'u322012342_lifeline';

$con= mysqli_connect($host,$username,$password,$database);
$sqldate="select CURRENT_DATE";
$querydate=mysqli_query($con,$sqldate);
$rowdate=mysqli_fetch_array($querydate);
$date=date('Y-m-d');
//$date=$rowdate[0];
//$sqldata="SELECT ospos_app_config.value FROM `ospos_app_config` WHERE ospos_app_config.key='company'";
//$querydata=mysqli_query($con,$sqldata);
//$rowdata=mysqli_fetch_array($querydata);
//$project_name=$rowdata[0]; 
$project_name="Life Line Family Clinic"; 

?>