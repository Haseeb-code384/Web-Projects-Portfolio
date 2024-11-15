<?php
session_start();
include( "config.php" );
include( "allFunctions.php" );

$order_id = $_REQUEST[ 'order_id' ];
$order_amount = $_REQUEST[ 'order_amount' ];
$courier_cost = $_REQUEST[ 'courier_cost' ];
$package_weight = $_REQUEST[ 'package_weight' ];
//$status = $_REQUEST[ 'status' ];
$customer_feedback = $_REQUEST[ 'customer_feedback' ];
$d_status = $_REQUEST[ 'd_status' ];
$total_number = count( $package_weight );
echo $total_number;

$cheque_date = $_REQUEST[ 'cheque_date' ];
$courier_company = $_REQUEST[ 'courier_company' ];

$order_courier_dispatch_id = executeQuery( "INSERT INTO `order_courier_dispatch` (`id`, `cheque_date`, `courier_company`, `cleared_at`, `cleared_by`, `created_at`, `created_by`) VALUES (NULL, '$cheque_date', '$courier_company', NULL, '', '$currentDateTime', '$_SESSION[email]')" );

    //    getting data for company accounts
    $couries_account_details=return_resultarray("SELECT company_dispatch_ledger,default_cash_handler_ledger,company_receiving_ledger,cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$courier_company'");
    
    $company_dispatch_ledger=$couries_account_details['company_dispatch_ledger'];
    $default_cash_handler_ledger=$couries_account_details['default_cash_handler_ledger'];
    $company_receiving_ledger=$couries_account_details['company_receiving_ledger'];
    $cash_receiving_ledger=$couries_account_details['cash_receiving_ledger'];

      $sql_voucher="INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$cheque_date', 'Automated Voucher For Dispatch id $order_courier_dispatch_id', 'JV', '$order_amount[0]', '$order_amount[0]', '$currentDateTime')";

            $query_voucher=mysqli_query($con,$sql_voucher);
            $voucher_id=mysqli_insert_id($con);
//            $voucher_id=100;

for ( $i = 0; $i < $total_number; $i++ ) {
  executeQuery( "UPDATE `order_dispatch_info` SET order_amount='$order_amount[$i]', courier_cost='$courier_cost[$i]', package_weight='$package_weight[$i]',customer_feedback='$customer_feedback[$i]',status='$d_status[$i]',dispatch_id='$order_courier_dispatch_id' WHERE order_id='$order_id[$i]'" );
    
  $total_service_charges = get_order_total_courier_charges( $order_id[ $i ] );
  executeQuery( "UPDATE `order_dispatch_info` SET total_service_charges='$total_service_charges' WHERE order_id='$order_id[$i]'" );
    
  $inquiy_id = showQuery( "SELECT order_patient_id FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
    
  $seller = showQuery( "SELECT seller FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  $receiver_name = showQuery( "SELECT receiver_name FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  $order_date = showQuery( "SELECT order_date FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  $tracking_id = showQuery( "SELECT tracking_id FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
    
  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$d_status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', 'Edit Payment Received Bill# $order_courier_dispatch_id', NULL, NULL, NULL, NULL, NULL, NULL)" );
    
//  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', 'Payment Received Bill# $order_courier_dispatch_id', NULL, NULL, NULL, NULL, NULL, NULL)" );
    
                           
//            leny wala account
//    $cr_tid=executeQuery
//    if($row_view['payment_status']=="Payment Received")
//        {
//        $receivable=$order_amount[$i]-$total_service_charges;
//        }
//        else
//        {
//        $receivable=$total_service_charges;
//        }
//    company ko stock dia
            $dr_tid=executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_dispatch_ledger', '$cheque_date', '$order_amount[$i]', '$order_id[$i]', 'Automated Dispatch# $order_courier_dispatch_id Order ID $order_id[$i] Receiver $receiver_name Via $courier_company Trk#$tracking_id Dated $order_date worth $order_amount[$i]  ', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)"); 
    
    //stock nikla lia
    executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '796', '$cheque_date', '$order_amount[$i]', '$order_id[$i]', 'Automated Dispatch# $order_courier_dispatch_id Order ID $order_id[$i] Receiver $receiver_name Via $courier_company Trk#$tracking_id Dated $order_date Medicine Worth $order_amount[$i]', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");
    
    executeQuery ("UPDATE `order_dispatch_info` SET `payment_accounts_voucher_dispatch`='$voucher_id', `dispatch_voucher_tid`='$dr_tid' WHERE `order_id`='$order_id[$i]'");
    
            if($courier_cost[$i]!="000.00")
            {
//                echo $courier_cost[$i];
                 //Cash Account se cash nikla lia
              
            $dr_tid=executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_dispatch_ledger', '$cheque_date', '$courier_cost[$i]', '$order_id[$i]', 'Automated Dis# $order_courier_dispatch_id Paid Service Charges Order ID $order_id[$i] Receiver $receiver_name Dated $order_date worth $order_amount[$i] ', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)"); 
    
     //    company ko Payment di
    executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$default_cash_handler_ledger', '$cheque_date', '$courier_cost[$i]', '$order_id[$i]', 'Automated Dis# $order_courier_dispatch_id Paid Service Charges Order ID $order_id[$i] Receiver $receiver_name Dated $order_date worth $order_amount[$i]', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");
            }

                   
         
            
    
include("refresh_order_data.php");

  executeQuery( "DELETE FROM `order_dispatch_cart` WHERE order_id='$order_id[$i]'" );
}
alertredirect( "Dispatch Id $order_courier_dispatch_id Submitted Successfully", "dispatch_courier.php" );
?>