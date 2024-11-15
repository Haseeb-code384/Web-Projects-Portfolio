<?php

session_start();

include 'config.php';
include 'allFunctions.php';

if(isset($_POST['update']))
{
  $user_id = $_GET['user_update_id'];
  $status_type = $_REQUEST['status_type'];
  $allow_shuffling = $_REQUEST['allow_shuffling'];
    executeQuery("UPDATE `user` SET `allow_shuffling` = '$allow_shuffling' WHERE `user`.`id` = $user_id;");
  $status_name = $_REQUEST['status_name'];
  $all = $_REQUEST['all'];
  $rev = $_REQUEST['rev'];
  $network = $_REQUEST['network'];
  $number = $_REQUEST['number_user'];
$disease=(array_filter($_REQUEST['disease']));
$network=(array_filter($_REQUEST['network']));
$number=(array_filter($_REQUEST['number_user']));
    $user_name=showQuery("SELECT email from user where id='$user_id'");
//    $counter=count($status_name);
//    $network_counter=count($network);
executeQuery("DELETE FROM `user_networks` WHERE username IN(SELECT email from user where id='$user_id')");
executeQuery("DELETE FROM `user_disease_category` WHERE username IN(SELECT email from user where id='$user_id')");
    $i=0;
    foreach($number as $key)
{
      
              executeQuery("INSERT INTO `user_networks` (`username`, `network`, `number`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES ('$user_name', '$network[$i]', '$key', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000', '')");
      $i++;
    }   
    $i=0;
    foreach($disease as $key)
{
      
              executeQuery("INSERT INTO `user_disease_category` (`username`, `disease`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES ('$user_name', '$disease[$i]', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000', '')");
      $i++;
    }
    
    executeQuery("Update `inquiry` set allocated_to='' WHERE record_type='Inquiry' AND allocated_to='$user_name' AND phone1network NOT IN(SELECT network FROM `user_networks` WHERE username='$user_name'");
    
    executeQuery("Update `inquiry` set allocated_to='' WHERE record_type='Inquiry' AND allocated_to='$user_name'  AND phone2network!=''  AND  phone2network NOT IN(SELECT network FROM `user_networks` WHERE username='$user_name') ");
    
//   $query1 = "DELETE FROM `user_inquiry_limit` WHERE user_id='$user_id'";
//    $delete = mysqli_query($con, $query1) or die(mysqli_error($con));
//    for($i=0;$i<$counter;$i++)
//    {
//     if($all[$i]=='')
//     {
//         $all[$i]=0;
//     }
//     if($rev[$i]=='')
//     {
//         $rev[$i]=0;
//     }
//        $query2 = "INSERT INTO `user_inquiry_limit` (`id`, `user_id`, `status_type`, `status_name`, `allocate`, `get_back`) VALUES (NULL, '$user_id', '$status_type[$i]', '$status_name[$i]', '$all[$i]', '$rev[$i]')";
//          $query_run = mysqli_query($con, $query2) or die(mysqli_error($con));
//          if ($query_run) {
                 echo "<script>window.close();</script>";         
//                        }
//                else
//              {
//                    echo "Something went wrong";
//              }
//
//
//    }
    
		//$page=basename(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH));
//		$page=$_SERVER['HTTP_REFERER'];
//header("location: ".$page);
}

?>