
<?php
$phone1network="phone1network";
	$phone2network="phone2network";
	$order_status="order_status";
	$call_status="call_status";
	$allocated_to="allocated_to";
if(isset($_REQUEST['filter']))
{
	
	if(isset($_REQUEST['allocated_to']))
	{
		$allocated_to=$_REQUEST['allocated_to'];
		if($allocated_to!="allocated_to")
		{
		$allocated_to="'".$allocated_to."'";	
		}
	}
    if(isset($_REQUEST['order_status']))
	{
		$order_status=$_REQUEST['order_status'];
		if($order_status!="order_status")
		{
		$order_status="'".$order_status."'";	
		}
	}
    if(isset($_REQUEST['call_status']))
	{
		$call_status=$_REQUEST['call_status'];
		if($call_status!="call_status")
		{
		$call_status="'".$call_status."'";	
		}
	}
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


	$sqlview="SELECT id,source,name,phone1,phone1network,phone2,phone2network,whatsapp,call_status,order_status,date(created_at),allocated_to,allocated_at FROM `inquiry` WHERE phone1network=$phone1network AND phone2network=$phone2network AND call_status=$call_status AND order_status=$order_status AND allocated_to=$allocated_to $limit;";

							$queryview=mysqli_query($con,$sqlview);
?>