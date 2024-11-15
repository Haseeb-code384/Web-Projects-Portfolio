<?php

session_start();

include 'config.php';


if(isset($_POST['update'])){


 echo $user_id = $_GET['user_update_id'];
  $brandlist = $_REQUEST['brandslist'];

   $query1 = "DELETE  from `menu_user_permissions` where user_id = $user_id";
    $delete = mysqli_query($con, $query1) or die(mysqli_error($con));
    foreach($brandlist as $branditems)
    {
        
             // echo $branditems."<br>";
     
        $query2 = "INSERT INTO `menu_user_permissions`(`user_id`,`menu_id`) VALUES ($user_id ,$branditems)";
          $query_run = mysqli_query($con, $query2) or die(mysqli_error($con));;
          if ($query_run) {
            
                 echo "<script>window.close();</script>";         
          }
            else
          {
                echo "Something went wrong";
          }

    }
		//$page=basename(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH));
//		$page=$_SERVER['HTTP_REFERER'];
//header("location: ".$page);
}

?>