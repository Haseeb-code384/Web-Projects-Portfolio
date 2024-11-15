<?php

include "zklibrary.php";
$ip=$_REQUEST['ip'];
$zk = new ZKLibrary($ip, 4370, 'TCP');
$zk->connect();
$zk->disableDevice();
$zk->setUser('','p12345','Waseem Ahmad','0000',0);

//$zk->deleteUser(127);

//Set new user or update
//super admin 14
//normal user 0
//$zk->setUser('','p12345','Waseem Ahmad','0000',0);
//echo 'Setting user with new data';

//$zk->setUser(2,2,'Karim Ali','0000',0);
//echo 'Setting user with new data';

$zk->enableDevice();
$zk->disconnect();
?>