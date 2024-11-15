<?php
include( "config.php" );
require_once( "allFunctions.php" );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="css\custom-theme.css">
</head>
<?php
include( "preloader.php" );
include "start.php";

$login_user = $_SESSION[ 'email' ];
$limit = "Limit 1";

$where = " ";
if ( check_admin( $login_user ) ) {

  $where = "WHERE 1";
} else {

  $where = "WHERE allocated_to='$login_user'";
}
if ( !isset( $_REQUEST[ 'type' ] ) ) {
  $_REQUEST[ 'type' ] = 'old';
}
if ( $_REQUEST[ 'type' ] == 'new' ) {

  $sql_inq = "SELECT id FROM `inquiry` WHERE allocated_to='$login_user' AND (date(allocated_at)=date('$currentDateTime') OR date(recall_date)=date('$currentDateTime')) AND id NOT IN(SELECT inquiry_id FROM `inquiry_status_history` WHERE allocated_to='$login_user' AND date(time)=date('$currentDateTime')) AND record_date = date('$currentDateTime');";

}
$today_count_new = countQuery( "SELECT * FROM `inquiry` WHERE  (date(allocated_at)=date('$currentDateTime') OR date(recall_date)=date('$currentDateTime'))   AND allocated_to='$login_user'  AND record_date = date('$currentDateTime')" );
$today_count = $today_count_new;
if ( $_REQUEST[ 'type' ] == 'old' ) {

  $sql_inq = "SELECT id FROM `inquiry` WHERE allocated_to='$login_user' AND (date(allocated_at)=date('$currentDateTime') OR date(recall_date)=date('$currentDateTime')) AND id NOT IN(SELECT inquiry_id FROM `inquiry_status_history` WHERE allocated_to='$login_user' AND date(time)=date('$currentDateTime')) AND record_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY);";
  $today_count = countQuery( "SELECT * FROM `inquiry` WHERE  (date(allocated_at)=date('$currentDateTime') OR date(recall_date)=date('$currentDateTime'))   AND allocated_to='$login_user'  " );
}

//    echo $sql_inq; 

$pending_today_count = countQuery( $sql_inq );
$completed_today_count = countQuery( "SELECT id FROM `inquiry` WHERE allocated_to='$login_user' AND (date(allocated_at)=date('$currentDateTime') OR date(recall_date)=date('$currentDateTime')) A11ND id  IN(SELECT inquiry_id FROM `inquiry_status_history` WHERE allocated_to='$login_user' AND date(time)=date('$currentDateTime'))" );
$recalls = countQuery( "SELECT * FROM `inquiry` WHERE  date(recall_date)=date('$currentDateTime') AND allocated_to='$login_user'" );
$date = showQuery( "select date('$currentDateTime')" );
?>
</div>

<div class="content-wrapper" >
  <div class="container-fluid">
    <?php
    include( "view_tasks_tabs.php" );
    $perc = 0;
    if ( $today_count > 0 ) {

      $perc = round( ( $completed_today_count * 100 ) / $today_count, 1 );
      ?>
    <?php
    }
    ?>
<!--
    My Progress
    <div class="progress">
      <div class="progress-bar progress-bar-striped active  progress-bar-animated" role="progressbar"
  aria-valuenow="<?php echo $perc; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $perc; ?>%"> <?php echo $perc; ?>% </div>
    </div>
    <br>
-->
    <?php
    //          $today_count=0;
    if ( true) {
//    if ( $today_count >= 1 ) {

//      $_REQUEST[ 'id' ] = showQuery( $sql_inq );
//      include( "update_inquiry_status.php" );
    } else {
      ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert"> You Have No Tasks Today
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
    <?php
    }
    ?>
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
<!--
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
-->
</body></html>