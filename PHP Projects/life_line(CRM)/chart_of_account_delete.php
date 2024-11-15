<?php
include("config.php");
$chart_of_account_id = $_GET['chart_of_account_id'];

$sql = "DELETE FROM `master_account` WHERE m_accountid = $chart_of_account_id";
$query = mysqli_query($con,$sql) or die(mysqli_error($con));
if ($query) {
    header("location:chart-of-account.php");
}else{
    echo "<script>alert('Something went Wrong')</script>";
}

?>