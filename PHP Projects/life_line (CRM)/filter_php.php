<?php

include("limit_record.php");

$phone1network="phone1network";
	$phone2network="phone2network";
if(isset($_REQUEST['filter']))
{
	
	if(isset($_REQUEST['phone1network']))
	{
		$phone1network=$_REQUEST['phone1network'];
		if($phone1network!="phone1network")
		{
		$phone1network="'".$phone1network."'";	
		}
	}
	if(isset($_REQUEST['phone2network']))
	{
		$phone2network=$_REQUEST['phone2network'];
		if($phone2network!="phone2network")
		{
		$phone2network="'".$phone2network."'";	
		}
	}

	
}


	$sqlview="SELECT id,source,name,concat(phone1,' ',phone1network),concat(phone2,' ',phone2network),whatsapp,call_status,date(created_at),record_date FROM `inquiry` WHERE phone1network=$phone1network AND phone2network=$phone2network AND allocated_to='' AND ID IN order by record_date desc $limit;";

//	$sqlview="SELECT id,source,name,concat(phone1,' ',phone1network),concat(phone2,' ',phone2network),whatsapp,call_status,date(created_at),record_date FROM `inquiry` WHERE id IN (SELECT DISTINCT inquiry_id FROM `inquiry_status_history` WHERE allocated_to='Warrior One');";
//	echo $sqlview;
							$queryview=mysqli_query($con,$sqlview);
?>