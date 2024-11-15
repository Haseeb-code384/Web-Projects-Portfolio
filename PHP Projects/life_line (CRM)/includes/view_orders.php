<?php
include( "config.php" );
include( "allFunctions.php" );

include( "limit_record.php" );

include "start.php";
$start_date = $date;
$end_date = $date;
$order_patient_sql = "";
$courier_company_sql="";
$payment_method_sql="";
$delivery_sql="";

if ( isset( $_REQUEST[ 'order_patient_id' ] ) ) {
  if ( $_REQUEST[ 'order_patient_id' ] != "" ) {
    $order_patient_sql = "AND order_patient_id='$_REQUEST[order_patient_id]'";
  }
}
if ( isset( $_REQUEST[ 'courier_company' ] ) ) {
  if ( $_REQUEST[ 'courier_company' ] != "" ) {
    $courier_company_sql = "AND courier_company='$_REQUEST[courier_company]'";
  }
}if ( isset( $_REQUEST[ 'payment_method' ] ) ) {
  if ( $_REQUEST[ 'payment_method' ] != "" ) {
    $payment_method_sql = "AND payment_method='$_REQUEST[payment_method]'";
  }
}
$login_user = $_SESSION[ 'email' ];
if ( check_admin( $login_user ) ) {
  $seller_sql = "";
} else {

  $seller_sql = "AND seller='$login_user'";
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $start_date = $_REQUEST[ 'start_date' ];
}
if ( isset( $_REQUEST[ 'start_date' ] ) ) {
  $end_date = $_REQUEST[ 'end_date' ];
}
if ( isset( $_REQUEST[ 'seller' ] ) ) {
  if ( $_REQUEST[ 'seller' ] != "" ) {
    $seller = $_REQUEST[ 'seller' ];
    $seller_sql = " AND seller='$seller'";
  }
}
if ( isset( $_REQUEST[ 'delivery_status' ] ) ) {
 if($_REQUEST['delivery_status']!="")
{
$delivery_status = $_REQUEST['delivery_status'];
    if(exists_in_db("SELECT * FROM `order_status` WHERE parent IN('$delivery_status')"))
    {
$delivery_sql="AND status IN (SELECT order_status FROM `order_status` WHERE parent IN('$delivery_status'))";   
        
    }
    else
    {
        
$delivery_sql="AND status='$delivery_status'";   
    } 
}
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
<?php include("preloader.php"); ?>
<?php
$sqlview = "SELECT *,(SELECT color FROM `order_status` WHERE order_status=order_dispatch_info.status) AS 'color' FROM `order_dispatch_info` WHERE order_date BETWEEN '$start_date' AND '$end_date' $seller_sql $order_patient_sql $courier_company_sql $delivery_sql $payment_method_sql $limit; ";

//echo $sqlview;
?>
</div>
<div class="content-wrapper" >
  <div class="container-fluid">
    <?php breadcrumb(); ?>
    <form method="get">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-2">
            <label>Start Date</label>
            <input type="date" class="form-control" name="start_date" value="<?php echo $start_date ?>">
          </div>
          <div class="col-sm-2">
            <label>End Date</label>
            <input type="date" class="form-control" name="end_date"  value="<?php echo $end_date ?>">
          </div>
          <div class="col-sm-2">
            <label>Delivery Status</label>
            <select   class="form-control" name="delivery_status">
              <?php  order_status_dd($_REQUEST['delivery_status'],true); ?>
            </select>
          </div> 
            <div class="col-sm-2">
            <label>Courier Company</label>
            <select   class="form-control" name="courier_company">
              <?php  populateDDsel("courier_company","company_account_name","company_account_name",$_REQUEST['courier_company']) ?>
            </select>
          </div>  
            <div class="col-sm-2">
            <label>Order Type</label>
            <select   class="form-control" name="order_type">
              <?php  populateDDsel("`order_type` ORDER BY `sort` ASC","order_type","order_type",$_REQUEST['order_type']) ?>
            </select>
          </div>
          <div class="col-sm-2">
            <label>Order Inquiry Id</label>
            <input type="text" name="order_patient_id" class="form-control" value="<?php if(isset($_REQUEST['order_patient_id'])) { echo $_REQUEST['order_patient_id']; } ?>">
          </div>  <div class="col-sm-1">
            <label>Limit</label>
            <input type="text" name="limit" class="form-control" value="<?php if(isset($_REQUEST['limit'])) { echo $_REQUEST['limit']; } ?>">
          </div>
          <div class="col-sm-2">
            <?php
            include( "admin_selective_user_dropdown.php" );
            ?>
          </div>
          <div class="col-sm-1"> <br>
            <input type="submit" class="btn btn-sm btn-primary">
          </div>
        </div>
      </div>
    </form>
      
    <?php
        echo "Showing ".$limit." of ".showQuery("SELECT count(*) FROM `order_dispatch_info` WHERE order_date BETWEEN '$start_date' AND '$end_date' $seller_sql $order_patient_sql $courier_company_sql $delivery_sql $payment_method_sql ; ");
    include( "fix_header.php" );
    ?>
          <tr>
            <th style="width: 100px;">Actions</th>
            <th>ID</th>
            <th>Status</th>
            <th>Seller</th>
            <th>Order Inquiry Id</th>
            <th>Order Date</th>
            <th>Total Orders</th>
            <th>Order Type</th>
            <th>Receiver Name</th>
            <th>Destination Contact</th>
            <th>Tracking ID</th>
            <th>Entered At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // echo $sqlview;
          $queryview = mysqli_query( $con, $sqlview );
          while ( $rowview = mysqli_fetch_array( $queryview ) ) {
            ?>
          <tr  onClick="chnage_row_clr(this,'lightgreen');" onDblClick="chnage_row_wclr(this,'white');"  style="background-color: <?php echo showQuery("SELECT color FROM `status_list` WHERE status_name='$rowview[call_status]'") ?>;" >
            <td><input type="checkbox">
              <i title="More"  onClick="window.open('order_details.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i> <i title="Status History" onClick="window.open('order_status_history.php?id=<?php echo $rowview[0]; ?>','height=200','width=200');" class="fa fa-history text-primary"></i> <a target="new" href="update_order_status.php?id=<?php echo $rowview[0]; ?>" title="Set Order Status"><i class="fa fa-reorder text-warning"></i></a> <a target="new" href="update_order_checklist.php?id=<?php echo $rowview[0]; ?>" title="Check List"><i class="fa fa-check-square-o text-info"></i></a> <a target="new" href="update_order_form.php?id=<?php echo $rowview[0]; ?>" title="Update"><i class="fa fa-edit text-success"></i></a> 
              <!--
              <i title="Double Click To Delete" onDblClick="window.location.href='del.php?del_inquiry=<?php echo $rowview[0]; ?>'" class="fa fa-trash text-danger"></i>
            
--></td>
            <td><?php echo $rowview[0]; ?></td>
            <td title="<?php echo $rowview[1] ?>"><span class="badge" style="color:black; background-color: <?php echo $rowview['color'] ?>;"><?php echo $rowview[1]; ?></span></td>
            <td title="<?php echo $rowview[2] ?>"><?php echo $rowview[2]; ?></td>
            <td title="<?php echo $rowview[3] ?>"><?php echo $rowview[3]; ?> <i title="More"  onClick="window.open('inquiry_details.php?id=<?php echo $rowview[3]; ?>','height=200','width=200');" class="fa fa-info-circle text-info"></i></td>
            <td title="<?php echo $rowview[4] ?>"><?php echo change_date_ddmmyyy($rowview[4]); ?></td>
            <td><?php no_of_orders_inquiry($rowview[3]) ?></td>
            <td title="<?php echo $rowview['payment_method'] ?>"><?php echo $rowview['payment_method']; ?></td>
            <td title="<?php echo $rowview['receiver_name'] ?>"><?php echo $rowview['receiver_name']; ?></td>
            <td title="<?php echo $rowview['destination_contact'] ?>"><?php echo $rowview['destination_contact']; ?></td>
            <td title="<?php echo $rowview['tracking_id'] ?>"><?php echo $rowview['tracking_id']; ?></td>
            <td title="<?php echo change_datetime_ddmmyyyhis($rowview['entered_at']) ?>"><?php echo substr( change_datetime_ddmmyyyhis( $rowview['entered_at']),0,10); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
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