<?php
include( "config.php" );
include( "allFunctions.php" );
     if ( isset( $_REQUEST[ 'cat' ] ) ) {
              $cat = $_REQUEST[ 'cat' ];
              $sql = "SELECT * FROM `user` where department='$cat' order by active DESC";
            } else {
              $sql = "SELECT * FROM `user` ";
            }


$query = mysqli_query($con,$sql) or die (mysqli_error($con));

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
include "start.php"; ?>
	</div>
 

	<div class="content-wrapper">
		<div class="container-fluid">
			
					
			<?php breadcrumb();
            include("view_users_tabs.php");
            
            ?>
			<div class="row" style="">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-body">
            <?php include("fix_header.php"); ?>
                    <tr>
                        
                        <th>Active</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Official Number</th>
                        <th>Preferred Network</th>
                        
                        <th>Department</th>
                           <th>Position</th>
                        <th>Group</th>
                        <th>Seller</th>
                        <th>Disease</th>
                        <th>Allocations</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($query)){?>
                    <tr style="background-color: <?php echo ($row['active'] === '0') ? 'pink' : ''; ?>;" onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');">
                            <td>
                        		<?php
									if($row['active']=='1')
									{
									?>
                                Active
								<a  onClick="return confirm('Do You Really Want To Disable <?php echo $row[1]; ?> ? \n All <?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE allocated_to='$row[1]'") ?> Inquiries Will Be Shifted To Main Pool.')"  title="Click To Disable User" href="usermanager_delete_user.php?disable=<?php echo $row[0]; ?>"><i class="fa fa-toggle-on"></i></a>
									<?php }
									else
									{
										?>
                                Inactive
								<a onClick="return confirm('Do You Really Want To Enable <?php echo $row[1]; ?> ?')"  title="Click To Enable User" href="usermanager_delete_user.php?enable=<?php echo $row[0]; ?>"><i class="fa fa-toggle-off"></i></a>
									<?php 
									}
									?>
                        </td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?>
                        <?php if($row['department']!="Owner")
                        {
                            ?>
                            <i class="fa fa-eye float-right" title="Show Password" onClick="alert('<?php echo $row['password'];?>');"></i>
                        <?php } ?>
                        </td>
                        <td><?php echo $row['official_phone'];?></td>
                        <td>
                            
                            <?php 
                                    $sql_network="SELECT network,number FROM `user_networks` WHERE username='$row[email]' ORDER BY network";
                                                                  $quer_network=mysqli_query($con,$sql_network);
                                                                  while($row_network=mysqli_fetch_array($quer_network))
                                                                  {
                                                                    echo "<span style='visibility:hidden;'>".substr($row_network[0],0,1)."</span>";
                                                                      show_network_img_title($row_network[0],$row_network[1]);
                                                                    ?>
                            
                             <?php //echo showQuery("SELECT count(*) FROM `inquiry` WHERE phone1network='$row_network[0]' AND record_type='Inquiry' AND allocated_to='$row[email]'"); ?>
                       
                            <?php
                                                                  }
                                                                  
                                                                 ?>
                        
                        </td>
                        
                        <td><?php echo $row['department'];?></td>
                        <td><?php echo $row['position'];?></td>
                        <td><?php echo $row['user_group'];?></td>
                        <td><?php echo $row['is_seller'];?></td>
                        <td><?php echo $row['disease_category'];?></td>
                        <td><?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE allocated_to='$row[1]'") ?>
                            <?php if(showQuery("Select * from inquiry  WHERE record_type='Inquiry' AND allocated_to='$row[email]' AND phone1network NOT IN(SELECT network FROM `user_networks` WHERE username='$row[email]')")!='')
                                                                 {
                                                                     ?>
                            <i class="fa fa-2x fa-warning text-warning" title="Irrelevant Network Allocations Found"></i>
                            <?php
                                                                 }
                            ?>
                            </td>
                    
                        <td>

                            <button class="btn btn-sm btn-success" title="Edit User" onClick="window.location.href='usermanager_edit_user.php?user_id=<?php echo $row['id'];?>'" ><i class=" fa fa-pencil"></i></button>
             
<!--                            <button class="btn-sm btn-danger btn-sm" onDblClick="window.location.href='usermanager_delete_user.php?user_id=<?php echo $row['id'];?>'" title="Double Click To Delete">Delete</button>-->
                               

							<button class="btn btn-sm btn-info" title="Permissions" onClick="window.open('user_with_checkbox.php?user_edit_id=<?php echo $row[0];?>','height=100',width=100);" ><i class=" fa fa-handshake-o"></i></button>
                            <br>
                                 <?php if($row['department']!="Owner")
                        {
                            ?>
                            <a class="btn-sm btn-dark" title="Login As <?php echo $row['email'];?>" href="sign_in_as.php?username=<?php echo $row['email'];?>&password=<?php echo $row['password'];?>"><i class="fa fa-sign-out"></i></a>
                         <?php } ?>
                            <button class="btn-sm btn-warning btn-sm" title="Daily Shuffle Qouta" onClick="window.open('user_no_allocations_values.php?user_edit_id=<?php echo $row[0];?>','height=200',width=200);" ><i class="fa fa-recycle"></i></button>
                            
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
<!--				content-->
				
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