
    <body>
<?php
		include("config.php");
		include("allFunctions.php");
		$gate=$_REQUEST['gate'];
		$ip=showQuery("SELECT device_ip FROM `gate` WHERE gate_name='$gate'");

		$emp=$_REQUEST['emp'];
	//	echo $ip; echo $emp;
    include("zklib/zklib.php");
    
    $zk = new ZKLib($ip, 4370);
    
    $ret = $zk->connect();

     echo   $zk->enrollUser($emp);
        $zk->enableDevice();
        sleep(1);
        $zk->disconnect();
		executeQuery("UPDATE `employee` SET `active` = '1' WHERE `employee`.`army_no` = '$emp';");
    alertredirect("Check Device of $gate and ask user to enroll finger","index.php");
?>
    </body>
</html>
