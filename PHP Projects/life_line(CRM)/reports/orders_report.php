<?php 
include("../config.php");
include("../allFunctions.php");
$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];
$seller = $_REQUEST['seller'];
$seller_sql="";
$delivery_sql="";
$courier_company_sql="";

$mistaken="";

    if($_REQUEST['show_mistaken']=="show")
{
    $mistaken=" ";
}
else
{
    $mistaken=" AND status!='Mistaken' ";
}


if($_REQUEST['delivery_status']!="")
{
$delivery_status = $_REQUEST['delivery_status'];
    if(exists_in_db("SELECT * FROM `order_status` WHERE parent IN('$delivery_status')"))
    {
$delivery_sql="AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$delivery_status'))";   
        
    }
    else
    {
        
$delivery_sql="AND status='$delivery_status'";   
    } 
}

if($_REQUEST['courier_company']!="")
{
$courier_company = $_REQUEST['courier_company'];
$courier_company_sql="AND courier_company='$courier_company'";    
}

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
					<b>Order Report </b><br>
                        <?php
                        if($_REQUEST['seller']!="")
                        {
                            $seller_sql="AND seller='$seller'";
                            ?>
                        
					<b> (<?php echo $seller.") "; echo showQuery("SELECT name FROM `user` WHERE email='$seller'"); ?></b><br>
                        <?php
                        }
                        ?>
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
		<td><strong>FROM : </strong> <?php echo change_date_ddmmyyy( $date_start); ?>  </td>
		<td></td>
		<td align="center" style="font-family: Jameel Noori Nastaleeq Regular;font-size: 140%;"> . </td>
		<td></td>
		<td><strong>To : </strong> <?php echo change_date_ddmmyyy( $date_end); ?>  </td>
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
<table  style=" width: 95%;" border="1">
	
		<tr align="center">
		<th>Order ID</th>
		<th>Status</th>
		<th>Seller</th>
		<th>Order Date</th>
		<th>Courier Comapy</th>
		<th>Payment Method</th>
		<th>Advance Paid</th>
		<th>Order Amount</th>
		<th>Total Courier Cost</th>
		<th>Weight</th>
		<th>TrackingID</th>
		<th>Receiver Name</th>
		<th>Receiver Address</th>
		<th>Receiver Contact</th>
		
	</tr>

		<?php
		
$sql_view="SELECT * FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql  $mistaken ORDER BY order_date";
   // echo $sql_view;
		$query=mysqli_query($con,$sql_view);
		$sum1=0;
		while($row=mysqli_fetch_array($query))
		{
		?>
		<tr align="center">
		<td>
            
            <a href="#" onClick="window.open('../order_details.php?id=<?php  echo $row['order_id']; ?>')" ><?php echo $row['order_id'];?></a>
            
           
<!--
              <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $row[0]; ?>'" class="fa fa-trash text-danger"></i>
            
-->
            </td>
		<td><?php echo $row['status'];?></td>
		<td><?php echo $row['seller'];?></td>
		<td><?php echo change_date_ddmmyyy( $row['order_date']);?></td>
		<td><?php echo $row['courier_company'];?></td>
		<td><?php echo $row['payment_method'];?></td>
		<td><?php echo $row['advance_paid'];?></td>
		<td><?php echo $row['order_amount'];?></td>
		<td><?php echo $row['total_service_charges'];?></td>
		<td><?php echo $row['package_weight'];?></td>
		<td><?php echo $row['tracking_id'];?></td>
		<td><?php echo $row['receiver_name'];?></td>
		<td><?php echo $row['destination_address'];?></td>
		<td><?php echo $row['destination_contact'];?></td>
			
			
		</tr>
		<?php  } ?>
	<tr bgcolor="grey">
    <th colspan="6"><?php echo mysqli_num_rows($query); ?> Records Total</th>
    <th><?php echo showQuery("SELECT sum(advance_paid) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(order_amount) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(total_service_charges) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
    <th><?php echo showQuery("SELECT sum(package_weight) FROM `order_dispatch_info` WHERE order_date BETWEEN '$date_start' AND '$date_end' $seller_sql $delivery_sql $courier_company_sql $mistaken") ?></th>
        <th></th>
    </tr>
		
</table>
</body>
</html>