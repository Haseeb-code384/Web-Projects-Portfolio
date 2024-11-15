<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];

if(isset($_REQUEST['submit']))
{
	$order_id = $_REQUEST['order_id'];
	$status = $_REQUEST['status'];
$seller = $_REQUEST['seller'];
$order_patient_id = $_REQUEST['order_patient_id'];
$order_date = $_REQUEST['order_date'];
$source_address = ucwords( $_REQUEST['source_address']);
$dispatcher_name = ucwords( $_REQUEST['dispatcher_name']);
$dispatcher_contact = $_REQUEST['dispatcher_contact'];
$receiver_name = ucwords( $_REQUEST['receiver_name']);
$destination_address = ucwords( $_REQUEST['destination_address']);
$destination_contact = $_REQUEST['destination_contact'];
$courier_company = $_REQUEST['courier_company'];
$tracking_id = $_REQUEST['tracking_id'];
$payment_method = $_REQUEST['payment_method'];
$advance_paid = $_REQUEST['advance_paid'];
$advance_comments = ucwords( $_REQUEST['advance_comments']);
$order_amount = $_REQUEST['order_amount'];
$courier_cost = $_REQUEST['courier_cost'];
$package_weight = $_REQUEST['package_weight'];
$dispatch_remarks = ucwords( $_REQUEST['dispatch_remarks']);
$dispatch_time =  $_REQUEST['dispatch_time'];
$delivered_time = $_REQUEST['delivered_time'];
$received_by = ucwords( $_REQUEST['received_by']);
$delivery_notes = ucwords($_REQUEST['delivery_notes']);
$comments = ucwords($_REQUEST['comments']);
$customer_feedback = ucwords( $_REQUEST['customer_feedback']);
$fraud_flag = $_REQUEST['fraud_flag'];
$fraud_investigation_notes = ucwords($_REQUEST['fraud_investigation_notes']);
 $already = showQuery( "SELECT order_id FROM `order_dispatch_info` WHERE order_patient_id='$order_patient_id' AND order_date='$order_date' HAVIN COUNT(order_id)>1" );
  if ( $already == "" ) {
      if(!exists_in_db("SELECT * FROM `order_dispatch_info` WHERE tracking_id='$tracking_id' AND tracking_id!='' AND order_id!='$order_id' "))
      {
	$sql="UPDATE `order_dispatch_info` SET `status`='$status',`seller`='$seller',`order_patient_id`='$order_patient_id',`order_date`='$order_date',`source_address`='$source_address',`dispatcher_name`='$dispatcher_name',`dispatcher_contact`='$dispatcher_contact',`receiver_name`='$receiver_name',`destination_address`='$destination_address',`destination_contact`='$destination_contact',`courier_company`='$courier_company',`payment_method`='$payment_method',`advance_paid`='$advance_paid',`advance_comments`='$comments',`order_amount`='$order_amount',`courier_cost`='$courier_cost',`package_weight`='$package_weight',`tracking_id`='$tracking_id',`dispatch_remarks`='$dispatch_remarks',`dispatch_time`='$dispatch_time',`delivered_time`='$delivered_time',`received_by`='$received_by',`delivery_notes`='$delivery_notes',`comments`='$comments',`customer_feedback`='$customer_feedback',`fraud_flag`='$fraud_flag',`fraud_investigation_notes`='$fraud_investigation_notes' WHERE `order_id`='$order_id'";
	$query=mysqli_query($con,$sql) or die(mysqli_error($con));
    $lastid=mysqli_insert_id($con);
    
    
	if($query)
	{
		alertredirect("Order $order_id Successfully Updated","view_orders.php");
	}
	else
	{
		
		echo "<script>alert('Something Went Wrong!!!')</script>";
	}
	 } else {
    alertredirect( "Error!!! Tracking ID $tracking_id Already Exists", "update_order_form.php?id=$order_id" );
  } } else {
    alertredirect( "Duplicate Order# $already Already Exists", "update_order_form.php?id=$order_id" );
  }
}

?>