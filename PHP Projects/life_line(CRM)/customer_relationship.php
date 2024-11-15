<?php
include( "config.php" );
include( "allFunctions.php" );
$sql_all_cso = "SELECT email FROM `user` WHERE position='Customer Care Officer' AND active='1';";
$query_all_cso = mysqli_query( $con, $sql_all_cso );
while ( $row_all_cso = mysqli_fetch_array( $query_all_cso ) ) {
  $cso_email = $row_all_cso[ 0 ];
  $counting_of_rows = showQuery( "SELECT floor(COUNT(DISTINCT inquiry_id)/(SELECT count(*) FROM `user` WHERE position='Customer Care Officer' AND active='1')) FROM `inquiry_status_history` WHERE status='Agreed To Order' AND date(time)>= DATE_SUB(CURDATE(), INTERVAL 90 DAY);" );
    
  //executeQuery( "INSERT INTO `feedback_user_orders_allocation` (`user`, `inquiry_id`, `time`) (SELECT '$cso_email',inquiry_id,'$currentDateTime' FROM `order_dispatch_info` where order_date>='2023-10-01' and inquiry_id NOT IN (SELECT inquiry_id FROM `feedback_user_orders_allocation`) GROUP BY order_patient_id ORDER BY rand()  limit $counting_of_rows)" );
  executeQuery( "INSERT INTO `feedback_user_orders_allocation` (`user`, `inquiry_id`, `time`) (SELECT '$cso_email',inquiry_id,'$currentDateTime'  FROM `inquiry_status_history` WHERE status='Agreed To Order' AND date(time)>= DATE_SUB(CURDATE(), INTERVAL 90 DAY) and inquiry_id NOT IN (SELECT inquiry_id FROM `feedback_user_orders_allocation`) group by inquiry_id ORDER BY rand()  limit $counting_of_rows ) ;" );
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
<?php include("preloader.php"); 
include "start.php";

    $login_user = $_SESSION[ 'email' ];
    
if(check_admin($_SESSION['email']))
{
    $where=" where id IN (SELECT inquiry_id FROM `feedback_user_orders_allocation` WHERE user='$_REQUEST[seller]') ";
}
    else
    {
        $where=" where id IN (SELECT inquiry_id FROM `feedback_user_orders_allocation` WHERE user='$login_user') ";
    }

//if(check_admin($login_user))
//{
//   
//$where="WHERE 1";
//}
//else
//{
//   
//$where="WHERE allocated_to='$login_user'";
//}
    
include( "limit_record.php" );
if ( isset( $_REQUEST[ 'order_status' ] ) ) 
{
  $order_status = $_REQUEST[ 'order_status' ];
    if($order_status!='order_status')
    {
  $order_status = "'" . $_REQUEST[ 'order_status' ] . "'";
    }
  $where=$where." AND order_status=$order_status";
}
    if ( isset( $_REQUEST[ 'call_status' ] ) ) 
{
  $call_status = $_REQUEST[ 'call_status' ];
         if($call_status!='call_status')
    {
  $call_status = "'" . $_REQUEST[ 'call_status' ] . "'";
         }
$where=$where." AND call_status=$call_status";
}
    if ( isset( $_REQUEST[ 'phone1network' ] ) ) {
        
  $phone1network = $_REQUEST[ 'phone1network' ];
 if($phone1network!='phone1network')
    { $phone1network = "'" . $_REQUEST[ 'phone1network' ] . "'";}

        $where=$where." AND phone1network=$phone1network";

}   if ( isset( $_REQUEST[ 'phone2network' ] ) ) {
        
  $phone2network = $_REQUEST[ 'phone2network' ];
 if($phone2network!='phone2network')
    { $phone2network = "'" . $_REQUEST[ 'phone2network' ] . "'";}

        $where=$where." AND phone2network=$phone2network";

}   
    if ( isset( $_REQUEST[ 'source' ] ) ) {
        
  $source = $_REQUEST[ 'source' ];
 if($source!='source')
    { $source = "'" . $_REQUEST[ 'source' ] . "'";}

        $where=$where." AND source=$source";

}    if ( isset( $_REQUEST[ 'record_type' ] ) ) {
        
  $record_type = $_REQUEST[ 'record_type' ];
 if($record_type!='record_type')
    { $record_type = "'" . $_REQUEST[ 'record_type' ] . "'";}

        $where=$where." AND record_type=$record_type";

} 
    if ( isset( $_REQUEST[ 'province' ] ) ) {
        
  $province = $_REQUEST[ 'province' ];
 if($province!='province')
    { $province = "'" . $_REQUEST[ 'province' ] . "'";}

        $where=$where." AND province=$province";

}  
    if ( isset( $_REQUEST[ 'district' ] ) ) {
        
  $district = $_REQUEST[ 'district' ];
 if($district!='district')
    { $district = "'" . $_REQUEST[ 'district' ] . "'";}

        $where=$where." AND district=$district";

}  if ( isset( $_REQUEST[ 'tehsil' ] ) ) {
        
  $tehsil = $_REQUEST[ 'tehsil' ];
 if($tehsil!='tehsil')
    { $tehsil = "'" . $_REQUEST[ 'tehsil' ] . "'";}

        $where=$where." AND tehsil=$tehsil";

}  
    if ( isset( $_REQUEST[ 'gender' ] ) ) {
    $gender = $_REQUEST[ 'gender' ];
 if($gender!='gender')
    { $gender = "'" . $_REQUEST[ 'gender' ] . "'";}

        $where=$where." AND gender=$gender";
}  
    if ( isset( $_REQUEST[ 'age' ] ) ) {
    $age = $_REQUEST[ 'age' ];
 if($age!='age')
    { $age = "'" . $_REQUEST[ 'age' ] . "'";}

        $where=$where." AND age=$age";
}   if ( isset( $_REQUEST[ 'committed_amount' ] ) ) {
    $committed_amount = $_REQUEST[ 'committed_amount' ];
 if($committed_amount!='committed_amount')
    { $committed_amount = "'" . $_REQUEST[ 'committed_amount' ] . "'";}

        $where=$where." AND committed_amount=$committed_amount";
} 
    
     if ( isset( $_REQUEST[ 'seller' ] ) ) {
           $seller = $_REQUEST[ 'seller' ];
 if($seller!="")
    { $seller = "'" . $_REQUEST[ 'seller' ] . "'";}
         else
         {
             $seller='allocated_to';
         }

     //   $where=$where." AND allocated_to=$seller";
}
if ( isset( $_REQUEST[ 'disease' ] ) ) {
  $disease = $_REQUEST[ 'disease' ];
  if ( $disease != 'disease' ) {
  if ( $disease == 'IS NULL' ) 
  {
      
    $where = $where . " AND id NOT IN (SELECT inquiry_id FROM `inquiry_disease`)";
  }
      else
      {
          
    $disease = "'" . $_REQUEST[ 'disease' ] . "'";
    $where = $where . " AND id IN (SELECT inquiry_id FROM `inquiry_disease` WHERE disease=$disease)";
      }
  } else {

  }
}
    
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

  }
}
    
  $sqlview = "SELECT *,(SELECT user FROM `feedback_user_orders_allocation` WHERE inquiry_id=id) as 'feedback_consultant' FROM `inquiry` $where  $limit; ";
  
  
//    echo $sqlview;
?>
</div>
<div class="content-wrapper" >
  <div class="container-fluid">
    <?php breadcrumb(); ?>
       <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th class="bg-light" colspan="7"> <center>
                  <strong>Users Feedback & Allocations </strong>
                </center>
              </th>
            </tr>
            <tr>
              <th>Username</th>
              <th>Allocations</th>
              <th>Completed Till Date</th>
              <th>Remaining Till Date</th>
              <th>Feedback Today</th>
            </tr>
          </thead>
          <tbody>
            <?php
if(check_admin($_SESSION['email']))
{
    $sqlview_progress = "SELECT user,count(inquiry_id),(SELECT count(*) FROM `inquiry_status_history` WHERE entered_by=feedback_user_orders_allocation.user AND type='Feedback') AS 'done',(SELECT count(*) FROM `inquiry_status_history` WHERE entered_by=feedback_user_orders_allocation.user AND type='Feedback' AND date(time)='$date') AS 'today' FROM `feedback_user_orders_allocation` GROUP BY USER;";
}              else
              {
                     $sqlview_progress = "SELECT user,count(inquiry_id),(SELECT count(*) FROM `inquiry_status_history` WHERE entered_by=feedback_user_orders_allocation.user AND type='Feedback') AS 'done',(SELECT count(*) FROM `inquiry_status_history` WHERE entered_by=feedback_user_orders_allocation.user AND type='Feedback' AND date(time)='$date') AS 'today' FROM `feedback_user_orders_allocation` Where user='$_SESSION[email]';";
              }
            
            $queryview_progress = mysqli_query( $con, $sqlview_progress );
            while ( $rowview_progress = mysqli_fetch_array( $queryview_progress ) ) {
              ?>
            <tr class="<?php echo $rowview_progress[0] === $_SESSION['email'] ? "bg-success" : "bg-danger";
 ?> text-white">
              <td><?php echo $rowview_progress[0];    ?></td>
              <td><?php echo $rowview_progress[1];    ?><a class="btn btn-sm btn-primary float-end" href="<?php echo "customer_relationship.php?start_date=2000-01-01&end_date=$date&delivery_status=&courier_company=&order_type=&order_patient_id=&limit=null&seller=$rowview_progress[0]"; ?>" target="new">View</a></td>
                 <td><?php echo $rowview_progress[2];    ?><a class="btn btn-sm btn-primary float-end" href="<?php echo "view_feedback_report.php?user=$rowview_progress[0]&start_date=2000-01-01&end_date=$date"; ?>" target="new">View</a></td>
              <td><?php echo $rowview_progress[1]-$rowview_progress[2];    ?></td>
             
              <td><?php echo $rowview_progress[3];    ?><a class="btn btn-sm btn-primary float-end" href="<?php echo "view_feedback_report.php?user=$rowview_progress[0]&start_date=$date&end_date=$date"; ?>" target="new">View</a></td>
                
            </tr>
              <?php } ?>     
          </tbody>
        </table>
      </div>
      <?php
      include( "view_inquiry_all_tabs.php" );
      include( "fix_header.php" );
      echo "Showing ".$limit." of ".showQuery("SELECT count(*) FROM `inquiry` $where");
//      echo $sqlview;
      include( "inquiry_table.php" );
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
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({pageLength: 5000});  
 });  
 </script>
</body>
</html>