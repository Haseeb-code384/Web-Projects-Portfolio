<?php
include( "config.php" );
include( "allFunctions.php" );

include( "limit_record.php" );

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
$where = "WHERE allocated_to='$login_user' ";
include( "limit_record.php" );
if ( isset( $_REQUEST[ 'order_status' ] ) ) {
  $order_status = $_REQUEST[ 'order_status' ];
  if ( $order_status != 'order_status' ) {
    $order_status = "'" . $_REQUEST[ 'order_status' ] . "'";
  }
  $where = $where . " AND order_status=$order_status";
}
if ( isset( $_REQUEST[ 'call_status' ] ) ) {
  $call_status = $_REQUEST[ 'call_status' ];
  if ( $call_status != 'call_status' ) {
    $call_status = "'" . $_REQUEST[ 'call_status' ] . "'";
  }
  $where = $where . " AND call_status=$call_status";
}
if ( isset( $_REQUEST[ 'phone1network' ] ) ) {

  $phone1network = $_REQUEST[ 'phone1network' ];
  if ( $phone1network != 'phone1network' ) {
    $phone1network = "'" . $_REQUEST[ 'phone1network' ] . "'";
  }

  $where = $where . " AND phone1network=$phone1network";

}
if ( isset( $_REQUEST[ 'gender' ] ) ) {
  $gender = $_REQUEST[ 'gender' ];
  if ( $gender != 'gender' ) {
    $gender = "'" . $_REQUEST[ 'gender' ] . "'";
  }

  $where = $where . " AND gender=$gender";
}
if ( isset( $_REQUEST[ 'seller' ] ) ) {
  $seller = $_REQUEST[ 'seller' ];
  if ( $seller != "" ) {
    $seller = "'" . $_REQUEST[ 'seller' ] . "'";
  } else {
    $seller = 'allocated_to';
  }

  $where = $where . " AND allocated_to=$seller";
}
if ( isset( $_REQUEST[ 'disease' ] ) ) {
  $disease = $_REQUEST[ 'disease' ];
  if ( $disease != 'disease' ) {

    $disease = "'" . $_REQUEST[ 'disease' ] . "'";
    $where = $where . " AND id IN (SELECT inquiry_id FROM `inquiry_disease` WHERE disease=$disease)";
  } else {

  }
}
$sqlview = "SELECT * FROM `inquiry` $where $limit; ";
//echo $sqlview;


?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <?php include("user_inquiry_all_tabs.php"); ?>
    <?php include("fix_header.php"); ?>
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