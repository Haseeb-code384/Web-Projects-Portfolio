<?php

session_start();

include 'config.php';
include 'allFunctions.php';

if(isset($_POST['update'])){
 $user_id = $_GET['user_update_id'];
  $brandlist_dr = $_REQUEST['brandlist_dr'];
  $brandlist_cr = $_REQUEST['brandlist_cr'];
   $query1 = "DELETE FROM `m_account_permission` WHERE account_id=$user_id";
    $delete = mysqli_query($con, $query1) or die(mysqli_error($con));
    foreach($brandlist_dr as $branditems)
    {
        $query2 = "INSERT INTO `m_account_permission` (`account_id`, `username`, `timestamp`,`type`) VALUES ('$user_id', '$branditems','$currentDateTime','Dr')";
          $query_run = mysqli_query($con, $query2) or die(mysqli_error($con));;
          if ($query_run) {
                 echo "<script>window.close();</script>";         
          }
            else
          {
                echo "Something went wrong";
          }
    }   foreach($brandlist_cr as $branditems)
    {
        $query2 = "INSERT INTO `m_account_permission` (`account_id`, `username`, `timestamp`,`type`) VALUES ('$user_id', '$branditems','$currentDateTime','Cr')";
          $query_run = mysqli_query($con, $query2) or die(mysqli_error($con));;
          if ($query_run) {
                 echo "<script>window.close();</script>";         
          }
            else
          {
                echo "Something went wrong";
          }
    }

}

?>