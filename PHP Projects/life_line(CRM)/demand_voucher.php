<?php session_start();
include('config.php');
include('allFunctions.php');
$demand_id=$_REQUEST['demand_id'];
$sql_demand="SELECT * FROM `demand` WHERE id='$demand_id'";
$query_demand=mysqli_query($con,$sql_demand);
$row_demand=mysqli_fetch_array($query_demand);
?>

<!doctype html>
<html>
<head>
	<script src="jquery-1.7.1.min.js"></script>

<script src="printThis.js"></script>
<script language="javascript">
	function print_page(){
		$('#print_this').printThis({loadCSS:'print.css',printContainer:false});
		return false;
	}
</script>

<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<body>
<div align="center">
	<a  href="" onClick="return print_page()"><button >Print</button></a>
<a href="demandorder.php"><button>New Demand</button></a>
	<a href="index.php"><button>Home</button></a>
	</div>
<div id="print_this">
	
	<table border="1" style="width: 100%">
	<tr>
<center><img src="img/mp_logo1.png"></center>
		<th colspan="7" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
		</tr>
		<tr>
		<th colspan="7" style="border: none;"><h3>Demand Details</h3></th>
		</tr>
		<tr>
		<th  style="border: none;">Demand# <?php echo $demand_id; ?></th>
		<th  style="border: none;" colspan="3">Salesman Name: <?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$row_demand[3]'") ?></th> 
			<th style="border: none;"> ID <?php echo $row_demand[3]; ?></th>
		<th  style="border: none;" colspan="3">Date: <?php echo $date; ?></th>
		</tr>
	</table>
	<table width="100%" border="1">
		<tr>
		<th>SN</th>
		<th>Category</th>
		<th>Product</th>
		<th>Quantity</th>
		</tr>
		<?php
		$sql_dd="SELECT demand_no,category,name,quantity FROM demand_detail,ospos_items WHERE demand_no='$demand_id' AND product_id=ospos_items.item_id";
		$query_dd=mysqli_query($con,$sql_dd);
		$i=1;
		while($row_dd=mysqli_fetch_array($query_dd))
		{
		?>
		<tr align="center">
			<td><?php echo $i; ?></td>
			<td><?php echo $row_dd[1]; ?></td>
			<td><?php echo $row_dd[2]; ?></td>
			<td><?php echo $row_dd[3]; ?></td>
		</tr>
		<?php $i++; } ?>
	</table>
</div>
	</body>
	
</html>
