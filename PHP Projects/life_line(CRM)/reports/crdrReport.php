<?php 
include("../config.php");
include("../allFunctions.php");
$crdr = $_REQUEST['crdr'];
$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];
$account_id = $_REQUEST['account_id'];
//$account_head = $_REQUEST['account_head'];
//$area_id = $_REQUEST['area_id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>


<style type="text/css">
	

	
.special_column th{
	 font-family: Jameel Noori Nastaleeq Regular;
	font-weight: bolder;
    font-size: 150%;

}

.vl {
	border-left: 3px solid red;
    height: 40px;
}


.special_border{

	height: 35px;

}

.class_bold td{
	text-align: right;
	width: 60%; margin-left: 34%;
}

tr td span{

	column-span: all;
}


</style>
</head>
<body>
<table style="margin-left: 10%;">
	<tbody>
		<tr>
				<td>
					<h3>
					<b><?php echo $crdr; ?> Balance Summary </b><br>
					<b> (<?php echo $account_id.") "; echo showQuery("SELECT account FROM `master_account` WHERE m_accountid=$account_id"); ?></b><br>
				</h3>
			</td>
		</td>
			<td></td>
		<td>
			<?php include ('logo.php');?><br>

		</td>
		<td></td>
	</tr>
	<tr>
		<td><strong>FROM : </strong> <?php echo change_date_ddmmyyy($date_start); ?>  </td>
		<td></td>
		<td align="center" style="font-family: Jameel Noori Nastaleeq Regular;font-size: 140%;"> . </td>
		<td></td>
		<td><strong>To : </strong> <?php echo change_date_ddmmyyy($date_end); ?>  </td>
	</tr>
	<tr>
		<td>
			<hr style="width: 450%; border: 1px solid black">
		</td>
	</tr>
	<tr>
		<td>

		</td>
	</tr>
	</table>
<table  style="margin-left: 10%; width: 85%;" border="1">
	
		<tr align="center">
		<th> Transaction Date </th>
		<th> Amount </th>
		<th> Description </th>
		<th> Invoice No </th>
		
	</tr>
		<?php
		$sql="SELECT tr_date,amount,type,tr_description,invno FROM `m_account_detail` WHERE info='$crdr' AND m_accountid='$account_id' and tr_date between '$date_start' and '$date_end' ";
//	echo $sql;
		$query=mysqli_query($con,$sql);
		$sum1=0;
		while($row=mysqli_fetch_array($query))
		{
		?>
		<tr align="center">
		<td><?php echo change_date_ddmmyyy($row[0]);?></td>
		<td><?php echo $row[1];?></td>
		<td><?php echo $row[3];?></td>
		<td><?php echo $row[4];?></td>

		</tr>
		<?php $sum1=$sum1+$row[1]; } ?>
		<tr>
	<th></th>
	<th><?php echo $sum1; ?></th>
	<th></th>
	<th></th>
	</tr>
	</tr>
</table>
</body>
</html>