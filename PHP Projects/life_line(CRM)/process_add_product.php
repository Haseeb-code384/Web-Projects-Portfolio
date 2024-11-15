<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];

if(isset($_REQUEST['submit']))
{
	
		$name=$_REQUEST['name'];
		$generic_name=$_REQUEST['generic_name'];
		$category=$_REQUEST['category'];
		$supplier_id=$_REQUEST['supplier_id'];
		$company=$_REQUEST['company'];
		$description=$_REQUEST['description'];
		$cost_price=$_REQUEST['cost_price'];
		$sale_price=$_REQUEST['sale_price'];
		$reorder_level=$_REQUEST['reorder_level'];
		$location=$_REQUEST['location'];
	
		
	$sql="INSERT INTO `products` (`item_id`, `name`, `generic_name`, `category`, `supplier_id`, `company`, `description`, `cost_price`, `sale_price`, `reorder_level`, `location`, `deleted`, `quantity`, `created_at`, `created_by`) VALUES (NULL, '$name', '$generic_name', '$category','$supplier_id', '$company', '$description', $cost_price, '$sale_price', '$reorder_level', '$location', '0', '0.000', '$currentDateTime', '$login_users')";
	$query=mysqli_query($con,$sql);
    $lastid=mysqli_insert_id($con);
    
	if($query)
	{
		alertredirect("Submitted Successfully","add_product.php");
	}
	else
	{		
		echo "<script>alert('Something Went Wrong!!!')</script>";
	}
	
}

?>