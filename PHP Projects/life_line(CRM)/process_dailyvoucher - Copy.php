<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];
$invoice_no=$_REQUEST['invoice_no'];
$tdate=$_REQUEST['date'];
$remarks=$_REQUEST['remarks'];
$type=$_REQUEST['type'];
$total_cr_amount=$_REQUEST['sold_weight'];
$total_dr_amount=$_REQUEST['sold_amount'];
$craccount=$_REQUEST['craccount'];
$draccount=$_REQUEST['draccount'];
//$crtype=$_REQUEST['crtype'];
$crdesc=$_REQUEST['farq'];
$cramount=$_REQUEST['wazan'];
//$drtype=$_REQUEST['drtype'];
$drdesc=$_REQUEST['ddesc'];
$dramount=$_REQUEST['damount'];

$total_cr_no=count(array_filter($craccount));
$total_dr_no=count(array_filter($draccount));



$sql="INSERT INTO `daily_voucher` (`id`, `date`, `remarks`, `type`, `total_cr_amount`, `total_dr_amount`, `timestamp`) VALUES (NULL, '$tdate', '$remarks', '$type', '$total_cr_amount', '$total_dr_amount', '$currentDateTime')";

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
<a href="dailyvoucher.php"><button>New Voucher</button></a>
	<a href="index.php"><button>Home</button></a>
	</div>
<div id="print_this">
	
	<table border="1" style="width: 100%">
	<tr>
<center><img src="img/mp_logo1.png"></center>
		<th colspan="5" style="border: none;"><h3><?php echo $project_name; ?></h3></th>
		</tr>
		<tr >
		<th  style="border: none;">Voucher# <?php echo $invoice_no; ?></th>
		<th  style="border: none;" colspan="">Type: <?php echo $type; ?></th>
		<th  style="border: none;" colspan="">Date: <?php echo $tdate; ?></th>
		<th  style="border: none;" colspan="2">Remarks: <?php echo $remarks; ?></th>
		</tr>
	</table>
	<div style="display: inline;">
	
	ِ<table width="50%" border="1" style="position: absolute; float: left; margin-top: -18px">
	<tr>
	<th colspan="4">
		Out Side Dr (بنام)
		</th>
	</tr>
		<tr  style="background-color: lightgray;">
		<th>Dr Amount</th>
		<th>Description</th>
		
		<th>Account</th>
		</tr>
		
		<?php
		$i=0;
		for($i=0;$i<$total_dr_no;$i++)
		{
			if($draccount!=null)
			{
				
			?>
	<tr>
	<th><?php echo $dramount[$i] ?></th>
	<th><?php echo $drdesc[$i] ?></th>
	<th><?php echo showQuery("SELECT concat('(',m_accountid,') ',account) FROM `master_account` WHERE m_accountid='$draccount[$i]'")  ?></th>
		
		</tr>
	<?php
				executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`) VALUES (NULL, $draccount[$i], '$tdate', '$dramount[$i]', '', '$drdesc[$i]', '$invoice_no', NULL, '0000-00-00 00:00:00.000000', NULL, 'Dr')");
				
		}
		}
			?>
		
	<tr style="background-color: pink;" align="center">
						
							<th><strong><?php echo $total_dr_amount; ?></strong></th>
							<th colspan="2">Total Dr</th>
							
						
						</tr>
	</table>
	ِ<table width="49.5%" border="1" style="float: right; margin-top: auto;">
	<tr>
	<th colspan="4">
		In Side Cr (جمع)
		</th>
	</tr>
		<tr  style="background-color: lightgray;">
		<th>Cr Amount</th>
		<th>Description</th>
		
		<th>Account</th>
		</tr>
		
		<?php
		$i=0;
		for($i=0;$i<$total_cr_no;$i++)
		{
			if($craccount!=null)
			{
				
			?>
	<tr>
	<th><?php echo $cramount[$i] ?></th>
	<th><?php echo $crdesc[$i] ?></th>
	<th><?php echo showQuery("SELECT concat('(',m_accountid,') ',account) FROM `master_account` WHERE m_accountid='$craccount[$i]'")  ?></th>
		
		</tr>
	<?php
				executeQuery("INSERT INTO `m_account_detail` (`sno`, `m_accountid`, `tr_date`, `amount`, `type`, `tr_description`, `invno`, `entered_by`, `edited_at`, `edited_by`, `info`) VALUES (NULL, $craccount[$i], '$tdate', '$cramount[$i]', '', '$crdesc[$i]', '$invoice_no', NULL, '0000-00-00 00:00:00.000000', NULL, 'Cr')");
		}
			
		}
		
			?>
		
	<tr style="background-color: pink;" align="center">
						
							<th><strong><?php echo $total_cr_amount; ?></strong></th>
							<th colspan="2">Total Cr</th>
							
						
						</tr>
	</table>
	</div>
</div>
	</body>
	
</html>
