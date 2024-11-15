<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['login_user'];
$invoice_no=$_REQUEST['invoice_no'];
$date=$_REQUEST['date'];
$supplier_id=$_REQUEST['supplier_id'];
$gari_number=$_REQUEST['gari_number'];
$route=$_REQUEST['route'];
$supplied_total_weight=$_REQUEST['supplied_total_weight'];
$supplied_less_weight=$_REQUEST['supplied_less_weight'];
$supplied_net_weight=$_REQUEST['supplied_net_weight'];
$total_amount=$_REQUEST['total_amount'];
$sold_weight=$_REQUEST['sold_weight'];
$sold_amount=$_REQUEST['sold_amount'];
$sold_received=$_REQUEST['sold_received'];
$entered_by=$_REQUEST['entered_by'];
$farm_rate=$_REQUEST['farm_rate'];
$supplier_rate=$_REQUEST['supplier_rate'];
$diesel=$_REQUEST['diesel'];
$d=$_REQUEST['d']="";
$e=$_REQUEST['e']="";
$f=$_REQUEST['f']="";
$customer=$_REQUEST['customer'];
$farq=$_REQUEST['farq'];
$wazan=$_REQUEST['wazan'];
$rate=$_REQUEST['rate'];
$amount=$_REQUEST['amount'];
$wasooli=$_REQUEST['wasooli'];
$tafseel=$_REQUEST['tafseel'];
$total_cusomers=count($customer);


				$sum_bill=0;

$sql="INSERT INTO `tbl_dailysale` (`invoice_no`, `description`, `date`, `supplier_id`, `gari_number`, `route`, `supplied_total_weight`, `supplied_less_weight`, `supplied_net_weight`, `total_amount`, `sold_weight`, `sold_amount`, `sold_received`, `entry_date`, `entered_by`, `farm_rate`, `supplier_rate`, `diesel`, `d`, `e`, `f`) VALUES ('$invoice_no', NULL, '$date', '$supplier_id', '$gari_number', '$route', '$supplied_total_weight', '$supplied_less_weight', '$supplied_net_weight', '$total_amount', '$sold_weight', '$sold_amount', '$sold_received', '$currentDateTime','$login_user', '$farm_rate', '$supplier_rate', '$diesel', '$d', '$e', '$f')";
$query=mysqli_query($con,$sql);
$sql="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, $supplier_id, '$currentDateTime', '$total_amount', 'Cr', 'purchased chicken from supplier', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";
$query=mysqli_query($con,$sql);
$sql="UPDATE `master_account` SET netbalance=netbalance-'$total_amount' WHERE m_accountid='$supplier_id'";
$query=mysqli_query($con,$sql);

$sql="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, 0, '$currentDateTime', '$total_amount', 'Dr', 'credit purchased chicken', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";
$query=mysqli_query($con,$sql);

?>

<!doctype html>
<html>
<head>
	<script src="jquery-1.7.1.min.js"></script>

<script src="printThis.js"></script>
<script language="javascript">
	function print_page(){
		$('#print_this').printThis({loadCSS:'print.css',printContainer:false});
		return false;
	}
</script>

<meta charset="utf-8">
<title><?php echo $project_name; ?></title>
</head>
<body>
<div align="center">
	<a  href="" onClick="return print_page()"><button >Print</button></a>
<a href="sale-invoce.php"><button>New Bill</button></a>
	<a href="index.php"><button>Home</button></a>
	</div>
<div id="print_this">
	
	<table border="1" style="width: 100%">
	<tr>
<center><img src="img/mp_logo1.png"></center>
		<th colspan="5" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
		</tr>
		<tr >
		<th  style="border: none;">Invoice# <?php echo $invoice_no; ?></th>
		<th  style="border: none;" colspan="3">Customer Name: <?php echo showQuery("SELECT account FROM `master_account` WHERE m_accountid='$supplier_id'") ?></th>
		<th  style="border: none;" colspan="3">Date: <?php echo $date; ?></th>
		</tr>
	</table>
	<table width="100%">
		<tr>
		<td>ڈیزل</td>
		<td>فارم ریٹ</td>
		<td>بقایا وزن</td>
		<td>کم وزن</td>
		<td>ٹوٹل وزن</td>
		</tr><tr>
			
			<td><?php echo $diesel ?></td>
			
			<td><?php echo $farm_rate ?></td>
			
			<td><?php echo $supplied_net_weight ?></td>
			
			<td><?php echo $supplied_less_weight ?></td>
			
			<td><?php echo $supplied_total_weight ?></td>
		</tr>
	</table>
	ِ<table width="100%" border="1">
		<tr  style="background-color: lightgray;">
		<th>تفصیل</th>
		<th>وصولی</th>
		<th>مال رقم</th>
		<th>ریٹ</th>
		<th>وزن</th>
		<th>فرق</th>
		<th>دکان دار کا نام</th>
			<th>ٹوٹل بل</th>
			<th>لمٹ</th>
			<th width="10">نمبر شمار</th>
		</tr>
		
		<?php
		$i=0;
		$profit=0;
		for($i=0;$i<$total_cusomers;$i++)
		{
		
			if($customer[$i]!="")
			{
				$cr_limit=showQuery("SELECT crlimit FROM `master_account` WHERE m_accountid='$customer[$i]'");
				$c_name=showQuery("SELECT account FROM `master_account` WHERE m_accountid='$customer[$i]'");
				$upd_c_bal="UPDATE master_account SET netbalance=netbalance+$amount[$i] WHERE m_accountid='$customer[$i]'";
				
				executeQuery($upd_c_bal) ;
			
				$total_balance=showQuery("SELECT netbalance FROM `master_account` WHERE m_accountid='$customer[$i]'");
			$sql_cust="INSERT INTO `invoice_detail` (`id`, `invoice_no`, `customer_id`, `cr_limit`, `total_balance`, `farq`, `wazan`, `rate`, `amount`, `wasooli`, `tafseel`) VALUES (NULL, '$invoice_no', '$customer[$i]', '$cr_limit', '$total_balance', '$farq[$i]', '$wazan[$i]', '$rate[$i]', '$amount[$i]', '$wasooli[$i]', '$tafseel[$i]');";
				
				
				$sql_dr="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, $customer[$i], '$currentDateTime', '$amount[$i]', 'Dr', 'Sold item to customer', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";

				executeQuery($sql_dr);
				if($wasooli[$i]>0)
				{
					
				$sql_wasooli="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, $customer[$i], '$currentDateTime', '$wasooli[$i]', 'Dr', 'Cash against Sold item', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";

				executeQuery($sql_wasooli);
					
$upd_dr="UPDATE `master_account` SET netbalance=netbalance-'$wasooli[$i]' WHERE m_accountid='$customer[$i]'";
$query=mysqli_query($con,$upd_dr);
				}
				
				
$sql_dr="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, 0, '$currentDateTime', '$amount[$i]', 'Cr', 'Sold item', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";

				executeQuery($sql_cust) ;
			

				$total_balance=showQuery("SELECT netbalance FROM `master_account` WHERE m_accountid='$customer[$i]'");
				$sum_bill+=$total_balance;
				
				?>
	<tr align="center">	
	<td><?php echo $tafseel[$i]; ?></td>
	<td><?php echo $wasooli[$i]; ?></td>
	<td><?php echo $amount[$i]; ?></td>
	<td><?php echo $rate[$i]; ?></td>
	<td><?php echo $wazan[$i]; ?></td>
	<td><?php echo $farq[$i]; ?></td>
	<td><?php echo $c_name; ?></td>
	<td><?php echo $total_balance ?></td>
	<td><?php echo $cr_limit; ?></td>
		<td><?php echo $i+1; ?></td>
	</tr>
	<?php 
			}
			
			}
			?>
	<tr style="background-color: pink;" align="center">
						
						<td></td>
							<td><?php echo $sold_received; ?></td>
							<td><?php echo $sold_amount; ?></td>
							
							<td></td>
		
			<td><?php echo $supplied_net_weight ?></td>
							<td><?php echo $sold_weight; ?></td>					
		<td></td>
		
							<td><?php echo $sum_bill;?></td>
							<td></td>
							<td></td>
						</tr>
	</table>
</div>
	</body>
	
</html>
