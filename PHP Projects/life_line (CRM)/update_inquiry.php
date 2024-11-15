<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];
$id=$_REQUEST['id'];

if(isset($_REQUEST['submit']))
{
	
		$id=$_REQUEST['id'];
		$committed_amount=$_REQUEST['committed_amount'];
		$call_status=$_REQUEST['call_status'];
		$recall_date=$_REQUEST['recall_date'];
		$order_status=$_REQUEST['order_status'];
		$order_confirmed_at=$_REQUEST['order_confirmed_at'];
		$appointment_at=$_REQUEST['appointment_at'];
		$comments=ucwords( $_REQUEST['comments']);
		if($recall_date=="")
		{
		    $recall_date="0000-00-00";
		}
		if($order_confirmed_at=="")
		{
		    $order_confirmed_at="0000-00-00 00:00:00";
		}	if($appointment_at=="")
		{
		    $appointment_at="0000-00-00 00:00:00";
		}
    
    $row_current=return_resultarray("SELECT inquiry.call_status,inquiry.order_status,inquiry.allocated_to,created_by  FROM `inquiry` WHERE id='$id'");
    
    if(($row_current['call_status']!=$call_status)||($row_current['call_status']==""))
    {
        if($login_user=='')
        {
            $login_user=$row_current[2];
        }
        executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `comments`) VALUES (NULL, '$id','Call','$call_status', '$currentDateTime','$login_user','$row_current[2]','$comments')");
    }
    if(($row_current['order_status']!=$order_status)||($row_current['order_status']==""))
    {
        if($login_user=='')
        {
            $login_user=$row_current[2];
        }
        executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`, `comments`) VALUES (NULL, '$id','Order','$order_status', '$currentDateTime','$login_user','$row_current[2]','$comments')");
    }
    
    
	$sql="UPDATE `inquiry` SET `call_status`='$call_status',`called_at`='$currentDateTime',`recall_date`='$recall_date',`order_status`='$order_status',`order_confirmed_at`='$order_confirmed_at',`appointment_at`='$appointment_at',`comments`='$comments',`committed_amount`='$committed_amount' WHERE `id`='$id';";
//echo $sql;	
	$query=mysqli_query($con,$sql) or die(mysqli_error($con));
	if($query)
	{
        if($_REQUEST['page']=="view_tasks.php")
        {
		alertredirect("Submitted Successfully","view_tasks.php");   
        }
        else
        {
		alertredirect("Submitted Successfully","update_inquiry_status.php?id=$id");   
        }
	}
	else
	{
		
		echo "<script>alert('Something Went Wrong!!!')</script>";
	}
	
}

?>