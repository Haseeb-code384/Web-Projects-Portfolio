<?php
session_start();
include( "config.php" );
include( "allFunctions.php" );
$user_edit_id = $_REQUEST[ 'user_edit_id' ];
$days = array( 1, 15, 30, 45, 60, 90, 180, 365, "More Than 365" );
?>
<!doctype html>
<html lang="en">
<head>
<style>
input {
    text-align: center;
}
.text {
    width: 45px;
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
<!--        <h3>Please Specify Number Of Inquiries To Be Re-allocated Of Each Category On Daily Basis.</h3>-->
      </div>
      <br>
      <br>
      <div class="col-sm-10">
        <div class="col-sm-6">
          <label>Allow Shuffling</label>
          <input type="checkbox" name="allow_shuffling" value="Yes" <?php echo showQuery("SELECT 'checked' FROM `user` WHERE id='$user_edit_id' AND allow_shuffling!=''") ?>>
        </div>
        <h3>Netwroks</h3>
          <table>
        <?php
        $sql_network = "SELECT phone1network,count(*) FROM `inquiry` GROUP BY phone1network;";
        $query_network = mysqli_query( $con, $sql_network );
        while ( $row_network = mysqli_fetch_array( $query_network ) ) {
          ?>
              <tr height="50">
                  <td>
                  
        <input type="checkbox" value="<?php echo $row_network[0]; ?>" <?php echo showQuery("SELECT 'checked' FROM `user_networks` WHERE network='$row_network[0]' AND number!='' AND username IN(SELECT email from user where id='$user_edit_id')") ?>  name="network[]">
                  </td>
                  <td valign="middle">
        <label style="margin-top: -20px;"><?php show_network_img($row_network[0]) ?> ( <?php echo countQuery("SELECT * FROM `inquiry` WHERE phone1network='$row_network[0]' AND record_type='Inquiry' AND allocated_to IN(SELECT email from user where id='$user_edit_id')") ?> / <?php echo $row_network[1] ?> )</label>
          </td>
                  <td>
                      <?php $num=showQuery(" SELECT COALESCE(number, 0) AS number FROM `user_networks` WHERE network='$row_network[0]' AND username IN(SELECT email from user where id='$user_edit_id')");
                      if($num=='')
                      {
                          $num=0;
                      }
                      ?>
          <input type="text" name="number_user[]" value="<?php echo $num; ?>" placeholder="Enter Phone Number">
                      
                      <?php $num=0; ?>
                       </td>
                  
           </tr>
        <?php } ?>
              </table>
<!--
        <h3>Genders</h3>
        <?php
        $sql_network = "SELECT gender,count(*) FROM `inquiry` GROUP BY gender order by gender desc;";
        $query_network = mysqli_query( $con, $sql_network );
        while ( $row_network = mysqli_fetch_array( $query_network ) ) {
          ?>
        <input type="checkbox" checked name="gender[]">
        <label><?php echo $row_network[0] ?> (<?php echo $row_network[1] ?>)</label>
        <?php } ?>
          
-->       
        <h3>Disease Categories</h3>
        <?php
        $sql_network = "SELECT disease_category FROM `disease_category`  order by disease_category";
        $query_network = mysqli_query( $con, $sql_network );
        while ( $row_network = mysqli_fetch_array( $query_network ) ) {
          ?>
        <input type="checkbox" value="<?php echo $row_network[0]; ?>" <?php echo showQuery("SELECT 'checked' FROM `user_disease_category` WHERE disease='$row_network[0]' AND username IN(SELECT email from user where id='$user_edit_id')") ?> name="disease[]">
        <label><?php echo $row_network[0] ?></label>
        <?php } ?>
        <br>
        
        <!--
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
                <th colspan="2">Days</th>
                <?php foreach($days as $day)
{
                ?>
                <th colspan="2"><?php echo $day; ?> Days</th>
                <?php } ?>
                
            </tr>
              <tr>
            <th colspan="20" bgcolor="grey">Call Status</th>
          </tr>
          <tr>
            <th>ID</th>
            <th>Name</th>
                 <?php foreach($days as $day)
{
                ?>
            <th style="background-color: palegreen;">Allocate</th>
            <th  style="background-color: pink;">Unallocate</th>
              <?php } ?>
          </tr>
        
          <?php
          $sqlparent = "SELECT call_status,count(*) FROM `inquiry` GROUP BY call_status";
          $queryparent = mysqli_query( $con, $sqlparent );
          $i = 1;
          while ( $rowparent = mysqli_fetch_array( $queryparent ) ) {
            ?>
          <tr>
            <th><?php echo $i++; ?></th>
            <th><?php echo $rowparent[0]; ?> (<?php echo $rowparent[1]; ?>)
              <input type="hidden" name="status_name[]" value="<?php echo $rowparent[0]; ?>">
              <input type="hidden" name="status_type[]" value="call_status" ></th>
                 <?php foreach($days as $day)
{
                ?>
            <th style="background-color: palegreen;"><input type="number" class="text" name="all[]"  value="<?php echo showQuery("SELECT allocate FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='call_status' AND status_name='$rowparent[0]'"); ?>"  ></th>
            <th style="background-color: pink;"><input type="number" class="text" name="rev[]"  value="<?php echo showQuery("SELECT get_back FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='call_status' AND status_name='$rowparent[0]'"); ?>" ></th>
              <?php } ?>
          </tr>
          <?php


          }
          ?>
            
          <tr>
            <th colspan="20" bgcolor="grey">Order Status</th>
          </tr>
             <tr>
                <th colspan="2">Days</th>
                <?php foreach($days as $day)
{
                ?>
                <th colspan="2"><?php echo $day; ?> Days</th>
                <?php } ?>
                
            </tr>
               <tr>
            <th>ID</th>
            <th>Name</th>
                 <?php foreach($days as $day)
{
                ?>
            <th style="background-color: palegreen;">Allocate</th>
            <th  style="background-color: pink;">Unallocate</th>
              <?php } ?>
          </tr>
          <?php
          $sqlparent = "SELECT order_status,count(*) FROM `inquiry` GROUP BY order_status;";
          $queryparent = mysqli_query( $con, $sqlparent );
          $i = 1;
          while ( $rowparent = mysqli_fetch_array( $queryparent ) ) {
            ?>
          <tr>
            <th><?php echo $i++; ?></th>
            
            <th><?php echo $rowparent[0]; ?> (<?php echo $rowparent[1]; ?>)
              <input type="hidden" name="status_name[]" value="<?php echo $rowparent[0]; ?>">
              <input type="hidden" name="status_type[]" value="order_status" ></th>
                 <?php foreach($days as $day)
{
                ?>
            <th style="background-color: palegreen;"><input type="number" class="text" name="all[]" value="<?php echo showQuery("SELECT allocate FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='order_status' AND status_name='$rowparent[0]'"); ?>" ></th>
            <th  style="background-color: pink;"><input type="number" class="text" name="rev[]"  value="<?php echo showQuery("SELECT get_back FROM `user_inquiry_limit` WHERE user_id='$user_edit_id' AND status_type='order_status' AND status_name='$rowparent[0]'"); ?>" ></th>
              <?php } ?>
          </tr>
          
          <?php


          }
          ?>
        </table>
          
--> 
      </div>
    </div>
    <br>
    <input type="submit"  value="Update" name="update" class="btn-sm btn-outline-primary">
  </form>
</div>
</div>
</body>
</html>