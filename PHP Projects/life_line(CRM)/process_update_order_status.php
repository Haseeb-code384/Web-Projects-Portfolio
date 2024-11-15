<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];
$id=$_REQUEST['id'];

if(isset($_REQUEST['submit']))
{
	
	echo	$id=$_REQUEST['id'];
		$old_status=$_REQUEST['old_status'];
		$order_status=$_REQUEST['order_status'];
		
		$comments=$_REQUEST['comments'];
	
    $row_current=return_resultarray("SELECT seller,order_patient_id,order_amount,courier_cost,order_amount+courier_cost AS 'total_charges',courier_company FROM `order_dispatch_info` WHERE order_id='$id'");
    $total_charges=$row_current['total_charges'];
    $courier_cost=$row_current['courier_cost'];
    $order_amount=$row_current['order_amount'];
    $courier_company=$row_current['courier_company'];
//    getting data for company accounts
    $couries_account_details=return_resultarray("SELECT company_dispatch_ledger,default_cash_handler_ledger,company_receiving_ledger,cash_receiving_ledger FROM `courier_company` WHERE company_account_name='$courier_company'");
    
    $company_dispatch_ledger=$couries_account_details['company_dispatch_ledger'];
    $default_cash_handler_ledger=$couries_account_details['default_cash_handler_ledger'];
    $company_receiving_ledger=$couries_account_details['company_receiving_ledger'];
    $cash_receiving_ledger=$couries_account_details['cash_receiving_ledger'];
    
    
//    if(($order_status!=$old_status))
    if((true))
    {
        if($login_user=='')
        {
            $login_user=$row_current[0];
        }
        executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `order_no`, `comments`) VALUES (NULL, '$row_current[1]','Order Handling','$order_status', '$currentDateTime','$login_user','$row_current[0]','$id','$comments')");
        
	$sql="UPDATE `order_dispatch_info` SET `status`='$order_status' WHERE `order_id`='$id';";
        
        if($order_status=="Dispatched")
        {
           
            
// 
//            if($courier_company=="POST OFFICE ")
//            {   $sql_voucher="INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$date', 'Automated Voucher For Order id $id', 'JV', '$total_charges', '$total_charges', '$currentDateTime')";
//            $query_voucher=mysqli_query($con,$sql_voucher);
//            $voucher_id=mysqli_insert_id($con);
//                           
////            leny wala account
//            executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_dispatch_ledger', '$date', '$order_amount', 'Order$id', 'Automated Dispatch Parcel $id worth $order_amount', '$voucher_id', 'System', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)");          
////            leny wala account
//            executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_dispatch_ledger', '$date', '$courier_cost', 'Order$id', 'Automated Dispatch Parcel $id Courier Charges $courier_cost', '$voucher_id', 'System', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)");
//            
////            deny wala account sock Cr
//            executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '635 ', '$date', '$order_amount', 'Order$id', 'Automated Dispatch Parcel $id worth $order_amount', '$voucher_id', 'System', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)"); 
////            deny wala account
//            executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$default_cash_handler_ledger', '$date', '$courier_cost', 'Order$id', 'Automated Dispatch Parcel $id Courier Charges $courier_cost', '$voucher_id', 'System', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");
//            }
//            else
//            {
//                 $sql_voucher="INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$date', 'Automated Voucher For Order id $id', 'JV', '$order_amount', '$order_amount', '$currentDateTime')";
//            $query_voucher=mysqli_query($con,$sql_voucher);
//            $voucher_id=mysqli_insert_id($con);
//                           
////            leny wala account
//            executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$company_dispatch_ledger', '$date', '$order_amount', 'Order$id', 'Automated Dispatch Parcel $id worth $order_amount', '$voucher_id', 'System', '$currentDateTime', NULL, 'Dr', '$currentDateTime', NULL, NULL)");
//            
////            deny wala account
//            executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`, `user_verified`, `admin_verified`) VALUES (NULL, '$default_cash_handler_ledger', '$date', '$order_amount', 'Order$id', 'Automated Dispatch Parcel $id worth $order_amount', '$voucher_id', 'System', '$currentDateTime', NULL, 'Cr', '$currentDateTime', NULL, NULL)");
//            }
//         
            
            
        }
        
    }
    
//echo $sql;	
	$query=mysqli_query($con,$sql) or die(mysqli_error($con));
	if($query)
	{
		alertredirect("Submitted Successfully","view_orders.php");
	}
	else
	{
		
		echo "<script>alert('Something Went Wrong!!!')</script>";
	}
	
}

?>