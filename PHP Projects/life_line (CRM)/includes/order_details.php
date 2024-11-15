<?php session_start();
include("config.php");
include("allFunctions.php");
$id=$_REQUEST['id'];
$sql="SELECT * FROM `order_dispatch_info` WHERE order_id='$id'";

			$queryview=mysqli_query($con,$sql);
							$rowview=mysqli_fetch_array($queryview); ?>


<!doctype html>
<html>
<head>
    <style>
    th
        {
            text-transform: capitalize;
        }
    </style>
<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<h1 align="center">Order Information</h1>
<body>
    

	<table border="1" width="100%">
		<thead align="center">
			<tr align="center" bgcolor="#48BDD5">
								<th>order id</th>
								<th>status</th>
								<th>seller</th>
								<th>order patient id</th>
								<th>order date</th>
								<th>source address</th>
								<th>dispatcher name</th>
								<th>dispatcher contact</th>
								<th>receiver name</th>
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[0]; ?></td>
								<td><?php echo $rowview[1]; ?></td>
								<td><?php echo $rowview[2]; ?></td>
								<td><?php echo $rowview[3]; ?></td>
								<td><?php echo $rowview[4]; ?></td>
								<td><?php echo $rowview[5]; ?></td>
								<td><?php echo $rowview[6]; ?></td>
								<td><?php echo $rowview[7]; ?></td>
            
								<td><?php echo $rowview[8]; ?></td>
		</tr>
					
	</table>
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>destination address</th>
								<th>destination contact</th>
								<th>courier company</th>
								<th>Order type</th>
								<th>advance paid</th>
								<th>advance comments</th>
								<th>order amount</th>
								<th>courier cost</th>
								
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[9]; ?></td>
								<td><?php echo $rowview[10]; ?></td>
								<td><?php echo $rowview[11]; ?></td>
								<td><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[13]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
								<td><?php echo $rowview[15]; ?></td>
            
									<td><?php echo $rowview[16]; ?></td>
		</tr>
					
	</table>
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>package weight</th>
								<th>tracking id</th>
								<th>dispatch remarks</th>
								<th>dispatch time</th>
								<th>delivered time</th>
								<th>received by</th>
								<th>delivery notes</th>
								<th>entered at</th>
								<th>updated at</th>
								
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[17]; ?></td>
								<td><?php echo $rowview[18]; ?></td>
								<td><?php echo $rowview[19]; ?></td>
								<td><?php echo $rowview[20]; ?></td>
								<td><?php echo $rowview[21]; ?></td>
								<td><?php echo $rowview[22]; ?></td>
								<td><?php echo $rowview[23]; ?></td>
            
								<td><?php echo $rowview[24]; ?></td>
								<td><?php echo $rowview[25]; ?></td>
		</tr>
					
	</table>


	
	<table border="1" width="100%">
		<thead>
			<tr align="center" bgcolor="#48BDD5">
								<th>comments</th>
								<th>customer feedback</th>
								<th>fraud flag</th>
								<th>fraud investigation notes</th>
								
								
							</tr>
						</thead>
		<tr align="center">
		
								<td><?php echo $rowview[26]; ?></td>
								<td><?php echo $rowview[27]; ?></td>
								<td><?php echo $rowview[28]; ?></td>
								<td><?php echo $rowview[29]; ?></td>
								
		</tr>
					
	</table>
    <?php if(check_admin($_SESSION['email']))
{
    ?>
    <center>
	 <i title="Status History" onClick="window.open('order_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"><button>Status History</button></i> <a target="new" href="update_order_status.php?id=<?php echo $rowview[0]; ?>" title="Set Order Status"><i class="fa fa-reorder text-warning"><button>Set Order Status</button></i></a> 
              <a target="new" href="update_order_checklist.php?id=<?php echo $rowview[0]; ?>" title="Check List"><i class="fa fa-check-square-o text-info"></i><button>Check List</button></a> 
              <a target="new" href="update_order_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"><button>Update</button></i></a> 
        </center>
    <?php } ?>
</body>
</html>
