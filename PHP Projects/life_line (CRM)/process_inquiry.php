<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];

if(isset($_REQUEST['submit']))
{
	
		$given_by=$_REQUEST['given_by'];
		$source=$_REQUEST['source'];
		$name=strtoupper($_REQUEST['name']);
		$province=$_REQUEST['province'];
		$district=$_REQUEST['district'];
		$tehsil=$_REQUEST['tehsil'];
		$area=$_REQUEST['area'];
		$address1=$_REQUEST['address1'];
		$address2=$_REQUEST['address2'];
		$phone1=$_REQUEST['phone1'];
		$phone1network=$_REQUEST['phone1network'];
		$phone2=$_REQUEST['phone2'];
		$phone2network=$_REQUEST['phone2network'];
		$whatsapp=$_REQUEST['whatsapp'];
		$profile_link=$_REQUEST['profile_link'];
		$cnic=$_REQUEST['cnic'];
		$gender=$_REQUEST['gender'];
		$referral=$_REQUEST['referral'];
		$age=$_REQUEST['age'];
		$height=$_REQUEST['height'];
		$weight=$_REQUEST['weight'];
		$marital_status=$_REQUEST['marital_status'];
		$children=$_REQUEST['children'];
		$education=$_REQUEST['education'];
		$occupation=$_REQUEST['occupation'];
		$permanent_allocation=$_REQUEST['permanent_allocation'];
		$call_status=$_REQUEST['call_status'];
		$appointment_at=$_REQUEST['appointment_at'];
		$record_type=$_REQUEST['record_type'];
		$patient_since=$_REQUEST['patient_since'];
		$record_remarks=$_REQUEST['record_remarks'];
		$patient_id=$_REQUEST['patient_id'];
		$google_drive_link=$_REQUEST['google_drive_link'];
		$delivery_status=$_REQUEST['delivery_status'];
		$expected_reorder_date=$_REQUEST['expected_reorder_date'];
		$other_information=$_REQUEST['other_information'];
		$record_date=$_REQUEST['record_date'];
    if($appointment_at=="")
    {
    $appointment_at="0000-00-00 00:00:00.000000";   
    }
		
	$sql="INSERT INTO `inquiry` (`id`, `given_by`, `source`, `name`, `province`, `district`, `tehsil`, `area`, `address1`, `address2`, `phone1`, `phone1network`, `phone2`, `phone2network`, `whatsapp`, `profile_link`, `call_status`, `called_at`, `recall_date`, `order_status`, `order_confirmed_at`, `appointment_at`, `comments`, `allocated_to`, `allocated_at`, `created_by`, `created_at`, `last_updated_at`, `cnic`, `gender`, `referral`,  `age`, `height`, `weight`, `marital_status`, `children`, `education`, `occupation`, `committed_amount`, `permanent_allocation`, `record_type`, `patient_since`, `record_remarks`, `patient_id`, `google_drive_link`, `delivery_status`, `expected_reorder_date`, `other_information`,`record_date`) VALUES (NULL, '$given_by', '$source', '$name', '$province', '$district', '$tehsil', '$area', '$address1', '$address2', '$phone1', '$phone1network', '$phone2', '$phone2network', '$whatsapp', '$profile_link', '$call_status', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 'Pending', '0000-00-00 00:00:00.000000', '$appointment_at', '', '$login_user', '0000-00-00 00:00:00.000000', '$login_user', '$currentDateTime', '0000-00-00 00:00:00.000000', '$cnic', '$gender', '$referral', '$age', '$height', '$weight', '$marital_status', '$children', '$education', '$occupation', '0','$permanent_allocation','$record_type','$patient_since','$record_remarks','$patient_id','$google_drive_link','$delivery_status','$expected_reorder_date','$other_information','$record_date')";
	$query=mysqli_query($con,$sql) or die(mysqli_error($con));
    $lastid=mysqli_insert_id($con);
    
    
      $disease=$_REQUEST['disease'];
    for($dis=0;$dis<count($disease);$dis++)
    {
        executeQuery("INSERT INTO `inquiry_disease` (`id`, `inquiry_id`, `disease`, `active`, `timestamp`, `user`) VALUES (NULL, '$lastid', '$disease[$dis]', '1', '$currentDateTime','$login_user')");
    }
  
    
    
    
$sname=(array_filter($_REQUEST['symptom_name']));
$sval=(array_filter($_REQUEST['symptom_value']));
$i=0;
foreach($sval as $key)
{
//    echo $key;
//    echo $sname[$i];
   executeQuery("INSERT INTO `symptom_inquiry` (`id`, `inquiry_id`, `symptom_name`, `description`) VALUES (NULL, '$lastid', '$sname[$i]', '$key')");
    $i++;
}
    
    
    
        executeQuery("INSERT INTO `inquiry_status_history` (`id`, `inquiry_id`, `type`, `status`, `time`, `allocated_to`, `allocated_by`) VALUES (NULL, '$lastid','Inquiry Added','New Inquiry Added', '$currentDateTime','$login_user','$login_user')");
    
 
    
    
    
	if($query)
	{
		alertredirect("Submitted Successfully","add_inquiry.php");
	}
	else
	{
		
		echo "<script>alert('Something Went Wrong!!!')</script>";
	}
	
}

?>