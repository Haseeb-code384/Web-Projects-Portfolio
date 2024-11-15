<?php session_start();
include('config.php');
include('allFunctions.php');
$login_user=$_SESSION['email'];
$order_id=$_REQUEST['order_id'];

$status_name=$_REQUEST['status_name'];


// Get the previous URL by removing the current URL from the $_SERVER['HTTP_REFERER'] variable.
 $previous_url= $_SERVER['HTTP_REFERER'];
include("Preloader.php");

  
        if($login_user=='')
        {
            $login_user=$_REQUEST['user'];
        }
       executeQuery("INSERT INTO `order_steps_checklist_data` (`id`, `order_id`, `status_name`, `time`, `comment`, `user`) VALUES (NULL, '$order_id', '$status_name', '$currentDateTime', NULL, '$login_user')");

//        header("Location: ".$previous_url);
?>
<script>
    window.close();
//window.location.href="<?php echo $previous_url; ?>";
</script>
