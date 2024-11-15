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
<?php include("preloader.php"); 
include "start.php";

    $login_user = $_SESSION[ 'email' ];
    

$where=" ";
if(check_admin($login_user))
{
   
$where="WHERE 1";
}
else
{
   
$where="WHERE allocated_to='$login_user'";
}
    
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

        $where=$where." AND allocated_to=$seller";
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
?>
</div>
<div class="content-wrapper" >
  <div class="container-fluid">
    <?php 
        
      breadcrumb(); 
 
      ?>
      <?php
    include( "view_inquiry_all_tabs.php" );
           include( "view_tasks_tabs.php" );
      include( "fix_header.php" );
     
    if(isset($_REQUEST['sql']))
    {
      $sqlview=$_REQUEST['sql'];
        $records_count=countQuery($sqlview);
      echo "Showing ".$records_count." of ".$records_count;   
    }
    else
    {
         $sqlview = "SELECT *,(SELECT user FROM `feedback_user_orders_allocation` WHERE inquiry_id=id) as 'feedback_consultant' FROM `inquiry` $where $limit; ";
        
      echo "Showing ".$limit." of ".showQuery("SELECT count(*) FROM `inquiry` $where");   
    }
 
  
    
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