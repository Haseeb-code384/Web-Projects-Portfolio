<?php
session_start();
include( "config.php" );
include( "allFunctions.php" );

$order_id = $_REQUEST[ 'order_id' ];
$order_amount = $_REQUEST[ 'order_amount' ];
$courier_cost = $_REQUEST[ 'courier_cost' ];
$package_weight = $_REQUEST[ 'package_weight' ];
$status = $_REQUEST[ 'status' ];
$customer_feedback = $_REQUEST[ 'customer_feedback' ];
$d_status = $_REQUEST[ 'd_status' ];
$total_number = count( $package_weight );
echo $total_number;
$payment_inv_no = $_REQUEST[ 'payment_inv_no' ];

$cheque_amount = $_REQUEST[ 'cheque_amount' ];
$cheque_number = $_REQUEST[ 'cheque_number' ];
$cheque_date = $_REQUEST[ 'cheque_date' ];
$courier_company = $_REQUEST[ 'courier_company' ];

$fuel_adjustment = $_REQUEST[ 'fuel_adjustment' ];
$fuel_surcharge = $_REQUEST[ 'fuel_surcharge' ];
$fuel_factor = $_REQUEST[ 'fuel_factor' ];
$gst_amount = $_REQUEST[ 'gst_amount' ];
$hnd_oth_charges = $_REQUEST[ 'hnd_oth_charges' ];
$price_adjustment = $_REQUEST[ 'price_adjustment' ];
$cmi_charges = $_REQUEST[ 'cmi_charges' ];
$insurance_charges = $_REQUEST[ 'insurance_charges' ];
$discount = $_REQUEST[ 'discount' ];
$other_charges = $_REQUEST[ 'other_charges' ];

$payment_receiving_id = executeQuery( "INSERT INTO `order_courier_bill_receivings` (`id`, `payment_inv_no`, `cheque_number`, `cheque_amount`, `cheque_date`, `courier_company`, `fuel_adjustment`, `fuel_surcharge`, `fuel_factor`, `gst_amount`, `hnd_oth_charges`, `price_adjustment`, `cmi_charges`, `insurance_charges`, `discount`, `other_charges`, `cheque_payment`, `cleared_at`, `cleared_by`, `created_at`, `created_by`) VALUES (NULL, '$payment_inv_no', '$cheque_number', '$cheque_amount', '$cheque_date', '$courier_company', '$fuel_adjustment', '$fuel_surcharge', '$fuel_factor', '$gst_amount', '$hnd_oth_charges', '$price_adjustment', '$cmi_charges', '$insurance_charges', '$discount', '$other_charges', 'Pending', NULL, '', '$currentDateTime', '$_SESSION[email]')" );

$fuel_adjustment = $fuel_adjustment / $total_number;
$fuel_surcharge = $fuel_surcharge / $total_number;
$fuel_factor = $fuel_factor / $total_number;
$gst_amount = $gst_amount / $total_number;
$hnd_oth_charges = $hnd_oth_charges / $total_number;
$price_adjustment = $price_adjustment / $total_number;
$cmi_charges = $cmi_charges / $total_number;
$insurance_charges = $insurance_charges / $total_number;
$discount = $discount / $total_number;
$other_charges = $other_charges / $total_number;

    //    getting data for company accounts
    $couries_account_details=return_resultarray("SELECT company_dispatch_ledger,default_cash_handler_ledger,company_receiving_ledger,cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$courier_company'");
    
    $company_dispatch_ledger=$couries_account_details['company_dispatch_ledger'];
    $default_cash_handler_ledger=$couries_account_details['default_cash_handler_ledger'];
    $company_receiving_ledger=$couries_account_details['company_receiving_ledger'];
    $cash_receiving_ledger=$couries_account_details['cash_receiving_ledger'];
  $sql_voucher="INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$date', 'Automated Voucher For Payment Receiving id $payment_receiving_id', 'CRV', '$order_amount[0]', '$order_amount[0]', '$currentDateTime')";
            $query_voucher=mysqli_query($con,$sql_voucher);
            $voucher_id=mysqli_insert_id($con);
//            $voucher_id=100;

for ( $i = 0; $i < $total_number; $i++ ) {
  executeQuery( "UPDATE `order_dispatch_info` SET order_amount='$order_amount[$i]', courier_cost='$courier_cost[$i]', package_weight='$package_weight[$i]', payment_status='$status[$i]',customer_feedback='$customer_feedback[$i]',status='$d_status[$i]',fuel_adjustment='$fuel_adjustment',fuel_surcharge='$fuel_surcharge',fuel_factor='$fuel_factor',gst_amount='$gst_amount',hnd_oth_charges='$hnd_oth_charges',price_adjustment='$price_adjustment',cmi_charges='$cmi_charges',insurance_charges='$insurance_charges',discount='$discount',other_charges='$other_charges',payment_receiving_id='$payment_receiving_id' WHERE order_id='$order_id[$i]'" );
  $total_service_charges = get_order_total_courier_charges( $order_id[ $i ] );
  executeQuery( "UPDATE `order_dispatch_info` SET total_service_charges='$total_service_charges' WHERE order_id='$order_id[$i]'" );
  $inquiy_id = showQuery( "SELECT order_patient_id FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  $seller = showQuery( "SELECT seller FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$d_status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', 'Edit Payment Received Bill# $payment_receiving_id', NULL, NULL, NULL, NULL, NULL, NULL)" );
  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', 'Payment Received Bill# $payment_receiving_id', NULL, NULL, NULL, NULL, NULL, NULL)" );
    
                           
//            leny wala account
//    $cr_tid=executeQuery
    if($row_view['payment_status']=="Payment Received")
        {
            
        $receivable=$order_amount[$i]-$total_service_charges;
        }
        else
        {
            
        $receivable=-$total_service_charges;
        }
            $cr_tid=executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_receiving_ledger', '$date', '$receivable', '$order_id[$i]', 'Automated Received Payment Order ID $order_id[$i] worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");
    executeQuery ("UPDATE `order_dispatch_info` SET `payment_accounts_voucher_receiving`='$voucher_id', `receiving_voucher_tid`='$cr_tid' WHERE `order_id`='$order_id[$i]'");
            
//            deny wala account
            $dr_tid=executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$cash_receiving_ledger', '$date', '$receivable', '$order_id[$i]', 'Automated Received Payment Order ID $order_id[$i] worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)");
       executeQuery ("UPDATE `order_dispatch_info` SET `payment_accounts_voucher_receiving`='$voucher_id', `receiving_voucher_tid`='$dr_tid' WHERE `order_id`='$order_id[$i]'");
       
               
            
    

  executeQuery( "DELETE FROM `order_payment_cart` WHERE order_id='$order_id[$i]'" );
}
alertredirect( "Receiving Id $payment_receiving_id Submitted Successfully", "receive_courier_payment.php" );
?>