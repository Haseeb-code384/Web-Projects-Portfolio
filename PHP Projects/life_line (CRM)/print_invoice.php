<?php session_start();
include('config.php');
include('allFunctions.php');
$invoice_date=$_REQUEST['invoice_date'];
$salesman=$_REQUEST['salesman'];
$sql_invoice="SELECT * FROM invoice,invoice_details WHERE invoice.id=invoice_details.inv_id AND invoice.date='$invoice_date' AND invoice.salesman='$salesman'";
$query_invoice=mysqli_query($con,$sql_invoice);
$row_invoice=mysqli_fetch_array($query_invoice);
?>

<!doctype html>
<html>
<head>
	<style>
	@page {
  size: A4;
}
		@media print {
			body * {
        font-size: 10pt;
    }
		}
@page:left{
  @bottom-left {
    content: "Page " counter(page) " of " counter(pages);
  }
}

	</style>
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
<a href="invoice_selector.php"><button>New invoice</button></a>
	<a href="index.php"><button>Home</button></a>
	</div>
<div id="print_this" style="page-break-after:always;">
	
	<span style="font-size: 9pt;">Print Time <?php echo date("d/m/y h:i:s") ?></span>
	<table border="1" style="width: 100%">
	<tr>
<!--<center><img src="img/mp_logo1.png"></center>-->
		<th colspan="10" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
		</tr>
		<tr>
		<th height="2" colspan="10" style="border: none;"><h3>Salesman Voucher</h3></th>
		</tr>
		<tr>
		<th  style="border: none;">Voucher# <?php echo $row_invoice['id']; ?></th>
		<th  style="border: none;" colspan="3">Salesman Name: <?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$row_invoice[3]'"); ?></th> 
			<th style="border: none;"> ID <?php echo $row_invoice[3]; ?></th>
		<th  style="border: none;" colspan="3">Date: <?php echo $row_invoice['date']; ?></th>
		</tr>
		<tr>
		<th>Remarks:</th>
		<th>Commission%:</th>
		
		<th>Vehicle No:</th>
		<th>Reading1:</th>
		<th>Reading2:</th>
		<th>Distance:</th>
		<th>Fuel Rate:</th>
		<th>Per Km:</th>
		</tr></tr>
		<tr>
		<th><?php echo $row_invoice['remarks']; ?></th>
		<th><?php echo $row_invoice['commission_p_age']; ?></th>
		<th><?php echo $row_invoice['vehicle_no']; ?></th>
		<th><?php echo $row_invoice['reading1']; ?></th>
		<th><?php echo $row_invoice['reading2']; ?></th>
		<th><?php echo $row_invoice['distance']; ?></th>
		<th><?php echo $row_invoice['fuel_rate']; ?></th>
		<th><?php echo $row_invoice['per_km']; ?></th>
		</tr>
	</table>
	<table border="1" width="100%">
		<tr>
		<th>Fuel Charges</th>
		<th>Rent</th>
		<th>Misc</th>
		<th>Parchi</th>
		<th>Discount</th>
		<th>Comission Amount</th>
			</tr>
		<tr>
		<th><?php echo $row_invoice['fuel_charges']; ?></th>
		<th><?php echo $row_invoice['rent']; ?></th>
		<th><?php echo $row_invoice['misc']; ?></th>
		<th><?php echo $row_invoice['parchi']; ?></th>
		<th><?php echo $row_invoice['discount']; ?></th>
		<th><?php echo $row_invoice['commission_amount']; ?></th>
			</tr>
	</table>
	<table style="width: 100%;" border="1">
		<tr>
		<th>SN</th>
<!--
			
		<th>Category</th>
			
-->
		<th>Product</th>
		<th>Unit Price</th>
		<th>Dispatch</th>
		<th>Return</th>
		<th>Waste</th>
		<th>Final Qty</th>
		<th>Amount</th>
		</tr>
		<tr>
		<th colspan="8"  bgcolor="#ACACAC">Wet</th>
		</tr>
		<?php
		$gt=0;
		$sql_dd="
		SELECT name,unit_price,p_dispatch,p_return,p_waste,final_qty,amount FROM invoice_details,ospos_items WHERE category IN ('Bunny Wet','Farm Fresh Wet') AND product=item_id AND  inv_id='$row_invoice[0]'
		";
		$query_dd=mysqli_query($con,$sql_dd);
		$i=1;
		$sum=0;
		while($row_dd=mysqli_fetch_array($query_dd))
		{
		?>
		<tr align="center">

			<td><?php echo $i; ?></td>
			<td><?php echo $row_dd[0]; ?></td>
			<td><?php echo $row_dd[1]; ?></td>
			<td><?php echo $row_dd[2]; ?></td>
			<td><?php echo $row_dd[3]; ?></td>
			<td><?php echo $row_dd[4]; ?></td>
			<td><?php echo $row_dd[5]; ?></td>
			<td><?php echo $row_dd[6]; $sum=$sum+$row_dd[6]; ?></td>
		</tr>
		<?php $i++; } $gt=$gt+$sum;
		
		?>
		<tr>
		<th colspan="7">Wet Total</th>
		<th><?php echo $sum; 
			$sum=0;
			?></th>
		</tr>
		
		<tr>
		<th colspan="8" bgcolor="#ACACAC">Dry</th>
		</tr>
		<?php
		$sql_dd="
		SELECT name,unit_price,p_dispatch,p_return,p_waste,final_qty,amount FROM invoice_details,ospos_items WHERE category NOT IN ('Bunny Wet','Farm Fresh Wet') AND product=item_id AND  inv_id='$row_invoice[0]'
		";
		$query_dd=mysqli_query($con,$sql_dd);
		$i=1;
		while($row_dd=mysqli_fetch_array($query_dd))
		{
		?>
		<tr align="center">

			<td><?php echo $i; ?></td>
			<td><?php echo $row_dd[0]; ?></td>
			<td><?php echo $row_dd[1]; ?></td>
			<td><?php echo $row_dd[2]; ?></td>
			<td><?php echo $row_dd[3]; ?></td>
			<td><?php echo $row_dd[4]; ?></td>
			<td><?php echo $row_dd[5]; ?></td>
			<td><?php echo $row_dd[6]; $sum=$sum+$row_dd[6]; ?></td>
		</tr>
		<?php $i++; } ?>
		
		<tr>
		<th colspan="7">Total Dry</th>
		<th><?php echo $sum; $gt=$gt+$sum; ?></th>
		</tr>
		<tr>
		<th colspan="7">SubTotal</th>
		<th><?php echo $gt; ?></th>
		</tr>
		<tr>
		<th colspan="7">Total Expenses</th>
		<th><?php echo showQuery("SELECT round(fuel_charges+rent+misc+parchi+discount+commission_amount) FROM `invoice` WHERE id='$row_invoice[0]'"); ?></th>
		</tr>
		<tr>
		<th colspan="7">Grand Total</th>
		<th><?php echo round($row_invoice[18]); ?></th>
		</tr>
		<tr>
		<th colspan="7">
		Received Amount</th>
		<th><?php echo $row_invoice['received_amount']; ?></th>
		</tr><tr>
		<th colspan="7">
		Balance</th>
		<th><?php echo round($row_invoice[18]-$row_invoice['received_amount'],0); ?></th>
		</tr>
		</table>
	
	
	
<p style="page-break-after: always;">&nbsp;</p>
</div>
	
	</body>
	
</html>
