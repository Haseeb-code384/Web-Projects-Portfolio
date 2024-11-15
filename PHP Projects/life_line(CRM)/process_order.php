<?php
session_start();
include( 'config.php' );
include( 'allFunctions.php' );
$login_user = $_SESSION[ 'email' ];

if ( isset( $_REQUEST[ 'submit' ] ) ) {
  //	$order_id = $_REQUEST['order_id'];
  $status = $_REQUEST[ 'status' ];
  $seller = $_REQUEST[ 'seller' ];
  $order_patient_id = $_REQUEST[ 'order_patient_id' ];
  $order_date = $_REQUEST[ 'order_date' ];
  $source_address = ucwords( $_REQUEST[ 'source_address' ] );
  $dispatcher_name = ucwords( $_REQUEST[ 'dispatcher_name' ] );
  $dispatcher_contact = $_REQUEST[ 'dispatcher_contact' ];
  $receiver_name = ucwords( $_REQUEST[ 'receiver_name' ] );
  $destination_address = ucwords( $_REQUEST[ 'destination_address' ] );
  $destination_contact = $_REQUEST[ 'destination_contact' ];
  $courier_company = $_REQUEST[ 'courier_company' ];
  $tracking_id = $_REQUEST[ 'tracking_id' ];
  $payment_method = $_REQUEST[ 'payment_method' ];
  $advance_paid = $_REQUEST[ 'advance_paid' ];
  $advance_comments = ucwords( $_REQUEST[ 'advance_comments' ] );
  $order_amount = $_REQUEST[ 'order_amount' ];
  $courier_cost = $_REQUEST[ 'courier_cost' ];
  $package_weight = $_REQUEST[ 'package_weight' ];
  $dispatch_remarks = ucwords( $_REQUEST[ 'dispatch_remarks' ] );
  $dispatch_time = $_REQUEST[ 'dispatch_time' ];
  $delivered_time = $_REQUEST[ 'delivered_time' ];
  $received_by = ucwords( $_REQUEST[ 'received_by' ] );
  $delivery_notes = ucwords( $_REQUEST[ 'delivery_notes' ] );
  $comments = ucwords( $_REQUEST[ 'comments' ] );
  $customer_feedback = ucwords( $_REQUEST[ 'customer_feedback' ] );
  $fraud_flag = $_REQUEST[ 'fraud_flag' ];
  $fraud_investigation_notes = ucwords( $_REQUEST[ 'fraud_investigation_notes' ] );
  $already = showQuery( "SELECT order_id FROM `order_dispatch_info` WHERE order_patient_id='$order_patient_id' AND order_date='$order_date'" );
  if ( $already == "" ) {

    $sql = "INSERT INTO `order_dispatch_info` (`order_id`, `status`, `seller`, `order_patient_id`, `order_date`, `source_address`, `dispatcher_name`, `dispatcher_contact`, `receiver_name`, `destination_address`, `destination_contact`, `courier_company`, `payment_method`, `advance_paid`, `advance_comments`, `order_amount`, `courier_cost`, `package_weight`, `tracking_id`, `dispatch_remarks`, `dispatch_time`, `delivered_time`, `received_by`, `delivery_notes`, `entered_at`, `updated_at`, `comments`, `customer_feedback`, `fraud_flag`, `fraud_investigation_notes`) VALUES (NULL, '$status', '$seller', '$order_patient_id', '$order_date', '$source_address', '$dispatcher_name', '$dispatcher_contact', '$receiver_name', '$destination_address', '$destination_contact', '$courier_company', '$payment_method', '$advance_paid', '$advance_comments', '$order_amount', '$courier_cost', '$package_weight', '$tracking_id', '$dispatch_remarks', '$dispatch_time', '$delivered_time', '$received_by', '$delivery_notes', '$currentDateTime', '$currentDateTime', '$comments', '$customer_feedback', '$fraud_flag', '$fraud_investigation_notes');";
    $query = mysqli_query( $con, $sql )or die( mysqli_error( $con ) );
    $lastid = mysqli_insert_id( $con );

    if ( $query ) {
      alertredirect( "Order $lastid Successfully Generated", "index.php" );
    } else {

      echo "<script>alert('Something Went Wrong!!!')</script>";
    }

  } else {
    alertredirect( "Duplicate Order# $already Already Exists", "add_order_form.php?p_id=$order_patient_id" );
  }

}

?>