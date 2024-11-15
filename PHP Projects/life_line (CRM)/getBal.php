<?php
include('config.php');

$cid=$_GET['cid'];
$no=$_GET['no'];








$res = mysqli_query( $con ,"SELECT * FROM `master_account` WHERE m_accountid='$cid'" );
	
$row=mysqli_fetch_array($res);
	if($row[0]!=NULL)
	{
		echo $row[7];
?>
	

<?php
	}
	
else
{
echo "Empty Customer ID";
	
}


?>