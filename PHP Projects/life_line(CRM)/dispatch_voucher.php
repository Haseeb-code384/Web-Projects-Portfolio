<?php session_start();
include('config.php');
include('allFunctions.php');
$dispatch_id=$_REQUEST['dispatch_id'];
$sql_dispatch="SELECT * FROM `dispatch` WHERE id='$dispatch_id'";
$query_dispatch=mysqli_query($con,$sql_dispatch);
$row_dispatch=mysqli_fetch_array($query_dispatch);
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
<a href="dispatch_selector.php"><button>New dispatch</button></a>
	<a href="index.php"><button>Home</button></a>
	</div>
<div id="print_this" style="page-break-after:always;">
	
	<table border="1" style="width: 100%">
	<tr>
<center><img src="img/mp_logo1.png"></center>
		<th colspan="7" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
		</tr>
		<tr>
		<th colspan="7" style="border: none;"><h3>Dispatch Details</h3></th>
		</tr>
		<tr>
		<th  style="border: none;">dispatch# <?php echo $dispatch_id; ?></th>
		<th  style="border: none;" colspan="3">Salesman Name: <?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$row_dispatch[3]'") ?></th> 
			<th style="border: none;"> ID <?php echo $row_dispatch[3]; ?></th>
		<th  style="border: none;" colspan="3">Date: <?php echo $date; ?></th>
		</tr>
	</table>
	<table width="100%" border="1">
		<tr>
		<th>SN</th>
		<th>Category</th>
		<th>Product</th>
		<th>Quantity</th>
		<th>Unit Price</th>
		<th>Amount</th>
		</tr>
		<?php
		$sql_dd="SELECT dispatch_no,category,name,dispatch_detail.quantity,dispatch_detail.unit_price,dispatch_detail.amount FROM dispatch_detail,ospos_items WHERE dispatch_no='$dispatch_id' AND product_id=ospos_items.item_id";
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
			<td><?php echo $row_dd[4]; ?></td>
			<td><?php echo $row_dd[5]; ?></td>
		</tr>
		<?php $i++; } ?>
		<tr>
		<th colspan="5">Total</th>
		<th><?php echo showQuery("SELECT SUM(amount) FROM `dispatch_detail` WHERE dispatch_no='$dispatch_id'"); ?></th>
		</tr>
	</table>
	
<p style="page-break-after: always;">&nbsp;</p>
</div>
	
	</body>
	
</html>
