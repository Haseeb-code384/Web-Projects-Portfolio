<?php
include("config.php");
include("allFunctions.php");

	$phone1network="phone1network";
	$phone1network="phone2network";
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

	$sqlview="SELECT * FROM `inquiry` WHERE phone1network=$phone1network AND phone2network=$phone2network AND allocated_to='';";
//	echo $sqlview;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<form>
	
	<label>Phone 1 Network</label>
	<select name="phone1network">
		<option value="phone1network" >ANY</option>
	<?php populateDDsel("network","network","network",$_REQUEST['phone1network']) ?>
	</select>
		
	<input type="submit" value="filter" name="filter">
	</form>
</body>
</html>
