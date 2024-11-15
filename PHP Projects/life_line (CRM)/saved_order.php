<?php session_start();
include('config.php');
include('allFunctions.php');
$demand_date=$_REQUEST['demand_date'];
include("start.php");

$login_user=$_SESSION['email'];

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
	<div class="content-wrapper">
		<form>
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
		<th colspan="7" style="border: none;"><h3>Saved Order</h3></th>
		</tr>
		<tr>
		<th  style="border: none;" colspan="3">Demand Date: <?php echo $demand_date; ?></th>
		</tr>
	</table>
	<table width="100%" border="1">
		<tr align="center">
		<th>SN</th>
		<th>Product ID</th>
		<th>Category</th>
		<th>Product</th>
		<th>Current Quantity</th>
		<th>New Demand</th>
		<th>Suggested Quantity</th>
		<th>Order Quantity</th>
		</tr>
		<?php
		$sql_dd="SELECT category,name,current_qty,new_demand,new_demand-current_qty,order_qty,ospos_items.item_id FROM demand_order,ospos_items  WHERE date='$demand_date' AND demand_order.product=ospos_items.item_id";
		
		$query_dd=mysqli_query($con,$sql_dd);
		$i=1;
		while($row_dd=mysqli_fetch_array($query_dd))
		{
		?>
		<tr align="center">
			<td><?php echo $i; ?></td>
			
			<td><?php echo $row_dd[6]; ?></td>
			<td><?php echo $row_dd[0]; ?></td>
			
			<td><?php echo $row_dd[1]; ?></td>
			<td><?php echo $row_dd[2]; ?></td>
			<td><?php echo $row_dd[3]; ?></td>
			<td><?php echo $row_dd[4]; ?></td>
			<td><?php echo $row_dd[5]; ?></td>
		</tr>
		<?php $i++; } ?>
	</table>
</div>
			<center>
			
			</center>
		<br>
		<br>
		<br>
		<br>
		<br>
		</div>
	</body>
	
</html>
