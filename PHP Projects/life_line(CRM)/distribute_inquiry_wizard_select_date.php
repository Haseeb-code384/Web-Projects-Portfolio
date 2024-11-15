<?php
include( "config.php" );
include( "allFunctions.php" );
if ( !isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $date;
  $end_date = $date;
}

$where=" ";
 
    if(!isset($_REQUEST['start_date']))
{
	$start_date=$date;;
}
if(!isset($_REQUEST['start_date']))
{
	$end_date=$date;
}
if(isset($_REQUEST['start_date']))
{
	$start_date=$_REQUEST['start_date'];
}
if(isset($_REQUEST['start_date']))
{
	$end_date=$_REQUEST['end_date'];
}
    if ( isset( $_REQUEST[ 'date_type' ] ) ) {
  $date_type = $_REQUEST[ 'date_type' ];
  if ( $date_type != 'date_type' ) {

    $where = $where . " AND $date_type BETWEEN '$start_date' AND '$end_date'";
  } else {

  }}

if ( isset( $_REQUEST[ 'submit' ] ) ) {
    session_start();
$date_type=$_REQUEST[ 'date_type' ];
$start_date=$_REQUEST[ 'start_date' ];
$end_date=$_REQUEST[ 'end_date' ];
    $user=$_SESSION['email'];
    executeQuery("INSERT INTO `inquiry_distribution_dates` (`id`, `date_type`, `start_date`, `end_date`, `user`, `time`) VALUES (NULL, '$date_type', '$start_date', '$end_date', '$user', '$currentDateTime')");
    
  alertredirect("Date Selection Completed","distribute_inquiry_wizard_select_users_networks.php?date_type=$date_type&start_date=$start_date&end_date=$end_date");
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
    td
        {
            width: 50%;
        }
    </style>
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
    <div class="col-sm-12">
    <form method="post" action="">
        
  <div class="row" style="">
           <div class="col-sm-4">
            <label><strong>Date Type</strong></label>
           <select class="form-select" required name="date_type">
        <option  value="">Date Type</option>
        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(created_at)")  {    echo 'selected'; } } ?>  value="date(created_at)" >Created At</option>
        <option  <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(allocated_at)")  {    echo 'selected'; } } ?>  value="date(allocated_at)">Allocated At</option>
               <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="record_date")  {    echo 'selected'; } } ?>  value="record_date">Record Date</option>
<!--        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(order_confirmed_at)")  {    echo 'selected'; } } ?> value="date(order_confirmed_at)">Order Confirmed At</option>-->
<!--        <option  <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(last_updated_at)")  {    echo 'selected'; } } ?>  value="date(last_updated_at)">Last Updated At</option>-->
        <option   <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="expected_reorder_date")  {    echo 'selected'; } } ?> value="expected_reorder_date">Expected Reorder Date</option>
<!--        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="patient_since")  {    echo 'selected'; } } ?>  value="patient_since">Patient Since</option>-->
<!--        <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(appointment_at)")  {    echo 'selected'; } } ?>  value="date(appointment_at)">Appointment At</option>  -->
          <option <?php if ( isset( $_REQUEST[ 'date_type' ] ) ) { if($_REQUEST[ 'date_type' ]=="date(recall_date)")  {    echo 'selected'; } } ?>  value="date(recall_date)">Recall Date</option> 
          
      </select>
        </div>
     <div class="col-sm-4">
      <label><strong>Start Date</strong></label>
      <input type="date" required class="form-control" name="start_date" value="<?php echo $start_date ?>">
    </div>
    <div class="col-sm-4">
      <label><strong>End Date</strong></label>
      <input type="date" required class="form-control" name="end_date"  value="<?php echo $end_date ?>">
    </div> 
   
      <center>
          <br>
        <input type="submit" required name="analyze"  value="Analyze" class="btn-sm btn-lg form-group btn-success col-2" style="width: 280px;height: 50px;">   <input type="submit" required name="submit"  value="Next" class="btn-sm btn-lg form-group btn-primary col-2" style="width: 280px;height: 50px;">
      </center>
    </form>
        <?php if(isset($_REQUEST['analyze']))
{
    ?>
        <table>
       <tr bgcolor="pink">
            <th>Network</th>
            <th>Count</th>
            </tr>
            <?php
    $sql_net="SELECT phone1network,count(*)  FROM `inquiry` Where record_type='Inquiry' AND allocated_to=''  $where GROUP BY phone1network order by phone1network='Other' ASC";
//    echo $sql_net;
    $query_net=mysqli_query($con,$sql_net);
    $sum=0;
    while($row_net=mysqli_fetch_array($query_net))
    {
            ?>
            <tr>
            <td><?php echo $row_net[0] ?></td>
            <td><?php echo $row_net[1];
                $sum=$sum+$row_net[1];
                ?></td>
            </tr>
            <?php } ?>
            <tr bgcolor="pink">
            <th>Total</th>
            <th><?php echo $sum; ?></th>
            </tr>
        </table>
        <h3 align="center">More Suggestions</h3>
        
     <?php
          
    $field=array('date(recall_date)','record_date','date(allocated_at)','date(created_at)');
            foreach($field as $rowcol) {
              ?>
         <table>
             <tr align="center" style="background-color: black; color:white;"><th colspan="2"> <strong><?php echo strtoupper( str_replace("_", " ", $rowcol)); ?> Wise Counting <?php echo "BETWEEN '$start_date' AND '$end_date' "; ?></strong></th></tr>
       <tr bgcolor="lightgreen">
            <th>Network</th>
            <th>Count</th>
            </tr>
            <?php
            
            $sqlview = "SELECT phone1network,COUNT(*) FROM `inquiry` Where record_type='Inquiry' AND allocated_to='' AND $rowcol BETWEEN '$start_date' AND '$end_date' GROUP BY phone1network order by phone1network='Other' ASC";
            $queryview = mysqli_query( $con, $sqlview );
                    $sum=0;
            while ( $row_net = mysqli_fetch_array( $queryview ) ) {
              ?>
                <tr>
            <td><?php echo $row_net[0] ?></td>
            <td><?php echo $row_net[1];
                $sum=$sum+$row_net[1];
                ?></td>
            </tr>
            <?php } ?>
            <tr bgcolor="lightgreen">
            <th>Total</th>
            <th><?php echo $sum; ?></th>
            </tr>
        </table>
      
      
    <?php } ?>
        <?php
}
        ?>
  </div>
</div>
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
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body>
</html>