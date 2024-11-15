<?php
include( "config.php" );
include( "allFunctions.php" );
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

$login_user = $_REQUEST[ 'login_user' ];
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
  $end_date = $_REQUEST[ 'end_date' ];
} else {
  $start_date = date( "Y-m-01" );
  $end_date = $date;
}

  $sqlview = "SELECT * from inquiry WHERE id IN (SELECT  inquiry_id FROM `inquiry_status_history` WHERE type='Order' AND date(time) BETWEEN '$start_date' AND '$end_date' AND inquiry_id in (SELECT id FROM `inquiry` WHERE allocated_to='$login_user'))";


?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
      <h3>Inquireies Ordered By <?php echo $login_user; ?> Between <?php echo $start_date; ?> & <?php echo $end_date; ?></h3>
    <div class="col-lg-12">
      <?php //include("user_inquiry_date_tabs.php"); ?>
    <?php
    include( "fix_header.php" );

    ?>
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
								<th style="width: 100px;">Date</th>
    </tr>
    </thead>
    <tbody>
      <?php
      $queryview = mysqli_query( $con, $sqlview );
      while ( $rowview = mysqli_fetch_array( $queryview ) ) {
        ?>
      <tr onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"  >
     <td style="display: inline;">
                                    <input type="checkbox">
                                    <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i>
                                    <i title="Status History" onClick="window.open('inquiry_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i>
                                    
                                    
                                    	<a target="new" href="update_inquiry_status.php?id=<?php echo $rowview[0]; ?>" title="Set Call Status"><i class="fa fa-volume-control-phone text-warning"></i></a>
                                    
                                    <a target="new" href="update_inquiry_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a>
                                    <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i>
                                </td>
     <td> <?php echo $rowview[0]; ?> </td>
								<td title="<?php echo $rowview[2] ?>"><?php echo substr($rowview[2],0,5); ?>...</td>
								<td title="<?php echo $rowview[3] ?>"><?php echo substr($rowview[3],0,10); ?>...</td>
								<td title="<?php echo $rowview[11]; ?>"><?php echo $rowview[10]; ?></td>
								<td title="<?php echo $rowview[13]; ?>"><?php echo $rowview[12]; ?></td>
								<td><?php echo $rowview[14]; ?></td>
													<td title="<?php echo $rowview[16] ?>"><?php echo substr($rowview[16],0,5); ?>...</td>
                                <td title="<?php echo $rowview[17]; ?>"><?php echo substr($rowview[17],0,10); ?>...</td>
		   <td title="<?php echo $rowview[18]; ?>"><?php echo $rowview[18]; ?></td>
		   <td title="<?php echo $rowview[19]; ?>"><?php echo substr($rowview[19],0,5); ?>...</td>
		
              <td title="<?php echo $rowview['allocated_at']; ?>"><?php echo substr($rowview['allocated_at'],0,10); ?></td>
      
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