<?php
include( "config.php" );
include( "allFunctions.php" );
$id = $_REQUEST[ 'id' ];
$sql_view = "SELECT * FROM `order_dispatch_info` WHERE order_id='$id'";
$query_view = mysqli_query( $con, $sql_view );
$row_view = mysqli_fetch_array( $query_view );
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
    <?php breadcrumb(); ?>
    <div class="row" style="">
    <form method="post" action="process_update_order.php">
      <input type="hidden" name="order_id" value="<?php echo $id; ?>">
      <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
        <div class="row">
          <div class="col-sm-6">
            <label class=""><strong>STATUS:</strong></label>
            <input type="text" readonly name="status" class="form-control" value="<?php echo $row_view['status']; ?>" required>
            <?php //populateDDsel("order_status  order by sort","order_status","order_status",""); ?>
            </select>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>SELLER:</strong></label>
            <select name="seller" class="form-select" required>
              <?php populateDDsel("user","concat(email,' | ',name)","email",$row_view['seller']); ?>
            </select>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>ORDER INQUIRY ID:</strong></label>
            <input type="number"  value="<?php echo $row_view['order_patient_id']; ?>" name="order_patient_id" class="form-control" placeholder="Enter order patient ID">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>ORDER DATE:</strong></label>
            <input type="date" name="order_date" class="form-control" placeholder="Enter order date"  value="<?php echo $row_view['order_date']; ?>">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>SOURCE ADDRESS:</strong></label>
            <textarea name="source_address" class="form-control" placeholder="Enter source address"><?php echo $row_view['source_address']; ?></textarea>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DISPATCHER NAME:</strong></label>
            <input type="text" name="dispatcher_name" class="form-control"  value="<?php echo $row_view['dispatcher_name']; ?>" placeholder="Enter dispatcher's name" maxlength="50">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DISPATCHER CONTACT:</strong></label>
            <input type="text" name="dispatcher_contact" class="form-control"  value="<?php echo $row_view['dispatcher_contact']; ?>" placeholder="Enter dispatcher's contact number" maxlength="15">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>RECEIVER NAME:</strong></label>
            <input type="text" name="receiver_name"  value="<?php echo $row_view['receiver_name']; ?>" class="form-control" placeholder="Enter receiver's name" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DESTINATION ADDRESS:</strong></label>
            <textarea  name="destination_address"  class="form-control" placeholder="Enter destination address"><?php echo $row_view['destination_address']; ?></textarea>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DESTINATION CONTACT:</strong></label>
            <input type="text" name="destination_contact"  value="<?php echo $row_view['destination_contact']; ?>" class="form-control" placeholder="Enter destination contact number" maxlength="15">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>COURIER COMPANY:</strong></label>
            <select name="courier_company" class="form-select" >
              <?php populateDDsel("courier_company","company_account_name","company_account_name",$row_view['courier_company']) ?>
            </select>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>ORDER TYPE:</strong></label>
            <select name="payment_method" class="form-select">
              <?php populateDDsel("`order_type` ORDER BY `order_type`.`sort` ASC","order_type","order_type",$row_view['payment_method']) ?>
            </select>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>ADVANCE PAID:</strong></label>
            <input type="number" name="advance_paid" class="form-control"  value="<?php echo $row_view['advance_paid']; ?>" placeholder="Enter Advance PAID(IF ANY)" step="0.01">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>ADVANCE COMMENTS:</strong></label>
            <textarea name="advance_comments" class="form-control" placeholder="Enter Advance Comments"><?php echo $row_view['advance_comments']; ?></textarea>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>ORDER AMOUNT:</strong></label>
            <input type="number" name="order_amount" class="form-control"  value="<?php echo $row_view['order_amount']; ?>" placeholder="Enter order amount" step="0.01">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>COURIER COST:</strong></label>
            <input type="number" name="courier_cost" class="form-control"  value="<?php echo $row_view['courier_cost']; ?>" placeholder="Enter courier cost" step="0.01">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>PACKAGE WEIGHT:</strong></label>
            <input type="number" name="package_weight"  value="<?php echo $row_view['package_weight']; ?>" class="form-control" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>TRACKING ID:</strong></label>
            <input type="text" name="tracking_id" title="No Spaces Allowed In Tracking ID" pattern="[^\s]+"  value="<?php echo $row_view['tracking_id']; ?>" class="form-control" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DISPATCH REMARKS:</strong></label>
            <textarea type="text" name="dispatch_remarks"  class="form-control" placeholder="dispatch_remarks"><?php echo $row_view['dispatch_remarks']; ?></textarea>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DISPATCH TIME:</strong></label>
            <input type="datetime-local" name="dispatch_time"  value="<?php echo $row_view['dispatch_time']; ?>" class="form-control" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DELIVERED TIME:</strong></label>
            <input type="datetime-local" name="delivered_time"  value="<?php echo $row_view['delivered_time']; ?>" class="form-control" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>RECEIVED BY:</strong></label>
            <input type="text" name="received_by" class="form-control"  value="<?php echo $row_view['received_by']; ?>" placeholder="RECEIVED BY" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>DELIVERY NOTES:</strong></label>
            <textarea name="delivery_notes" class="form-control" placeholder="DELIVERY_NOTES"><?php echo $row_view['delivery_notes']; ?></textarea>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>COMMENTS:</strong></label>
            <textarea type="text" name="comments" class="form-control" placeholder="Comments"><?php echo $row_view['comments']; ?></textarea>
          </div>
          <div class="col-sm-6">
            <label class=""><strong>CONSULTENCY FEE:</strong></label>
            <input type="number" name="customer_feedback" class="form-control" <?php echo $row_view['customer_feedback']; ?> placeholder="CONSULTENCY FEE">
          </div>
          <div class="col-sm-6">
            <label class=""><strong>FRAUD FLAG:</strong></label>
            <input type="checkbox" name="fraud_flag" value="Yes" class="form-check" >
          </div>
          <div class="col-sm-6">
            <label class=""><strong>FRAUD INVESTIGATION NOTES:</strong></label>
            <textarea type="text" name="fraud_investigation_notes" class="form-control" placeholder="FRAUD_INVESTIGATION_NOTES"><?php echo $row_view['fraud_investigation_notes']; ?></textarea>
          </div>
          <br>
          <br>
          <br>
          <input type="submit" name="submit" class="btn-sm btn-primary">
          <input type="reset" class="btn-sm btn-secondary" value="Clear All">
        </div>
      </div>
      </div>
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
		$( document ).ready( function () {
			$( '#employee_data' ).DataTable();
		} );
	</script>
</body></html>