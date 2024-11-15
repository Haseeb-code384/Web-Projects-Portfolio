or<?php
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
  <form method="post" action="process_order.php">
    <div class="border col-lg-12"> <span style="color: red;">Note:</span> All RED Fields Are Must
      <div class="row">
        <div class="col-sm-6">
          <label class=""><strong>STATUS:</strong></label>
    <select name="status" class="form-select" required>
            <?php populateDDsel("order_status where order_status='Under Process'  order by sort","order_status","order_status","Under Process"); ?>
    
    </select>
        </div>
<div class="col-sm-6">
          <label class=""><strong>SELLER:</strong></label>
    <select name="seller" class="form-select" required>
            <?php populateDDsel("user","concat(email,' | ',name)","email",showQuery("SELECT allocated_to FROM `inquiry` WHERE id='$_REQUEST[p_id]'")); ?>
    
    </select>
        </div>
<div class="col-sm-6">
          <label class=""><strong>ORDER INQUIRY ID:</strong></label>
       <input type="number" readonly value="<?php echo $_REQUEST['p_id']; ?>" name="order_patient_id" class="form-control" placeholder="Enter order patient ID">
        </div>
<div class="col-sm-6">
          <label class=""><strong>ORDER DATE:</strong></label>
       <input type="date" name="order_date" class="form-control" placeholder="Enter order date" value="<?php echo $date; ?>">
        </div>
<div class="col-sm-6">
          <label class=""><strong>SOURCE ADDRESS:</strong></label>
     <textarea name="source_address" class="form-control" placeholder="Enter source address"></textarea>
        </div>
<div class="col-sm-6">
          <label class=""><strong>DISPATCHER NAME:</strong></label>
       <input type="text" name="dispatcher_name" class="form-control" placeholder="Enter dispatcher's name" maxlength="50">
        </div>
<div class="col-sm-6">
          <label class=""><strong>DISPATCHER CONTACT:</strong></label>
       <input type="text" name="dispatcher_contact" class="form-control" placeholder="Enter dispatcher's contact number" maxlength="15">
        </div>
<div class="col-sm-6">
          <label class=""><strong>RECEIVER NAME:</strong></label>
       <input type="text" name="receiver_name" value="<?php echo showQuery("SELECT name FROM `inquiry` WHERE id='$_REQUEST[p_id]'"); ?>" class="form-control" placeholder="Enter receiver's name" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>DESTINATION ADDRESS:</strong></label>
       <textarea  name="destination_address"  class="form-control" placeholder="Enter destination address"><?php echo showQuery("SELECT address1 FROM `inquiry` WHERE id='$_REQUEST[p_id]'"); ?></textarea>
        </div>
<div class="col-sm-6">
          <label class=""><strong>DESTINATION CONTACT:</strong></label>
       <input type="text" name="destination_contact" value="<?php echo showQuery("SELECT phone1 FROM `inquiry` WHERE id='$_REQUEST[p_id]'"); ?>" class="form-control" placeholder="Enter destination contact number" maxlength="15">
        </div>
<div class="col-sm-6">
          <label class=""><strong>COURIER COMPANY:</strong></label>
      <select name="courier_company" class="form-select" >
            <?php populateDDsel("courier_company","company_account_name","company_account_name",""); ?>
    </select>
        </div>
<div class="col-sm-6">
          <label class=""><strong>ORDER TYPE:</strong></label>
    <select name="payment_method" class="form-select">
    
              <?php populateDDsel("order_type","order_type","order_type","") ?>
    </select>
        </div>
<div class="col-sm-6">
          <label class=""><strong>ADVANCE PAID:</strong></label>
       <input type="number" name="advance_paid" class="form-control" placeholder="Enter Advance PAID(IF ANY)" step="0.01">
        </div>
<div class="col-sm-6">
          <label class=""><strong>ADVANCE COMMENTS:</strong></label>
       <textarea name="advance_comments" class="form-control" placeholder="Enter Advance Comments"></textarea>
          </div>
<div class="col-sm-6">
          <label class=""><strong>ORDER AMOUNT:</strong></label>
       <input type="number" name="order_amount" class="form-control" placeholder="Enter order amount" step="0.01">
        </div>
<div class="col-sm-6">
          <label class=""><strong>COURIER COST:</strong></label>
       <input type="number" name="courier_cost" class="form-control" placeholder="Enter courier cost" step="0.01">
        </div>
          <div class="col-sm-6">
          <label class=""><strong>PACKAGE WEIGHT:</strong></label>
       <input type="number" name="package_weight" class="form-control" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>TRACKING ID:</strong></label>
       <input type="text" name="tracking_id" pattern="[^\s]+" title="No Spaces Allowed In Tracking ID" class="form-control" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>DISPATCH REMARKS:</strong></label>
    
    <textarea type="text" name="dispatch_remarks" class="form-control" placeholder="dispatch_remarks"></textarea>
        </div>
<div class="col-sm-6">
          <label class=""><strong>DISPATCH TIME:</strong></label>
       <input type="datetime-local" name="dispatch_time" class="form-control" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>DELIVERED TIME:</strong></label>
       <input type="datetime-local" name="delivered_time" class="form-control" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>RECEIVED BY:</strong></label>
       <input type="text" name="received_by" class="form-control" placeholder="RECEIVED BY" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>DELIVERY NOTES:</strong></label>
    
    <textarea name="delivery_notes" class="form-control" placeholder="DELIVERY_NOTES"></textarea>
        </div>
<div class="col-sm-6">
          <label class=""><strong>COMMENTS:</strong></label>
       
    <textarea type="text" name="comments" class="form-control" placeholder="Comments"></textarea>
        </div>
<div class="col-sm-6">
          <label class=""><strong>CONSULTENCY FEE:</strong></label>
    
    <input type="number" name="customer_feedback" class="form-control" placeholder="CONSULTENCY FEE">
        </div>
<div class="col-sm-6">
          <label class=""><strong>FRAUD FLAG:</strong></label>
       <input type="checkbox" name="fraud_flag" value="Yes" class="form-check" >
        </div>
<div class="col-sm-6">
          <label class=""><strong>FRAUD INVESTIGATION NOTES:</strong></label>
    
    <textarea type="text" name="fraud_investigation_notes" class="form-control" placeholder="FRAUD_INVESTIGATION_NOTES"></textarea>
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
</body>
</html>