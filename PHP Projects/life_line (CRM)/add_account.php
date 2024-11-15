<?php 
session_start();
if ( !isset( $_SESSION['email'] ) ) {
	header( "location:login.php" );
}

$login_user=$_SESSION['email'];
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'submit' ] ) ) {
	$army_no = $_REQUEST[ 'army_no' ];
	$name = strtoupper($_REQUEST[ 'name' ]);
	$rank = $_REQUEST[ 'rank' ];
	$blood_group = $_REQUEST[ 'blood_group' ];
	$branch = $_REQUEST[ 'branch' ];
	$employee_type = $_REQUEST[ 'employee_type' ];
	$employee_profession = $_REQUEST[ 'employee_profession' ];
	$gate = $_REQUEST[ 'gate' ];
	$mobile = $_REQUEST[ 'mobile' ];
	$cnic = $_REQUEST[ 'cnic' ];

	$sql = "INSERT INTO `employee` (`army_no`, `name`, `rank`, `blood_group`, `branch`, `employee_type`, `employee_profession`, `gate`, `mobile`, `cnic`, `active`, `created_at`, `created_by`) VALUES ('$army_no', '$name', '$rank', '$blood_group', '$branch', '$employee_type', '$employee_profession', '$gate', '$mobile', '$cnic', '1', '$currentDateTime', '$login_user')";
	$query = mysqli_query( $con, $sql );
	
$emp_no=mysqli_insert_id($con);
//	echo "empno".$emp_no;
	
	include "zklibrary.php";
$ip=showQuery("SELECT gate.device_ip FROM gate,employee WHERE employee.gate=gate.gate_name AND employee.army_no='$army_no'");
//	echo $ip;
$zk = new ZKLibrary($ip, 4370, 'TCP');
$zk->connect();
$zk->disableDevice();
$zk->setUser($emp_no,$emp_no, $name,'000',0);
$zk->enableDevice();
$zk->disconnect();
	
header("Location: chart-of-account.php");
}

?>