<?php
include("config.php");
include("allFunctions.php");
$id=$_REQUEST['id'];
$sql="SELECT type,status,time,allocated_to,allocated_by,order_no,comments,inquiry_id FROM `inquiry_status_history` WHERE order_no='$id' ORDER BY time DESC";
			$queryview=mysqli_query($con,$sql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<h1 align="center">Order Status History (Inquiry ID <?php echo $id; ?>)</h1>
<body>
	<table border="1" width="100%">
		<thead align="center">
			<tr align="center" bgcolor="#48BDD5">
								<th>Type</th>
								<th>Status</th>
								<th>Time</th>
								<th>Allocated By</th>
								<th>Seller</th>
								<th>Order ID</th>
								<th>Comments</th>
								<th>Inquiry ID</th>
								
							</tr>
						</thead>
        <?php
            while($rowview=mysqli_fetch_array($queryview))
            {
                
            ?>
		<tr align="center" style="background-color: <?php echo showQuery("SELECT color FROM `order_status` WHERE order_status='$rowview[1]'"); ?> !important;">
            
		
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td><?php echo $rowview[7]; ?></td>
		</tr>
			
        <?php } ?>
	</table>

	
</body>
</html>
