<?php session_start();
include("config.php");
include("allFunctions.php");

$payment_receiving_id=$_REQUEST['id'];
$order_id=$_REQUEST['order_id'];
$order_amount=$_REQUEST['order_amount'];
$courier_cost=$_REQUEST['courier_cost'];
$package_weight=$_REQUEST['package_weight'];
$status=$_REQUEST['status'];
$d_status=$_REQUEST['d_status'];

$customer_feedback = $_REQUEST[ 'customer_feedback' ];
$total_number=count($package_weight);
echo $total_number;
$payment_inv_no=$_REQUEST['payment_inv_no'];

$cheque_amount=$_REQUEST['cheque_amount'];
$cheque_number=$_REQUEST['cheque_number'];
$cheque_date=$_REQUEST['cheque_date'];
$courier_company=$_REQUEST['courier_company'];

$fuel_adjustment=$_REQUEST['fuel_adjustment'];
$fuel_surcharge=$_REQUEST['fuel_surcharge'];
$fuel_factor=$_REQUEST['fuel_factor'];
$gst_amount=$_REQUEST['gst_amount'];
$hnd_oth_charges=$_REQUEST['hnd_oth_charges'];
$price_adjustment=$_REQUEST['price_adjustment'];
$cmi_charges=$_REQUEST['cmi_charges'];
$insurance_charges=$_REQUEST['insurance_charges'];
$discount=$_REQUEST['discount'];
$other_charges=$_REQUEST['other_charges'];

executeQuery("UPDATE `order_courier_bill_receivings` SET `payment_inv_no`='$payment_inv_no',`cheque_number`='$cheque_number',`cheque_amount`='$cheque_amount',`cheque_date`='$cheque_date',`courier_company`='$courier_company',`fuel_adjustment`='$fuel_adjustment',`fuel_surcharge`='$fuel_surcharge',`fuel_factor`='$fuel_factor',`gst_amount`='$gst_amount',`hnd_oth_charges`='$hnd_oth_charges',`price_adjustment`='$price_adjustment',`cmi_charges`='$cmi_charges',`insurance_charges`='$insurance_charges',`discount`='$discount',`other_charges`='$other_charges' WHERE `id`='$payment_receiving_id' ");

$fuel_adjustment=$fuel_adjustment/$total_number;
$fuel_surcharge=$fuel_surcharge/$total_number;
$fuel_factor=$fuel_factor/$total_number;
$gst_amount=$gst_amount/$total_number;
$hnd_oth_charges=$hnd_oth_charges/$total_number;
$price_adjustment=$price_adjustment/$total_number;
$cmi_charges=$cmi_charges/$total_number;
$insurance_charges=$insurance_charges/$total_number;
$discount=$discount/$total_number;
$other_charges=$other_charges/$total_number;
for($i=0;$i<$total_number;$i++)
{
    executeQuery("UPDATE `order_dispatch_info` SET order_amount='$order_amount[$i]', courier_cost='$courier_cost[$i]', package_weight='$package_weight[$i]', payment_status='$status[$i]',customer_feedback='$customer_feedback[$i]',status='$d_status[$i]',fuel_adjustment='$fuel_adjustment',fuel_surcharge='$fuel_surcharge',fuel_factor='$fuel_factor',gst_amount='$gst_amount',hnd_oth_charges='$hnd_oth_charges',price_adjustment='$price_adjustment',cmi_charges='$cmi_charges',insurance_charges='$insurance_charges',discount='$discount',other_charges='$other_charges',payment_receiving_id='$payment_receiving_id' WHERE order_id='$order_id[$i]'");
    $total_service_charges=get_order_total_courier_charges($order_id[$i]);
    executeQuery("UPDATE `order_dispatch_info` SET total_service_charges='$total_service_charges' WHERE order_id='$order_id[$i]'");
    $inquiy_id=showQuery("SELECT order_patient_id FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'");
    
    $seller=showQuery("SELECT seller FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'");
    
    executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$d_status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', 'Edit Payment Received Bill# $payment_receiving_id', NULL, NULL, NULL, NULL, NULL, NULL)");
    
    executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', 'Edit Payment Received Bill# $payment_receiving_id', NULL, NULL, NULL, NULL, NULL, NULL)"); 
    
    
    executeQuery("DELETE FROM `order_payment_cart` WHERE order_id='$order_id[$i]'");
}
alertredirect("Receiving Id $payment_receiving_id Updated Successfully","receiver_courier_payment_list.php");
?>