<?php 
include("config.php");
include("allFunctions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="css\bootstrap.min.css">
	<link rel="stylesheet" href="css\custom-theme.css">
</head>
    <?php include("preloader.php"); ?>
	
	<?php 
include "start.php";
	
$login_user=$_REQUEST['login_user'];
    
    if(isset($_REQUEST['order_status']))
{
        $order_status=$_REQUEST['order_status'];
$sqlview="SELECT * FROM `inquiry`  WHERE allocated_to='$login_user' AND order_status='$order_status'";
}
else if(isset($_REQUEST['call_status']))
{
$call_status="'".$_REQUEST['call_status']."'";   
    
$sqlview="SELECT * FROM `inquiry`  WHERE allocated_to='$login_user' AND call_status=$call_status";
}
else
{
    $call_status='call_status';
    
$sqlview="SELECT * FROM `inquiry`  WHERE allocated_to='$login_user'";
}

    

	?></div>
	
<div class="content-wrapper">
	<div class="container-fluid">
		<?php breadcrumb(); ?>
		<div class="col-lg-12">
                 <h1><?php echo $login_user; ?></h1>
            <?php
            $active="";
$currentpage = basename($_SERVER['REQUEST_URI']);
$currentpage=str_replace("%20"," ",$currentpage);
$this_page_name="view_user_inquiry_all_by_username.php";

//$page_names=;
//$count_pages=count($page_names);
?>

        <select onChange="window.location.href=this.value" class="form-select col-6 offset-md-3">
              <option value="<?php echo $this_page_name.'?login_user='.$login_user; ?>" <?php if($currentpage==$this_page_name)
{
    echo 'selected';
} ?>>All (<?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE allocated_to='$login_user'"); ?>)</option>
   
            <option disabled>------Orders------</option>
            <?php
         //   for($i=0;$i<$count_pages;$i++)
            $sqlpg="SELECT * FROM `order_status` ORDER BY `order_status`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
            
    $page_link=$this_page_name."?cat=".$page_names[0];
            ?>
            
  
            
            <?php
while($page_names=mysqli_fetch_array($querypg))
            {
    $page_link=$this_page_name."?order_status=".$page_names[0]."&login_user=".$login_user;
            ?>
  
           <option  <?php if($currentpage==$page_link)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> Orders (<?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE allocated_to='$login_user' AND order_status='$page_names[0]'"); ?>)</option>
            <?php } 
            ?>
            <option disabled>------Calls------</option>
            <?php
             $sqlpg="SELECT * FROM `status_list` ORDER BY `status_name`='Pending' DESC";
$querypg=mysqli_query($con,$sqlpg);
       
while($page_names=mysqli_fetch_array($querypg))
             {
    $page_link=$this_page_name."?call_status=".$page_names[0]."&login_user=".$login_user;
            ?>
  
           <option  <?php if($currentpage==$page_link)
{
    echo 'selected';
            } ?> value="<?php echo $page_link; ?>"><?php echo $page_names[0]; ?> Calls (<?php echo showQuery("SELECT COUNT(*) FROM `inquiry` WHERE allocated_to='$login_user' AND call_status='$page_names[0]'"); ?>)</option>
            <?php } 
            
            
            
            ?>
</select>
    
       
            <?php include("fix_header.php"); ?>
							<tr>
								<th style="width: 70px;">Actions</th>
								<th>ID</th>
								<th>Source</th>
								<th>Name</th>
								<th>Mobile1</th>
								<th>Mobile2</th>
								<th>Whatsapp</th>
								<th style="width: 80px;">Call Status</th>
								<th style="width: 80px;">Called At</th>
								<th style="width: 100px;">Recall Date</th>
								<th style="width: 100px;">Order Status</th>
							
								
		
							</tr>
						</thead>
						<tbody>
                            <script>
                                function clearbg(x)
                                {
                                    x.backgroundColor=null;
                                }
                            </script>
							<?php
							$queryview=mysqli_query($con,$sqlview);
							while($rowview=mysqli_fetch_array($queryview)) { ?>
							<tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"  >
									<td style="display: inline;">
                                    <input type="checkbox">
                                    <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i>
                                    <i title="Status History" onClick="window.open('inquiry_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i>
                                    
                                    
                                    	<a target="new" href="update_inquiry_status.php?id=<?php echo $rowview[0]; ?>" title="Set Call Status"><i class="fa fa-volume-control-phone text-warning"></i></a>
                                    
                                    <a target="new" href="update_inquiry_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a>
                                    <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i>
                                </td>
								<td>
									
									<?php echo $rowview[0]; ?> </td>
								<td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
								<td title="<?php echo $rowview[3] ?>"><?php echo substr($rowview[3],0,10); ?>...</td>
								<td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; ?></td>
								<td title="<?php echo $rowview[13]; ?>"><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
													<td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
                                <td title="<?php echo $rowview[17]; ?>"><?php echo substr($rowview[17],0,10); ?>...</td>
		   <td title="<?php echo $rowview[18]; ?>"><?php echo $rowview[18]; ?></td>
		   <td title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
		
								
							
								
								

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