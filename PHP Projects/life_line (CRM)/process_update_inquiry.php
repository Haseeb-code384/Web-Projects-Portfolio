<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];

if(isset($_REQUEST['submit']))
{
	
		$id=$_REQUEST['id'];
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
		$record_type=$_REQUEST['record_type'];
		$patient_since=$_REQUEST['patient_since'];
		$record_remarks=$_REQUEST['record_remarks'];
		$patient_id=$_REQUEST['patient_id'];
		$google_drive_link=$_REQUEST['google_drive_link'];
		$delivery_status=$_REQUEST['delivery_status'];
		$expected_reorder_date=$_REQUEST['expected_reorder_date'];
		$other_information=$_REQUEST['other_information'];
    
	$sql="UPDATE `inquiry` SET `given_by`='$given_by',`source`='$source',`name`='$name',`province`='$province',`district`='$district',`tehsil`='$tehsil',`area`='$area',`address1`='$address1',`address2`='$address2',`phone1`='$phone1',`phone1network`='$phone1network',`phone2`='$phone2',`phone2network`='$phone2network',`whatsapp`='$whatsapp',`profile_link`='$profile_link',`cnic`='$cnic',`gender`='$gender',`referral`='$referral',`age`='$age',`height`='$height',`weight`='$weight',`marital_status`='$marital_status',`children`='$children',`education`='$education',`occupation`='$occupation',permanent_allocation='$permanent_allocation',record_type='$record_type',patient_since='$patient_since',record_remarks='$record_remarks',patient_id='$patient_id',google_drive_link='$google_drive_link',delivery_status='$delivery_status',expected_reorder_date='$expected_reorder_date',other_information='$other_information' WHERE `id`='$id'";
   // echo $sql;
	$query=mysqli_query($con,$sql);
    $lastid=$id;
    executeQuery("DELETE FROM `symptom_inquiry` WHERE inquiry_id='$id'");
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
	if($query)
	{
		alertredirect("Updated Successfully","add_inquiry.php");
	}
	else
	{
		
		echo "<script>alert('Something Went Wrong!!!')</script>";
	}
	
}

?>