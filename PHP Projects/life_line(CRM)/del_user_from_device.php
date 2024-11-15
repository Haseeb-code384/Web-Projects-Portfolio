<?php
include "zklibrary.php";
$ip=$_REQUEST['ip'];
$emp_no=$_REQUEST['emp_no'];
$zk = new ZKLibrary($ip, 4370, 'TCP');
$zk->connect();
$zk->disableDevice();
$zk->deleteUser($emp_no);   
$zk->enableDevice();
$zk->disconnect();
$page=$_SERVER['HTTP_REFERER'];
header('location: '.$page);
?>