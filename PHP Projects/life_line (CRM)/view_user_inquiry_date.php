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

$login_user = $_SESSION[ 'email' ];
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
  $end_date = $_REQUEST[ 'end_date' ];
} else {
  $start_date = date( "Y-m-01" );
  $end_date = $date;
}


if ( isset( $_REQUEST[ 'order_status' ] ) ) {
  $order_status = $_REQUEST[ 'order_status' ];
  $sqlview = "SELECT * FROM `inquiry`  WHERE allocated_to='$login_user' AND order_status='$order_status' AND date(allocated_at) BETWEEN '$start_date' AND '$end_date'";
} else if ( isset( $_REQUEST[ 'call_status' ] ) ) {
  $call_status = "'" . $_REQUEST[ 'call_status' ] . "'";

  $sqlview = "SELECT * FROM `inquiry`  WHERE allocated_to='$login_user' AND call_status=$call_status AND date(allocated_at) BETWEEN '$start_date' AND '$end_date'";
} else {
  $call_status = 'call_status';
  $sqlview = "SELECT * FROM `inquiry`  WHERE allocated_to='$login_user' AND date(allocated_at) BETWEEN '$start_date' AND '$end_date'";

}
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <div class="col-lg-12">
      <?php include("user_inquiry_date_tabs.php"); ?>
    <?php
    include( "fix_header.php" );
    ?>
        
      <?php include("inquiry_table.php"); ?>
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