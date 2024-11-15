<?php 
include("config.php");
include("allFunctions.php");

include("limit_record.php");
if(isset($_REQUEST['status']))
{
$status="'".$_REQUEST['status']."'";   
}
else
{
    $status='order_status';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
<body>
	
	<?php 
include "start.php";
	
$login_user=$_SESSION['email'];
	?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<?php breadcrumb(); ?>
		<div class="col-lg-12">
            <?php include("user_inquiry_orders_tabs.php"); ?>
				<?php include("fix_header.php"); ?>
							<tr>
										<th style="width: 70px;">Actions</th>
								<th>ID</th>
								<th>Seller</th>
								<th>Source</th>
								<th>Name</th>
								<th>Mobile1</th>
								<th>Mobile2</th>
								<th>Whatsapp</th>
								<th>Call Status</th>
								<th>Called At</th>
								<th>Recall Date</th>
								<th>Order Status</th>
								<th>Date</th>
								
								
		
							</tr>
						</thead>
						<tbody>
							<?php
							$sqlview="SELECT * FROM `inquiry`  WHERE (date(created_at)=CURRENT_DATE or date(allocated_at)=CURRENT_DATE OR recall_date=CURRENT_DATE) AND allocated_to='$login_user' AND order_status=$status $limit";
                            //echo $sqlview;
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)){ ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
								<td>
                                    <input type="checkbox">
                                    <i onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=100','width=100');"  title="More" class="fa fa-info-circle text-info"></i>
								<a target="new" href="update_inquiry_status.php?id=<?php echo $rowview[0]; ?>" title="Set Call Status"><i class="fa fa-check-square-o text-info"></i></a>
                                    <a href="update_inquiry_form.php?id=<?php echo $rowview[0]; ?>" target="new" title="Update"><i class="fa fa-edit text-success"></i></a>
								</td>
								<td>
									
									<?php echo $rowview[0]; ?> </td>
								<td title="<?php echo $rowview[23] ?>"><?php echo substr($rowview[23],0,5); ?>...</td>
								<td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
								<td title="<?php echo $rowview[3] ?>"><?php echo substr($rowview[3],0,10); ?>...</td>
								<td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; ?></td>
								<td title="<?php echo $rowview[13]; ?>"><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
													<td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
                                <td title="<?php echo $rowview[17]; ?>"><?php echo substr($rowview[17],0,10); ?>...</td>
		   <td title="<?php echo $rowview[18]; ?>"><?php echo $rowview[18]; ?></td>
		   <td title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
		
              <td title="<?php echo $rowview['allocated_at']; ?>"><?php echo substr($rowview['allocated_at'],0,10); ?>...</td>
									
							
								
								

							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
	</div>
<br>
<br>
<br>

 
 <script src="vendor/jquery/jquery.js"></script>  
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
 <script src="vendor/datatables/jquery.dataTables.js"></script>  
 <!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
 <link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.js" />   
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script> 
</body>
</html>