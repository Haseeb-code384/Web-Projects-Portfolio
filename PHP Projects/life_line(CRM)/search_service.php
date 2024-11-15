<?php
include( "config.php" );
include( "allFunctions.php" );
if ( isset( $_REQUEST[ 'days' ] ) ) {
$days=$_REQUEST['days'];
  if ( $days <= "90" ) {
    $sqlview = "SELECT * FROM inquiry WHERE id IN(SELECT order_patient_id FROM `order_dispatch_info` WHERE STATUS='Delivered' AND order_date BETWEEN DATE_SUB(CURDATE(), INTERVAL $days DAY) AND  CURDATE() )";
  }else
    {
        
    $sqlview = "SELECT * FROM inquiry WHERE id IN(SELECT order_patient_id FROM `order_dispatch_info` WHERE STATUS='Delivered' AND order_date < DATE_SUB(CURDATE(), INTERVAL 90 DAY))";
    }
  include( "limit_record.php" );
}
?>
<html>
<head>
<script src="js/selectall.js"></script> 
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
    <?php breadcrumb(); ?>
    <?php
    if ( isset( $_REQUEST[ 'days' ] ) ) {
      ?>
    <form method="post" action="">
      <?php
      $queryview = mysqli_query( $con, $sqlview );
      echo mysqli_num_rows( $queryview );
      ?>
      Records Found</strong> Select
      <input type="number" id="no" onKeyUp="selallno(this,'emp[]');" value="0" size="50">
      Rows <span style="float: right;">
      <label>User:
        <select class="form-select-sm"  name="allocated_to">
          <?php populateDDcondition("user","email","email","WHERE active= 1 order by email") ?>
        </select>
      </label>
      <input type="submit"  name="submit" value="Allocate" class="btn-sm btn-primary">
      </span>
      <?php
      include( "fix_header.php" );
      include( "inquiry_table.php" );

      ?>
      <?php } ?>
    </form>
  </div>
</div>
<br>
<br>
<br>
</body>
</html>