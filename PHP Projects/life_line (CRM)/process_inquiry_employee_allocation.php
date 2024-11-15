<?php session_start();
$login_user=$_SESSION['email'];
include("config.php");
include("allFunctions.php");

	$page=basename(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH));

$allocated_to=$_REQUEST['allocated_to'];
$emp=$_REQUEST['emp'];
$count_emp=count($emp);
	for($i=0;$i<$count_emp;$i++)
	{
		executeQuery("UPDATE `inquiry` SET `allocated_to` = '$allocated_to',`allocated_at` = '$currentDateTime' WHERE id = '$emp[$i]';");
        $id=$emp[$i];
        executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`) VALUES (NULL, '$id','Allocation','Inquiry Allocated', '$currentDateTime','$allocated_to','$login_user')");
    
	}
//alertredirect("$count_emp Inquiries Allocated Successfully to  $allocated_to",$page);


?>