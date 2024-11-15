<?php session_start();
include('config.php');
include('allFunctions.php');
$user=$_SESSION['email'];
$invoice_no=$_REQUEST['invoice_no'];
$date=$_REQUEST['date'];
$remarks=$_REQUEST['remarks'];
$sold_received=$_REQUEST['sold_received'];
$customer=$_REQUEST['customer'];
$wasooli=$_REQUEST['wasooli'];
$tafseel=$_REQUEST['tafseel'];
$total_cusomers=count($customer);

$sql="INSERT INTO `tbl_dailycashrecv` (`refno`, `tdate`, `remarks`, `totalcashrecv`, `entry_at`, `entered_by`, `a`, `b`) VALUES (NULL, '$date', '$remarks', '$sold_received', '$currentDateTime', '$user', '', '')";
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
<a href="daily-cash-recovery.php"><button>New Recovery</button></a>
	<a href="index.php"><button>Home</button></a>
	</div>
<div id="print_this">
	
	<table border="1" style="width: 100%">
	<tr>
<center><img src="img/mp_logo1.png"></center>
		<th colspan="5" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
		
		</tr>
		ِ<tr><th colspan="5" style="border: none;"><h3>کیش وصولی رسید</h3></th></tr>
		<tr >
		
		<th  style="border: none;">Invoice# <?php echo $invoice_no; ?></th>
		<th  style="border: none;" colspan="3">Date: <?php echo $date; ?></th>
		</tr>
	</table>
	ِ<table width="100%" border="1">
		<tr  style="background-color: lightgray;">
		<th>تفصیل</th>
		<th>وصولی</th>
		<th>دکان دار کا نام</th>
			<th>ٹوٹل بل</th>
			<th>لمٹ</th>
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
				$upd_c_bal="UPDATE master_account SET netbalance=netbalance-$wasooli[$i] WHERE m_accountid='$customer[$i]'";
				
				executeQuery($upd_c_bal) ;
				
				$total_balance=showQuery("SELECT netbalance FROM `master_account` WHERE m_accountid='$customer[$i]'");
			$sql_cust="INSERT INTO `tbl_dailycashrecvdetail` (`id`, `refno`, `accound_id`, `amount`, `remarks`, `current_balance`) VALUES (NULL, '$invoice_no', '$customer[$i]', '$wasooli[$i]', '$tafseel[$i]', $total_balance);";
				
				
				$sql_dr="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, $customer[$i], '$currentDateTime', '$wasooli[$i]', 'Cr', 'Received Cash', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";

				executeQuery($sql_dr);
				
				
$sql_dr="INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`) VALUES (NULL, 0, '$currentDateTime', '$wasooli[$i]', 'Dr', 'Received Cash from $customer[$i]', '$invoice_no', '$login_user', '0000-00-00 00:00:00.000000', NULL)";

				executeQuery($sql_cust) ;
			

				
				?>
	<tr align="center">	
	<td><?php echo $tafseel[$i]; ?></td>
	<td><?php echo $wasooli[$i]; ?></td>
	<td><?php echo $c_name; ?></td>
	<td><?php echo $total_balance ?></td>
	<td><?php echo $cr_limit; ?></td>
	</tr>
	<?php 
			}
			
			}
			?>
	<tr style="background-color: pink;" align="center">
						<td></td>
		
							<td><?php echo $sold_received; ?></td>			
							<td></td>
		<td></td>	
							<td></td>
						</tr>
	</table>
</div>
	</body>
	
</html>
