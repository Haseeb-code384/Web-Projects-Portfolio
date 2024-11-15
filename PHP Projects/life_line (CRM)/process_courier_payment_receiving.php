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
$couries_account_details = return_resultarray( "SELECT company_dispatch_ledger,default_cash_handler_ledger,company_receiving_ledger,cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$courier_company'" );

$company_dispatch_ledger = $couries_account_details[ 'company_dispatch_ledger' ];
$default_cash_handler_ledger = $couries_account_details[ 'default_cash_handler_ledger' ];
$company_receiving_ledger = $couries_account_details[ 'company_receiving_ledger' ];
$cash_receiving_ledger = $couries_account_details[ 'cash_receiving_ledger' ];
$sql_voucher = "INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$cheque_date', 'Automated Voucher For Payment Receiving id $payment_receiving_id', 'CRV', '$order_amount[0]', '$order_amount[0]', '$currentDateTime')";
$query_voucher = mysqli_query( $con, $sql_voucher );
$voucher_id = mysqli_insert_id( $con );
//            $voucher_id=100;

for ( $i = 0; $i < $total_number; $i++ ) {
    
  $seller = showQuery( "SELECT seller FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  $receiver_name = showQuery( "SELECT receiver_name FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  $order_date = showQuery( "SELECT order_date FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );

  $total_service_charges = get_order_total_courier_charges( $order_id[ $i ] );
  $tracking_id = showQuery( "SELECT tracking_id FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  executeQuery( "UPDATE `order_dispatch_info` SET order_amount='$order_amount[$i]', courier_cost='$courier_cost[$i]', package_weight='$package_weight[$i]', payment_status='$status[$i]',customer_feedback='$customer_feedback[$i]',status='$d_status[$i]',fuel_adjustment='$fuel_adjustment',fuel_surcharge='$fuel_surcharge',fuel_factor='$fuel_factor',gst_amount='$gst_amount',hnd_oth_charges='$hnd_oth_charges',price_adjustment='$price_adjustment',cmi_charges='$cmi_charges',insurance_charges='$insurance_charges',discount='$discount',other_charges='$other_charges',payment_receiving_id='$payment_receiving_id' WHERE order_id='$order_id[$i]'" );
        executeQuery("INSERT INTO `order_dispatch_info_history` SET order_amount='$order_amount[$i]', courier_cost='$courier_cost[$i]', package_weight='$package_weight[$i]', updated_at='$currentDateTime',courier_company='$courier_company',payment_status='$status[$i]',customer_feedback='$customer_feedback[$i]',status='$d_status[$i]',fuel_adjustment='$fuel_adjustment',fuel_surcharge='$fuel_surcharge',fuel_factor='$fuel_factor',gst_amount='$gst_amount',hnd_oth_charges='$hnd_oth_charges',price_adjustment='$price_adjustment',cmi_charges='$cmi_charges',insurance_charges='$insurance_charges',discount='$discount',other_charges='$other_charges',payment_receiving_id='$payment_receiving_id',order_id='$order_id[$i]',total_service_charges='$total_service_charges',tracking_id='$tracking_id',payment_accounts_voucher_receiving='$voucher_id',entered_at='$currentDateTime' ");
  executeQuery( "UPDATE `order_dispatch_info` SET total_service_charges='$total_service_charges' WHERE order_id='$order_id[$i]'" );
  $inquiy_id = showQuery( "SELECT order_patient_id FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );


  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$d_status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', '$d_status[$i] Bill# $payment_receiving_id', NULL, NULL, NULL, NULL, NULL, NULL)" );
  executeQuery( "INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`, `duration`, `call_type`, `entered_by`, `call_status`, `medicine_status`, `patient_feedback`) VALUES (NULL, '$inquiy_id', 'Order Handling', '$status[$i]', '$currentDateTime', '$_SESSION[email]', '$seller', '$order_id[$i]', '$status[$i] Bill# $payment_receiving_id', NULL, NULL, NULL, NULL, NULL, NULL)" );


  $current_payment_status = showQuery( "SELECT payment_status FROM `order_dispatch_info` WHERE order_id='$order_id[$i]'" );
  if ( $current_payment_status == "Payment Received" ) {
    echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$cash_receiving_ledger', '$cheque_date', '$order_amount[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Received Payment Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)" );

    echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_receiving_ledger', '$cheque_date', '$order_amount[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Received Payment For Delivering Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)" );

    if ( $courier_company != "POST OFFICE " ) {
      //            deny wala account
      echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$cash_receiving_ledger', '$cheque_date', '$total_service_charges', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Paid Service Charges Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)" );
      echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_receiving_ledger', '$cheque_date', '$total_service_charges', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Paid Service Charges Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)" );
    }
  }


  if ( $current_payment_status == "Return Received" || $current_payment_status == "Return Received With Payment" ) {
      if(!exists_in_db("SELECT * FROM `m_account_detail` WHERE type='$order_id[$i]' AND status='Return Stock Received';"))
        {
    echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_dispatch_ledger', '$cheque_date', '$order_amount[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Return Stock Received Against Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)" );

    echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '796', '$cheque_date', '$order_amount[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Return Stock Received Against Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)" );

  }
  }
  if ( $current_payment_status == "Return Payment Received" || $current_payment_status == "Return Received With Payment" ) {
    if ( $courier_company != "POST OFFICE " ) {
        if(!exists_in_db("SELECT * FROM `m_account_detail` WHERE type='$order_id[$i]' AND status='Paid Return Service Charges';"))
        {
      echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$cash_receiving_ledger', '$cheque_date', '$total_service_charges', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Paid Return Service Charges Against Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)" );

      echo executeQuery( "INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_receiving_ledger', '$cheque_date', '$total_service_charges', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Paid Return Service Charges Against Order# $order_id[$i] Receiver $receiver_name via $courier_company Trk#$tracking_id Dated $order_date  worth $order_amount[$i] Service Charges $total_service_charges', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)" );
            }
    }
  }


  executeQuery( "UPDATE `order_dispatch_info` SET `payment_accounts_voucher_receiving`='$voucher_id' WHERE `order_id`='$order_id[$i]'" );
   if($customer_feedback[$i]!="000.00")
            {
//                echo $courier_cost[$i];
                
    //Cash Account ko mila
                
            $dr_tid=executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_receiving_ledger', '$cheque_date', '$customer_feedback[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Consultency Fee Order ID $order_id[$i] Receiver $receiver_name Dated $order_date worth $order_amount[$i] ', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)"); 
    
                //    company ko Se Nikla
    executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '797', '$cheque_date', '$customer_feedback[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Consultency Fee Order ID $order_id[$i] Receiver $receiver_name Dated $order_date worth $order_amount[$i]', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");  
       
        $dr_tid=executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_receiving_ledger', '$cheque_date', '$customer_feedback[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Consultency Fee Charged Order ID $order_id[$i] Receiver $receiver_name Dated $order_date worth $order_amount[$i] ', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)"); 
    
                //    company ko Se Nikla
    executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$cash_receiving_ledger', '$cheque_date', '$customer_feedback[$i]', '$order_id[$i]', 'Automated Receiving# $payment_receiving_id Consultency Fee Charged Order ID $order_id[$i] Receiver $receiver_name Dated $order_date worth $order_amount[$i]', '$voucher_id', '$_SESSION[email]', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)");
            }

  include( "refresh_order_data.php" );

  executeQuery( "DELETE FROM `order_payment_cart` WHERE order_id='$order_id[$i]'" );
}

alertredirect( "Receiving Id $payment_receiving_id Submitted Successfully", "receive_courier_payment.php" );
?>