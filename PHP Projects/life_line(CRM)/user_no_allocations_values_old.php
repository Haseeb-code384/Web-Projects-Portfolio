<?php
session_start();
include( "config.php" );
include( "allFunctions.php" );
$user_edit_id = $_REQUEST[ 'user_edit_id' ];
?>
<!doctype html>
<html lang="en">
<head>
<style>
input {
    text-align: center;
}
</style>
<meta charset="UTF-8">
<meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<div class="container-fluid" align="center">
  <div class="col-md-8 align-content-center">
  <form method="post" action="update_daily_allocation.php?user_update_id=<?php echo $user_edit_id; ?>">
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <?php

        $sql = "SELECT * FROM user where id = $user_edit_id";
        $result = mysqli_query( $con, $sql )or die( mysqli_error( $con ) );
        $row = mysqli_fetch_array( $result );

        ?>
        <h1><?php echo $row['name'];?></h1>
        <h3>Please Specify Number Of Inquiries To Be Re-allocated Of Each Category On Daily Basis.</h3>
      </div>
      <br>
      <br>
      <div class="col-sm-10">
        <div class="col-sm-6">
          <label>Allow Shuffling</label>
          <input type="checkbox" name="enable" checked>
        </div>
        <div class="col-sm-6">
          <label>Start Date</label>
          <input type="date" name="start_date">
        </div>
        <div class="col-sm-6">
          <label>End Date</label>
          <input type="date" name="end_date">
        </div>
        <div class="col-sm-6">
          <label>Days Limit</label>
          <input type="number" name="days" value="90">
        </div>
        <table border="1" width="100%">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Allocate</th>
            <th>Revoke</th>
          </tr>
          <tr>
            <th colspan="4" bgcolor="grey">Call Status</th>
          </tr>
          <?php
          $sqlparent = "SELECT * FROM `status_list` ORDER BY `status_name`";
          $queryparent = mysqli_query( $con, $sqlparent );
          $i = 1;
          while ( $rowparent = mysqli_fetch_array( $queryparent ) ) {
            ?>
          <tr>
            <th><?php echo $i++; ?></th>
            <th><?php echo $rowparent[0]; ?>
              <input type="hidden" name="status_name[]" value="<?php echo $rowparent[0]; ?>">
              <input type="hidden" name="status_type[]" value="call_status" ></th>
            <th><input type="number" name="all[]"  value="<?php echo showQuery("SELECT allocate FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='call_status' AND status_name='$rowparent[0]'"); ?>"  ></th>
            <th><input type="number" name="rev[]"  value="<?php echo showQuery("SELECT get_back FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='call_status' AND status_name='$rowparent[0]'"); ?>" ></th>
          </tr>
          <?php


          }
          ?>
          <tr>
            <th colspan="4" bgcolor="grey">Order Status</th>
          </tr>
          <?php
          $sqlparent = "SELECT * FROM `order_status`";
          $queryparent = mysqli_query( $con, $sqlparent );
          $i = 1;
          while ( $rowparent = mysqli_fetch_array( $queryparent ) ) {
            ?>
          <tr>
          <tr>
            <th><?php echo $i++; ?></th>
            <th><?php echo $rowparent[0]; ?>
              <input type="hidden" name="status_name[]" value="<?php echo $rowparent[0]; ?>">
              <input type="hidden" name="status_type[]" value="order_status" ></th>
            <th><input type="number" name="all[]" value="<?php echo showQuery("SELECT allocate FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='order_status' AND status_name='$rowparent[0]'"); ?>" ></th>
            <th><input type="number" name="rev[]"  value="<?php echo showQuery("SELECT get_back FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='order_status' AND status_name='$rowparent[0]'"); ?>" ></th>
          </tr>
          </tr>
          
          <?php


          }
          ?>
        </table>
      </div>
    </div>
    <br>
    <input type="submit"  value="Update" name="update" class="btn-sm btn-outline-primary">
  </form>
</div>
</div>
</body>
</html>