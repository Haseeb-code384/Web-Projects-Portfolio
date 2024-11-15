<?php
include( "config.php" );
include( "allFunctions.php" );

include("limit_record.php");
if ( isset( $_REQUEST[ 'status' ] ) ) {
  $status = "'" . $_REQUEST[ 'status' ] . "'";
} else {
  $status = 'call_status';
}
        $sqlview = "SELECT * FROM `inquiry`  WHERE (date(created_at)=CURRENT_DATE or date(allocated_at)=CURRENT_DATE OR recall_date=CURRENT_DATE) AND allocated_to='$login_user' AND call_status=$status $limit";
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

$login_user = $_SESSION[ 'email' ];
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php breadcrumb(); ?>
      <?php include("user_inquiry_tabs.php"); ?>
      <?php include("fix_header.php"); ?>
         
      <?php include("inquiry_table.php"); ?>
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