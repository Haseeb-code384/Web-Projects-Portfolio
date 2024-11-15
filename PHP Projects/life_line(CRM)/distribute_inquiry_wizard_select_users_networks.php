<?php
include( "config.php" );
include( "allFunctions.php" );
if ( !isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $date;
  $end_date = $date;
}

$where = " ";

if ( !isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $date;
}
if ( !isset( $_REQUEST[ 'start_date' ] ) ) {
  $end_date = $date;
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $end_date = $_REQUEST[ 'end_date' ];
}
if ( isset( $_REQUEST[ 'date_type' ] ) ) {
  $date_type = $_REQUEST[ 'date_type' ];
  if ( $date_type != 'date_type' ) {

    $where = $where . " AND $date_type BETWEEN '$start_date' AND '$end_date'";
  } else {

  }
}

if ( isset( $_REQUEST[ 'submit' ] ) ) {
  $i = 0;
  //
  $date_type = $_REQUEST[ 'date_type' ];
  $start_date = $_REQUEST[ 'start_date' ];
  $end_date = $_REQUEST[ 'end_date' ];
  $emp = $_REQUEST[ 'emp' ];
  $allocations = $_REQUEST[ 'allocations' ];
  $network = $_REQUEST[ 'network' ];
  //  $stat = $_REQUEST[ 'status' ];
  session_start();
  $login_user = $_SESSION[ 'email' ];
  foreach ( $emp as $status ) {
    //    executeQuery( "UPDATE `user` SET allow_shuffling='$status' WHERE email='$emp[$i]';" );
    $sql_inquiries = "SELECT id  FROM `inquiry` Where record_type='Inquiry' AND allocated_to='' AND $date_type BETWEEN '$start_date' AND '$end_date' AND phone1network='$network[$i]' LIMIT $allocations[$i]";
    //      echo $sql_inquiries;
    $query_inquiries = mysqli_query( $con, $sql_inquiries );
      if(mysqli_num_rows($query_inquiries)>0)
      {
    while ( $row_inquiries = mysqli_fetch_array( $query_inquiries ) ) {
      //          $url="process_inquiry_employee_allocation.php?allocated_to=$emp[$i]&emp=$row_inquiries[0]";

      $allocated_to = $emp[ $i ];
      executeQuery( "UPDATE `inquiry` SET `allocated_to` = '$allocated_to',`allocated_at` = '$currentDateTime' WHERE id = '$row_inquiries[0]';" );
      $id = $row_inquiries[ 0 ];
      executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`) VALUES (NULL, '$id','Allocation','Inquiry Allocated', '$currentDateTime','$allocated_to','$login_user')" );

    }
      }
    //      echo ("email='$emp[$i]' AND allocations='$allocations[$i] and network='$network[$i]' And DAte BETWEEN '$start_date' AND '$end_date' <br>");
    $i++;
  }
  alertredirect( "Inquiries Successfully Allocated To Users", "dashboard.php" );
}
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
include "preloader.php";
?>
<?php

include "start.php";
?>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <?php
    include( "distribute_inquiry_wizard_tabs.php" );
    ?>
    <form method="post" action="">
      <div class="row" style="">
      <div class="col-sm-4"> 
        <!--
      <select class="form-select" required name="date_type">
        <option  value="">Date Type</option>
        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(created_at)")  {    echo 'selected'; } } ?>  value="date(created_at)" >Created At</option>
        <option  <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(allocated_at)")  {    echo 'selected'; } } ?>  value="date(allocated_at)">Allocated At</option>
               <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="record_date")  {    echo 'selected'; } } ?>  value="record_date">Record Date</option>

          <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(recall_date)")  {    echo 'selected'; } } ?>  value="date(recall_date)">Recall Date</option> 
          
      </select>
-->
        <input type="hidden" name="date_type" value="<?php echo $_REQUEST[ 'date_type' ]; ?>">
      </div>
      <div class="col-sm-4">
        <input type="hidden" required class="form-control" name="start_date" value="<?php echo $start_date ?>">
      </div>
      <div class="col-sm-4">
        <input type="hidden" required class="form-control" name="end_date"  value="<?php echo $end_date ?>">
      </div>
      <center>
        <br>
      </center>
      <?php include("fix_header.php"); ?>
          <tr class="" align="center">
            <th width="180" >Username</th>
            <th width="180" >Name</th>
            <th width="180" >Allocations</th>
            <?php

$today = $date;
$yesterday = getDateWithOffset( -1 );

$thirtyDaysAgo = getDateWithOffset( -30 );
            $sqln = "SELECT phone1network,count(*)  FROM `inquiry` Where record_type='Inquiry' AND allocated_to=''  $where GROUP BY phone1network order by phone1network ";
            $queryn = mysqli_query( $con, $sqln );
            while ( $rown = mysqli_fetch_array( $queryn ) ) {
              ?>
            <th><?php echo show_network_img($rown[0]);  ?><br>
              <?php echo $rown[1]; ?></th>
            <?php } ?>
          </tr>
        </thead>
        <?php
        $i = 1;
        $sqls = "SELECT * FROM `user` WHERE active=1 AND is_seller='Yes' AND allow_shuffling='Yes' order by user_group";
        $querys = mysqli_query( $con, $sqls );
        while ( $rows = mysqli_fetch_array( $querys ) ) {
          ?>
        <tr class="">
          <td align="center" class=""><?php  echo($rows['email']); ?></td>
          <td align="center" class=""><?php  echo($rows['name']); ?></td>
            <td>
                <table>
                <tr>
                <td>All</td>    
                <th><?php echo showQuery("SELECT count(*) FROM `inquiry` WHERE allocated_to='$rows[email]'"); ?></th>    
                </tr> 
                    <tr>
                <td>Last 30 Days</td>    
                <th><?php echo showQuery("SELECT count(*) FROM `inquiry` WHERE allocated_to='$rows[email]' AND date(allocated_at) BETWEEN '$thirtyDaysAgo' AND '$today'"); ?></th>    
                </tr>
                    <tr>
                <td>Yesterday</td>    
                <th><?php echo showQuery("SELECT count(*) FROM `inquiry` WHERE allocated_to='$rows[email]' AND date(allocated_at)='$yesterday'"); ?></th>    
                </tr> <tr>
                <td>Today</td>    
                <th><?php echo showQuery("SELECT count(*) FROM `inquiry` WHERE allocated_to='$rows[email]' AND date(allocated_at)='$today'"); ?></th>    
                </tr>
                </table>
                
              
            </td>
          <?php

          $sqln = "SELECT phone1network,count(*)  FROM `inquiry` Where record_type='Inquiry' AND allocated_to=''  $where GROUP BY phone1network order by phone1network";
          //            echo $sqln;
          $queryn = mysqli_query( $con, $sqln );
          while ( $rown = mysqli_fetch_array( $queryn ) ) {
            ?>
          <td align="center" valign="middle"><?php
          $count_user = 0;
          $allowed = '';
          $allowed = showQuery( "SELECT 'checked' FROM `user_networks` WHERE network='$rown[0]' AND number!='' AND username='$rows[email]'" );
          $count_user = showQuery( "SELECT count(*) FROM `user_networks` WHERE network='$rown[0]' AND number!='' AND username IN (SELECT email FROM `user` WHERE active=1 AND is_seller='Yes' AND allow_shuffling='Yes' )" );
          if ( $allowed != '' ) {
            ?>
            <input type="hidden" name="emp[]" value="<?php echo($rows['email']); ?>"/>
            <input type="hidden" name="network[]" value="<?php echo $rown[0]; ?>">
              <strong title="<?php echo "Yesterdays allocation of $rown[0] for $rows[email]" ?>"> <?php echo showQuery("SELECT count(*) FROM `inquiry` WHERE allocated_to='$rows[email]' AND date(allocated_at)='$yesterday' AND phone1network='$rown[0]'"); ?></strong> / <strong title="<?php echo "Todays allocation of $rown[0] for $rows[email]" ?>"> <?php echo showQuery("SELECT count(*) FROM `inquiry` WHERE allocated_to='$rows[email]' AND date(allocated_at)='$date' AND phone1network='$rown[0]'"); ?></strong>
            <input  type="number" name="allocations[]" value="<?php echo floor($rown[1]/$count_user); ?>" title="<?php echo $rown[0]; ?>"    ></td>
          <?php
          }

          }
          ?>
          <!--
          <td align="center"><input type="radio"  <?php echo ($rows['allow_shuffling']=="Yes") ? 'checked' : '' ?>  id="present"  value="Yes" name="status[<?php echo $i; ?>]" title="<?php  echo($rows[1]); ?>" /></td>
          <td align="center"><input type="radio" <?php echo ($rows['allow_shuffling']=="No") ? 'checked' : '' ?>  value="No" title="<?php  echo($rows[1]); ?>" name="status[<?php echo $i; ?>]"  ></td>
            
--> 
        </tr>
        <?php $i++;} ?>
      </table>
      <input type="hidden" name="i" value="<?php echo($i); ?>"/>
      <center>
        <input type="submit" required name="submit"  value="Allocate Now" class="btn-sm btn-lg form-group btn-primary col-2" style="width: 280px;height: 50px;">
      </center>
    </form>
  </div>
</div>
<br>
<br>
<br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   --> 
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
</body>
</html>