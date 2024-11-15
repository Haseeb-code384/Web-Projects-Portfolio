<?php session_start();
include('config.php');
include('allFunctions.php');

$login_user=$_SESSION['email'];
$tdate=$_REQUEST['date'];
$tamount=$_REQUEST['tamount'];
$remarks=$_REQUEST['remarks'];
$reading1=$_REQUEST['reading1'];
$salesman=$_REQUEST['salesman'];

$product=$_REQUEST['product'];
$unit_price=$_REQUEST['unit_price'];
$quantity=$_REQUEST['quantity'];
$amount=$_REQUEST['amount'];

$total_prod_no=count(array_filter($product));
$sql="INSERT INTO `dispatch` (`id`, `date`, `remarks`, `salesman`, `tamount`, `timestamp`, `entered_by`, `reading1`) VALUES (NULL, '$tdate', '$reading1', '$salesman', '$tamount', '$currentDateTime', '$login_user', '$reading1')";
$query=mysqli_query($con,$sql);
$dispatch_no=mysqli_insert_id($con);
echo $dispatch_no;
$amnt=0;
		$i=0;
		for($i=0;$i<$total_prod_no;$i++)
		{
			if($product!=null)
			{
				if($unit_price[$i]==0)
				{
					$unit_price[$i]=showQuery("SELECT unit_price FROM `ospos_items` WHERE item_id='$product[$i]'");
				}
				$amnt=$quantity[$i]*$unit_price[$i];
				executeQuery("INSERT INTO `dispatch_detail` (`id`, `dispatch_no`, `product_id`, `quantity`, `unit_price`, `amount`) VALUES (NULL, '$dispatch_no', '$product[$i]', '$quantity[$i]', '$unit_price[$i]', '$amnt')");
				
				executeQuery("INSERT INTO `ospos_inventory` (`trans_id`, `trans_items`, `trans_user`, `trans_date`, `trans_comment`, `trans_location`, `trans_inventory`) VALUES (NULL, '$product[$i]', '1', '$currentDateTime', 'Dispatch $dispatch_no', '1', '$quantity[$i]')");
				
				executeQuery("UPDATE `ospos_item_quantities` SET quantity=quantity-'$quantity[$i]' WHERE item_id='$product[$i]' AND location_id=1");
				$amnt=0;
		}
			
		}
$location="Location: dispatch_voucher.php?dispatch_id=".$dispatch_no;
header($location);
?>