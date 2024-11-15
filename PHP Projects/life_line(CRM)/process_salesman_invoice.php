<?php
session_start();
if ( !isset( $_SESSION[ 'email' ] ) ) {
	header( "location:login.php" );
}

$login_user=$_SESSION['email'];
include( "config.php" );
include( "allFunctions.php" );

$idate = $_REQUEST[ 'idate' ];
$commission_amount = $_REQUEST[ 'commission_amount' ];
$remarks = $_REQUEST[ 'remarks' ];
$salesman = $_REQUEST[ 'salesman' ];
$salesman = $_REQUEST[ 'salesman' ];
$commission_p_age = $_REQUEST[ 'commission_p_age' ];
$vehicle_no = $_REQUEST[ 'vehicle_no' ];
$reading1 = $_REQUEST[ 'reading1' ];
$reading2 = $_REQUEST[ 'reading2' ];
$distance = $_REQUEST[ 'distance' ];
$fuel_rate = $_REQUEST[ 'fuel_rate' ];
$per_km = $_REQUEST[ 'per_km' ];
$fuel_charges = $_REQUEST[ 'fuel_charges' ];
$rent = $_REQUEST[ 'rent' ];
$misc = $_REQUEST[ 'misc' ];
$parchi = $_REQUEST[ 'parchi' ];
$product = $_REQUEST[ 'product' ];
$p_unit_price = $_REQUEST[ 'p_unit_price' ];
$p_dispatch = $_REQUEST[ 'p_dispatch' ];
$p_return = $_REQUEST[ 'p_return' ];
$p_waste = $_REQUEST[ 'p_waste' ];
$discount = $_REQUEST[ 'discount' ];
$cash_received = $_REQUEST[ 'cash_received' ];
$balance = $_REQUEST[ 'balance' ];
$final_qty = $_REQUEST[ 'final_qty' ];
$amount = $_REQUEST[ 'amount' ];

$sqlinv="INSERT INTO `invoice` (`id`, `date`, `remarks`, `salesman`, `commission_p_age`, `vehicle_no`, `reading1`, `reading2`, `distance`, `fuel_rate`, `per_km`, `fuel_charges`, `rent`, `misc`, `parchi`, `timestamp`, `discount`, `commission_amount`, `amount`, `received_amount`, `entered_by`) VALUES (NULL, '$date', '$remarks', '$salesman', '$commission_p_age', '$vehicle_no', '$reading1', '$reading2', '$distance', '$fuel_rate', '$per_km', '$fuel_charges', '$rent', '$misc', '$parchi', '$currentDateTime', '$discount', '$commission_amount', '0', '$cash_received', '$login_user')";
echo $sqlinv;
$queryinv=mysqli_query($con,$sqlinv);

$inv_no=mysqli_insert_id($con);

$t = 0;
$tamount = 0;
$total_prod_no = count( array_filter( $product ) );
for ( $i = 0; $i < $total_prod_no; $i++ ) 
{
	echo $product[ $i ];
	echo $p_unit_price[ $i ];
	echo $p_dispatch[ $i ];
	echo $p_return[ $i ];
	echo $p_waste[ $i ];
	echo $fq = $p_dispatch[ $i ] - $p_return[ $i ] - $p_waste[ $i ];
	$tamount = $fq * $p_unit_price[ $i ];
	echo $tamount;
	echo $t = $t + $tamount;
	$tamount = 0;

	echo $t;
	 echo $discount; 
	echo $commission_amount=$t*($commission_p_age/100); 
	$gtotal=$t-$discount-$commission_amount-$fuel_charges-$rent-$misc-$parchi;
	echo $gtotal; 
	$sql_invdetail="INSERT INTO `invoice_details` (`id`, `inv_id`, `product`, `p_unit_price`, `p_dispatch`, `p_return`, `p_waste`, `final_qty`, `amount`, `salesman`, `date`) VALUES (NULL, '$inv_no', '$product[$i]', '$p_unit_price[$i]', '$p_dispatch[$i]', '$p_return[$i]', '$p_waste[$i]', '$final_qty[$i]', '$amount[$i]', '$salesman', '$idate')";
	executeQuery($sql_invdetail);
}
executeQuery("UPDATE `invoice` SET `amount` = '$gtotal' WHERE `invoice`.`id` ='$inv_no';");
executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`) VALUES (NULL, $salesman, '$idate', '$gtotal', '', 'Voucher $inv_no Amount', '$inv_no', '$login_user', '0000-00-00 00:00:00.000000', NULL, 'Dr', '$currentDateTime')");
executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`, `timestamp`) VALUES (NULL, $salesman, '$idate', '$cash_received', '$salesman', 'Cach Received Voucher $inv_no and salesman $salesman', '$inv_no', '$login_user', '0000-00-00 00:00:00.000000', NULL, 'Cr', '$currentDateTime')");
$location="Location: print_invoice.php?invoice_date=$idate&salesman=$salesman";
header($location);
	?>