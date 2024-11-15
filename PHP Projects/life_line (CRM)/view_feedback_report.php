<?php

include( "config.php" );
include( "allFunctions.php" );
$user=$_REQUEST['user'];
$start_date=$_REQUEST['start_date'];
$end_date=$_REQUEST['end_date'];
$sql_info = "SELECT type,status,time,allocated_to,allocated_by,order_no,comments,call_type,duration,inquiry_id FROM `inquiry_status_history` WHERE type='Feedback' AND entered_by='$user' AND date(time) BETWEEN '$start_date' AND '$end_date' ;";;
$query_info = mysqli_query( $con, $sql_info );
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.min.css">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
<style>
textarea {
    width: 100%;
    height: 300px;
}
</style>
</head>
<body>
<?php include("start.php"); ?>
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row" >
    <?php breadcrumb(); ?>
   
      <div class="col-lg-12">
        <div class="row">
          <?php include("fix_header.php"); ?>
              <th>Type</th>
                <th>Step/Status</th>
                <th>Comment</th>
                <th>Time</th>
                <th>Seller</th>
                <th>Feedback By</th>
                <th>Contact Type</th>
                <th>Duration</th>
                <th>Call Status</th>
                <th>Medicine Status</th>
                <th>Patient Feedback</th>
              </tr>
              </thead>
              
              <?php
              while ( $rowview = mysqli_fetch_array( $query_info ) ) {
                ?>
              <tr>
                <td><?php echo $rowview[0]; ?></td>
                <td><?php echo $rowview[1]; ?></td>
                <td><?php echo  $rowview[6]; ?></td>
                <td><?php echo change_datetime_ddmmyyyhis($rowview[2]); ?></td>
                <td><?php echo $rowview[3]; ?></td>
                <td><?php echo $rowview[4]; ?></td>
                <td><?php echo $rowview['call_type']; ?></td>
                <td><?php echo $rowview['duration']; ?></td>
                <td><?php echo $rowview['call_status']; ?></td>
                <td><?php echo $rowview['medicine_status']; ?></td>
                <td><?php echo $rowview['patient_feedback']; ?></td>
                
              </tr>
              <?php } ?>
            </table>
          </div>
          <br>
        </div>
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