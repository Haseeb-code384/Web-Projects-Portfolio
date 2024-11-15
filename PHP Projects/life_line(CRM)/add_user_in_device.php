<?php
include('config.php');
include('allFunctions.php');
$emp=$_REQUEST['emp'];
$name=$_REQUEST['name'];
$gate=$_REQUEST['gate'];
	include "zklibrary.php";
$ip=showQuery("SELECT device_ip FROM `gate` WHERE gate_name='$gate'");
$zk = new ZKLibrary($ip, 4370, 'TCP');
$zk->connect();
$zk->disableDevice();
$zk->setUser($emp,$emp, $name,'000',0);
$zk->enableDevice();
$zk->disconnect();
	echo "<script>window.close();</script>";

?>