<?php session_start();
include('config.php');
include('allFunctions.php');
$demand_date=$_REQUEST['demand_date'];
include("start.php");

$login_user=$_SESSION['email'];
if(isset($_REQUEST['submit']))
{
	$product=$_REQUEST['product'];
	$current_qty=$_REQUEST['current_qty'];
	$new_demand=$_REQUEST['new_demand'];
	$suggested_qty=$_REQUEST['suggested_qty'];
	$order_qty=$_REQUEST['order_qty'];
	$count=count($product);
	executeQuery("DELETE FROM `demand_order`WHERE date='$demand_date'");
	for($i=0;$i<$count;$i++)
	{
	executeQuery("INSERT INTO `demand_order` (`id`, `product`, `current_qty`, `new_demand`, `order_qty`, `date`, `order_by`) VALUES (NULL, '$product[$i]', '$current_qty[$i]', '$new_demand[$i]', '$order_qty[$i]', '$demand_date', '$login_user')");
		
	}
echo "<script>alert('Saved Successfully');
window.location.href='saved_order.php?demand_date=".$demand_date."'
</script>";
}
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
		<th colspan="7" style="border: none;"><h3>Demand Order</h3></th>
		</tr>
		<tr>
		<th  style="border: none;" colspan="3">Demand Date: <input type="text" value="<?php echo $demand_date; ?>" readonly name="demand_date" ></th>
		</tr>
	</table>
	<table width="100%" border="1">
		<tr align="center">
		<th>SN</th>
		<th>Category</th>
		<th>Product</th>
		<th>Current Quantity</th>
		<th>New Demand</th>
		<th>Suggested Quantity</th>
		<th>Order Quantity</th>
		</tr>
		<?php
		$sql_dd="SELECT demand_no,category,name,round(ospos_item_quantities.quantity,0),sum(demand_detail.quantity),round(demand_detail.quantity-ospos_item_quantities.quantity,0),ospos_items.item_id FROM demand,demand_detail,ospos_items,ospos_item_quantities WHERE demand.date='$demand_date' AND product_id=ospos_items.item_id AND product_id=ospos_item_quantities.item_id AND demand.id=demand_detail.demand_no GROUP BY item_id";
		
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
			<td><?php  if($row_dd[5]<0)
						{
				$row_dd[5]=0;
		}
			echo $row_dd[5];
			; ?></td>
			<td>
				<input type="hidden" name="product[]" value="<?php echo $row_dd[6]; ?>">
				<br>
				<input type="hidden" name="current_qty[]" value="<?php echo $row_dd[3]; ?>">
				<input type="hidden" name="new_demand[]" value="<?php echo $row_dd[4]; ?>">
				<input type="hidden" name="suggested_qty[]" value="<?php echo $row_dd[5]; ?>">
				<input style="text-align: center;" class="form-control" type="number" name="order_qty[]" value="<?php echo $row_dd[5]; ?>"></td>
		</tr>
		<?php $i++; } ?>
	</table>
</div>
			<center>
			
		<input type="submit" value="Save" name="submit" class="btn-sm btn-success">
			</center>
		</form>
		<br>
		<br>
		<br>
		<br>
		<br>
		</div>
	</body>
	
</html>
