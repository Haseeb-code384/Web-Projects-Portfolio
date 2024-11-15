<?php
$ip=$_REQUEST['ip'];
include "zklibrary.php";
include("config.php");
include("allFunctions.php");
$zk = new ZKLibrary($ip, 4370, 'UDP');
$zk->connect();
$zk->disableDevice();
$attendace = $zk->getAttendance();
sleep(1);
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
<thead>
  <tr>
    <td>Army No</td>
    <td>Date</td>
    <td>Time</td>
  </tr>
</thead>

<tbody>
<?php
foreach($attendace as $key=>$at)
{
?>

  <tr>
    <td><?php $armno= $at[1]; echo $armno; ?></td>
    
	  
                <td><?php  $attdate=date( "Y-m-d", strtotime( $at[3] ) );
					echo $attdate;
					?></td>
                <td><?php $atttime= date( "H:i:s", strtotime( $at[3] ) );
					echo $atttime;
					?></td>
  </tr>

<?php
 executeQuery("INSERT INTO `attendence` (`army_no`, `date`, `time`, `ip`) VALUES ('$armno', '$attdate', '$atttime', '$ip')");
}
?>

</tbody>
</table>
<?php

//$zk->deleteUser(2);

//$zk->clearAttendance();
//setUser($uid, $userid, $name, $password, $role)
//Reading fingerprint data
//for($i=0;$i<=9;$i++){
//$f = $zk->getUserTemplate(1,6); echo '</br>-----'; print_r($f); echo '</br>';
/*
echo 'FP length: '.$f[0].'</br>';
echo 'UID: '.$f[1].'</br>';
echo 'Finger ID: '.$f[2].'</br>';
echo 'Valid: '.$f[3].'</br>';
echo 'template: '.$f[4].'</br>';
*/

$zk->enableDevice();
$zk->disconnect();

?>
